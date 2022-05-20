
  var heroBanner = new Swiper(".mainBanner", {
    slidesPerView: 1,
    spaceBetween: 30,
    autoplay: {
      delay: 2500,
      disableOnInteraction: false,
},
    loop: true,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    effect: "fade",
    fadeEffect: {
      crossFade: true,
    },
  });


  // top product slider
  
  
    // slick js
  $('.new_category').slick({
    dots: false,
    infinite: false,
    speed: 300,
    slidesToShow: 8,
    slidesToScroll: 1,
    // //responsive: [
    //   {
    //     breakpoint: 1024,
    //     settings: {
    //       slidesToShow: 3,
    //       slidesToScroll: 3,
    //       infinite: true,
    //       dots: true,
    //     },
    //   },
    //   {
    //     breakpoint: 600,
    //     settings: {
    //       slidesToShow: 2,
    //       slidesToScroll: 2,
    //     },
    //   },
    //   {
    //     breakpoint: 480,
    //     settings: {
    //       slidesToShow: 1,
    //       slidesToScroll: 1,
    //     },
    //   },
    //   // You can unslick at a given breakpoint now by adding:
    //   // settings: "unslick"
    //   // instead of a settings object
    // ],
  });
  
    $('.top_product_swiper').slick({
    dots: false,
    infinite: false,
    speed: 300,
    slidesToShow: 6,
    slidesToScroll: 1,
    responsive: [
      {
        breakpoint: 639,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3
        }
      }
    ]
    // //responsive: [
    //   {
    //     breakpoint: 1024,
    //     settings: {
    //       slidesToShow: 6,
    //       slidesToScroll: 1,
    //       infinite: true,
    //       dots: false,
    //     },
    //   },
    //   {
    //     breakpoint: 600,
    //     settings: {
    //       slidesToShow: 4,
    //       slidesToScroll: 2,
    //     },
    //   },
    //   {
    //     breakpoint: 480,
    //     settings: {
    //       slidesToShow: 4,
    //       slidesToScroll: 1,
    //     },
    //   },
    //   // You can unslick at a given breakpoint now by adding:
    //   // settings: "unslick"
    //   // instead of a settings object
    // ],
  });
  
  
    // mobile services slider top_deal_products
    $(".top_deal_products").slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        arrows: true,
        responsive: [
          {
            breakpoint: 639,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3
            }
          }
        ]
    });
    
    // mobile services slider fashion_deals
    $(".fashion_deals").slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        arrows: true,
        responsive: [
          {
            breakpoint: 639,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3
            }
          }
        ]
    });
    
    // mobile services slider latest_products
    $(".latest_products").slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        arrows: true,
        responsive: [
          {
            breakpoint: 639,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3
            }
          }
        ]
    });
    
    // mobile services slider computer_products
    $(".computer_products").slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        arrows: true,
        responsive: [
          {
            breakpoint: 639,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3
            }
          }
        ]
    });

  // back to top
  $("#back-to-top").click(function (e) {
    e.preventDefault();
    $("html, body").animate({ scrollTop: 0 }, 800);
  });
  window.addEventListener("scroll", function () {
    var el = $("#back-to-top");
    if (window.pageYOffset > window.innerHeight && !el.data("show")) {
      el.data("show", 1);
      el.fadeIn();
    } else if (window.pageYOffset <= window.innerHeight && el.data("show")) {
      el.data("show", 0);
      el.fadeOut();
    }
  });
