//HEADER SCROLL

$(document).scroll(function() { //add shadow to header on scroll down
   if ($(document).scrollTop() >= 50) {
     $('#navbar').addClass("scrolled");
     $('#header').addClass("scrolled");
   } else {
     $('#navbar').removeClass("scrolled");
     $('#header').removeClass("scrolled");
   }
});

//NAV BAR BUTTON

$("#openNavButton").click(function(){
  $("#navbar").slideToggle();
});

//this function enforces media query, it was breaking due to above function
$(window).resize(function(){
  if($(window).width() > 800){
    $("#navbar").css("display", "block");
  }else {
    $("#navbar").css("display", "none");
  }
})

//SLICK

$(document).ready(function(){
  $('.banner').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 4000,
    arrows: false,
    fade: true,
    speed: 2000,
    zIndex: 0,
  });
});

$(document).ready(function(){
  $('.featured-products-slides').slick({
    slidesToShow: 2,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 4000,
    arrows: false,
  });
});

//SEARCH

$('.search').click(function(){
  $('.searchDropdown').slideToggle("fast");
});

//PRODUCTS

$(function() {
  $('.filterMakeLabel').click(function(){
    $('.filterMakeWrapper').slideToggle("fast");
  })
})

$(function() {
  $('.filterModelLabel').click(function(){
    $('.filterModelWrapper').slideToggle("fast");
  })
})

$(function() {
  $('.filterYearLabel').click(function(){
    $('.filterYearWrapper').slideToggle("fast");
  })
})

$(function() {
  $('.filterPriceLabel').click(function(){
    $('.filterPriceWrapper').slideToggle("fast");
  })
})

$(function() {
  $('.filterResultsLabel').click(function(){
    $('.filterProductsWrapper').slideToggle("fast");
    var text = $("#filterResultsLabelH3").text();
    $("#filterResultsLabelH3").text(text == "Show Filters" ? "Hide Filters" : "Show Filters");
  })
})
