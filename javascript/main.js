$(document).ready(function(){
    $('.owl-carousel').owlCarousel({
      loop:true,
      margin:10,
      nav:true,
      responsive:{
          0:{
              items:2
          },
          700:{
              items:4
          },
          1090:{
              items:5
          }
      }
    })
  });