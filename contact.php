<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="lib/css/normalize.css">
    <link rel="stylesheet" href="lib/css/styles.css">
    <link href="https://fonts.googleapis.com/css?family=Alex+Brush" rel="stylesheet">
    <title>Mickey's Imports Contact</title>
  </head>
  <body>
    <div class="contact-pageWrapper">
      <!--Header-->
      <?php require "lib/inc/header.php" ?>

      <h2 class="contactHeader">Contact Us</h2>

      <form id="form" action="contact.php" method="post">

        <div class="nameWrapper">
          <label for="name">Name</label>
          <input type="text" name="name" id="name" placeholder="Your Name" required>
        </div>

        <div class="emailWrapper">
          <label for="email">Email</label>
          <input type="text" name="email" id="email" placeholder="Your Email" required>
        </div>

        <div class="feedbackWrapper">
          <label for="comment">Comment</label>
          <input type="text" name="comment" id="comment" placeholder="Your Comment" required>
        </div>

        <input class="submitFormButton" type="submit" value="Send" name="submit">

        <div class="errorMessageWrapper">
          <p class="errorMessage"></p>
        </div>

      </form>

      <h3 class="commentsHeader">Inquiries</h3>

      <div class="comments">
      </div>
    </div>

    <!--Footer-->
    <?php require "lib/inc/footer.php" ?>
    <script>

    function processSubmit(postData){
      $.ajax({ //make ajax call process.php
        url: "./process.php",
        method: "post",
        data: postData
      }).done(function(data) { //when process.php is done
        var products = JSON.parse(data); //decode json data(comments) from process page
        products.reverse(); //show most recent first

        function escapeHtml(unsafe) { //escape <, > characters to prevent script tags
          unsafe = unsafe.replace(/</g, "nope"); //sorry
          unsafe = unsafe.replace(/>/g, "nope"); //hackers
          return unsafe;
        }

        var productElements = products.map(function(value){ //map through data to display comments
          return (
            `<div class='comment'>
              <p class="commentName"> ${escapeHtml(value.Name)} said: </p>
              <p class="commentComment"> ${escapeHtml(value.Comment)}</p>
            </div>`
          )
        });
        $(".comments").html(productElements); //show comments on page
      });
    }

    //on page load call function with no comment passed in
    //so the comments are loaded but no comment is submitted
    $(document).ready(function(){
      processSubmit({});
    });

    $("#form").on("submit", function(e){
      e.preventDefault();
      //grab values from form for validation
      var name = $("#name").val();
      var email = $("#email").val();
      var comment = $("#comment").val();
      var errorMessage = []; //errors array to be populated by error messages

      //regex for validation
      if(name.match(/^[a-zA-Z ]+$/) && //only letters
      email.match(/\S+@\S+\.\S+/) && //string@string format
      comment.match(/^[a-zA-Z0-9 '.,-]+$/)){ //only letters + numbers
        $("#form").slideUp(); //if form validates: comment is sent and form slides up
        processSubmit({
          "name" : $("#name").val(),
          "email" : $("#email").val(),
          "comment" : $("#comment").val()
        });
      }else { //if not valid, check which fields are incorrect
        if(!name.match(/^[a-zA-Z ]+$/)){
          errorMessage.push("Please enter the correct format name"); //add error to errors array
        }

        if(!email.match(/\S+@\S+\.\S+/)){
          errorMessage.push("Please enter your email in the correct format");
        }

        if(!comment.match(/^[a-zA-Z0-9 '.,-]+$/)){
          errorMessage.push("Please enter your comment in the correct format");
        }

        $(".errorMessage").text(errorMessage.join(", ")); //display errors on page
      }
    });

    </script>
  </body>
</html>
