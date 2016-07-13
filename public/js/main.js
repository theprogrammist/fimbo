$(function () {

  // slider
  var owl = $('.js-slider');
  owl.owlCarousel({
    items: 3,
    slideBy: 3,
    margin: 30,
    loop:true,
    nav:true,
    autoplay:true,
    autoplayTimeout:5000,
    autoplayHoverPause: true,
    smartSpeed: 0,
    responsive:{
      0:{
          items:1,
      },
      600:{
          items:2,
      },
      768:{
          items:2,
      },
      1000:{
          items:3,
      }
    }
  });

  owl.on('changed.owl.carousel', function(event) {
    var current = $(event.target).find('.owl-item');
    current.addClass('animated flipInY').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
      current.removeClass('animated flipInY');
    });
  })


  // video popup
  var videoSrc = $('.js-video-src').find('iframe').attr('src');
  $('.js-video').click(function(){
    $('.js-video-src').find('iframe').attr('src', videoSrc);
    $('body').css({'overflow':'hidden'});
    $('.js-popup-video').appendTo('.js-popup-wrap');
    $('.js-popup-wrap, .js-popup-video').fadeIn();
    $('.js-popup-video').addClass('open');
  });
  $('.js-popup-close').click(function(){
    $('.js-video-src').find('iframe').attr('src', '');
    $('body').css({'overflow':'auto'});
    $('.js-popup-wrap, .js-popup, .js-read-bg').fadeOut();
  });

  $('.js-enter').click(function(){
    $('body').css({'overflow':'hidden'});
    $('.js-popup-wrap, .js-popup-enter').fadeIn();
    $('.js-popup-enter').addClass('open');
  });
  $('.js-lost').click(function(){
    $('body').css({'overflow':'hidden'});
    $('.js-popup').fadeOut();
    $('.js-popup-wrap, .js-popup-lost').fadeIn();
    $('.js-popup-lost').addClass('open');
  });

  $('.js-target-add').click(function(){
    $('body').css({'overflow':'hidden'});
    $('.js-popup-wrap, .js-popup-target').fadeIn();
    $('.js-popup-target').addClass('open');
  });

  $('.js-answer').click(function(e){
    e.preventDefault();
    $('body').css({'overflow':'hidden'});
    $('.js-popup-wrap, .js-popup-wrong').fadeIn();
    $('.js-popup-wrong').addClass('open');
  });

  // клик в свободной зоне popup
  $('.js-popup-wrap').click( function(event){
    if( $(event.target).closest(".js-popup").length )
      return;
    $(".js-popup.open .js-popup-close").trigger('click');
    event.stopPropagation();
  });

  // language
  $('.js-lang-select').click(function(){
    $(this).find('.js-hidden-lang').slideToggle();
  });

  // profile
  $('.js-profile-link').click(function(){
    $(this).parent().find('.js-profile-hidden').slideToggle();
  });


  // slider-five
  $owlFive = $('.js-slider-five');
  var owlFive_Settings = {
    items: 5,
    nav:true,
    mouseDrag: false,
    smartSpeed: 550,
    center:true,
    startPosition: 2,
    //loop:true,
    //autoplay:true,
    //autoplayTimeout:5000,
    autoplayHoverPause: true,
    responsive:{
      0:{
          items:1,
      },
      479:{
          items:3,
      },
      768:{
          items:3,
      },
      1000:{
          items:5,
      }
    },
    onTranslate: fiveSlide,
  };
  $owlFive.owlCarousel( owlFive_Settings );
  function fiveSlide(event){
    setTimeout(function(){
    $('.js-slider-five .owl-item').removeClass('one');
    $('.js-slider-five .owl-item').removeClass('two');
    $('.js-slider-five .owl-item').removeClass('three');
    $('.js-slider-five .owl-item').removeClass('four');
    $('.js-slider-five .owl-item').removeClass('five');
    $('.js-slider-five').find('.center').prev().prev().addClass('one');
    $('.js-slider-five').find('.center').prev().addClass('two');
    $('.js-slider-five').find('.center').addClass('three');
    $('.js-slider-five').find('.center').next().addClass('four');
    $('.js-slider-five').find('.center').next().next().addClass('five');
  },50)
  }
  $('.js-slider-five').on('click', '.owl-item', function(event) {
    var index = $(this).index();
    $(this).closest('.owl-stage').trigger('to.owl.carousel', [index, 550, true]);
  });
  fiveSlide();


  // animated
  $.fn.extend({
    animateCss: function (animationName) {
        var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
        $(this).addClass('animated ' + animationName).one(animationEnd, function() {
            $(this).removeClass('animated ' + animationName);
        });
    }
  });

  // icons hover
  $('.cash__item').hover(function(){
    $(this).find('img').animateCss('tada');
  }, function(){});

  // dropdown tab
  $('.js-droptab').on('click', '.js-droptab-link', function(){
    $(this).next().slideDown();
    $(this).addClass('open');
    $(this).parent().find('.js-slider-five').show();
    var $owlFive1 = $(this).parent().find('.js-slider-five');
    $owlFive1.trigger('destroy.owl.carousel');
    $owlFive1.owlCarousel( owlFive_Settings );
    fiveSlide();
    setTimeout(function(){
      $owlFive1.removeClass('owl-hidden');
    }, 200)
  });
  $('.js-droptab').on('click', '.js-droptab-link.open', function(){
    $(this).parent().find('.js-slider-five').hide();
    $(this).next().slideUp();
    $(this).removeClass('open');
  });


  // calendar
  $( ".js-datepicker " ).datepicker({
    dateFormat: "d MM yy",
    changeMonth: true,
    changeYear: true,
    altField: "#birthdate",
    altFormat: "yy-mm-dd",
    yearRange: '1950:'
  });

  $.datepicker.regional['ru'] = {
    closeText: 'Закрыть',
    prevText: '&#x3c;Пред',
    nextText: 'След&#x3e;',
    currentText: 'Сегодня',
    monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
    'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
    monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн',
    'Июл','Авг','Сен','Окт','Ноя','Дек'],
    dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
    dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
    dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
    dateFormat: 'dd.mm.yy',
    firstDay: 1,
    isRTL: false
    };
    $.datepicker.setDefaults($.datepicker.regional['ru']);
  $('.datepicker').click(function(){
    $('.js-datepicker').trigger('focus');
  });


  // select style
  $('input[type="checkbox"], input[type="radio"], select').styler();


  // validation form
  $(".js-valid-form").validate({
    ignore: ".js-soc-url",
    invalidHandler: function() {
      setTimeout(function() {
        $('input, select').trigger('refresh');
      }, 1)
    },
    submitHandler: function(form) {
      //$('.js-popup-wrap, .js-popup-register').fadeIn();
      //setTimeout(function(){
      //  $('.js-popup-wrap, .js-popup-register').fadeOut();
      //}, 3000);
      form.submit();
    }
  });

  !function(a){"function"==typeof define&&define.amd?define(["jquery","../jquery.validate.min"],a):"object"==typeof module&&module.exports?module.exports=a(require("jquery")):a(jQuery)}(function(a){a.extend(a.validator.messages,{required:"Это поле необходимо заполнить.",remote:"Пожалуйста, введите правильное значение.",email:"Пожалуйста, введите корректный адрес электронной почты.",url:"Пожалуйста, введите корректный URL.",date:"Пожалуйста, введите корректную дату.",dateISO:"Пожалуйста, введите корректную дату в формате ISO.",number:"Пожалуйста, введите число.",digits:"Пожалуйста, вводите только цифры.",creditcard:"Пожалуйста, введите правильный номер кредитной карты.",equalTo:"Пожалуйста, введите такое же значение ещё раз.",extension:"Пожалуйста, выберите файл с правильным расширением.",maxlength:a.validator.format("Пожалуйста, введите не больше {0} символов."),minlength:a.validator.format("Пожалуйста, введите не меньше {0} символов."),rangelength:a.validator.format("Пожалуйста, введите значение длиной от {0} до {1} символов."),range:a.validator.format("Пожалуйста, введите число от {0} до {1}."),max:a.validator.format("Пожалуйста, введите число, меньшее или равное {0}."),min:a.validator.format("Пожалуйста, введите число, большее или равное {0}.")})});


  // read task
  $('.js-read').click(function(){
    $('body').css({'overflow':'hidden'});
    $('.js-read-bg, .js-read-task').fadeIn();
    $('.js-read-task').addClass('open');
  });
  // клик в свободной зоне popup
  $('.js-read-bg').click( function(event){
    if( $(event.target).closest(".read-task__left-col").length || $(event.target).closest(".read-task__right-col").length )
      return;
    $(".js-read-task.open, .js-read-bg").fadeOut();
    $('body').css({'overflow':'auto'});
    event.stopPropagation();
  });

  // animation number
  var time = 2000;
  var pointAll = $('.js-point-all').data('number');
  $('.js-point-all').animateNumber({ number: pointAll }, time);
  var pointMonth = $('.js-point-month').data('number');
  $('.js-point-month').animateNumber({ number: pointMonth }, time);
  var rub = $('.js-rub').data('number');
  $('.js-rub').animateNumber({ number: rub }, time);
  var decide = $('.js-decide').data('number');
  $('.js-decide').animateNumber({ number: decide }, time);
  var decideMonth = $('.js-decide-month').data('number');
  $('.js-decide-month').animateNumber({ number: decideMonth }, time);

  // animation circle
  if($('.js-target-last').length){
    var trTop = $('.js-target-last').offset().top;
    var flag = 1;
    $(window).scroll(function(){
      var wH = $(window).height()/2;
      var wS = $(window).scrollTop() + wH;
      if (wS>trTop && flag>0) {
        $('.js-circlestat').circliful();
        var targetDecide = $('.js-target-decide').data('number');
        $('.js-target-decide').animateNumber({ number: targetDecide }, time);
        var targetPoint = $('.js-target-point').data('number');
        $('.js-target-point').animateNumber({ number: targetPoint }, time);
        var targetDay = $('.js-target-day').data('number');
        $('.js-target-day').animateNumber({ number: targetDay }, time);
        flag = 0;
      }
    });
  }


  // rating slider
  $('.js-cab-profile-rating').owlCarousel({
    items: 7,
    nav:true,
    center:true,
    loop: false,
    startPosition: 3,
    onTranslate: sevenSlide,
    smartSpeed: 550,
    //loop:true,
    //autoWidth:true,
    responsive:{
      0:{
          items:1,
      },
      479:{
          items:3,
      },
      768:{
          items:5,
      },
      1000:{
          items:5,
      },
      1200:{
          items:7,
      }
    },
  });
  function sevenSlide(event){
    setTimeout(function(){
      $('.js-cab-profile-rating').find('.owl-item').removeClass('zoom1 zoom2');
      var sliderCenter = $('.js-cab-profile-rating').find('.center');
      sliderCenter.prev().prev().addClass('zoom1');
      sliderCenter.prev().addClass('zoom2');
      sliderCenter.next().addClass('zoom2');
      sliderCenter.next().next().addClass('zoom1');
    },50)
  }
  sevenSlide();

  // add target
  $('.js-targer-item').click(function(){
    $(this).toggleClass('open');
  });

  // edit setting
  $('.js-edit').click(function(){
    $(this).prev('input').focus();
  });

  // new-photo
  $('.js-new-photo').click(function(){
    $(this).next('.js-new-photo-input').trigger('click');
  });

  // delete photo
  $('.js-delete-photo').click(function(){
    $('.cab-profile__ava').find('img').remove();
  });

  // mobile 768
  function mobile(){
    if($(window).width() < 768){
      $('.js-content-right').prependTo('.js-content');
    } else{
      $('.js-content-right').appendTo('.js-content');
    }
  }
  mobile();
  $(window).resize(function(){
    mobile();
  });

  // slider comics
  var sliderComicsSettings = window.sliderComicsSettings || {
        items: 2,
        margin: 10,
        slideBy: 2,
        loop:true,
        nav:true,
        autoplay:false,
        //dotsEach: true,
        responsive:{
          0:{
            items:1,
          },
          600:{
            items:2,
          },
          768:{
            items:2,
          },
          1000:{
            items:2,
          }
        }
      };
  $('.js-read-comics-slider').owlCarousel(sliderComicsSettings);


  // slider lection
  var sliderLectionsSettings = window.sliderLectionsSettings || {
    items: 1,
        loop:true,
      nav:false,
      dots: true,
      autoplay:false,
      autoHeight:true,
      mouseDrag: false,
      touchDrag: false,
  }
  setTimeout(function(){
  $('.js-read-lection-slider').owlCarousel(sliderLectionsSettings);
    if('setPageSelected' in window) window.setPageSelected();
    window.renuumerate();
    window.setOnclick()
    window.startReferrer = document.referrer;
  },50);

});

$(function () {
  window.renuumerate = function (e) {
    setTimeout(function (e) {
      $('.owl-item:not(.cloned) > div.item').each(function (i, el) {
        $('div.js-read-lection-slider .owl-dot, div.js-read-comics-slider .owl-dot').eq(i).
          html(('<a style="position:relative;z-index:1000" href="/lection/' + $('#lectionId').val() + '/' + $(el).attr('data-number') + '">' + $(el).attr('data-number') + '</a>' || ''));
      });

      $active = typeof(e) !== 'undefined' ? $(e.target) : $('div.js-read-lection-slider .owl-dot.active');
      $active.find('a').html('<span style="padding-right: 10px;">Страница</span>' + $active.find('a').text());

      $active = typeof(e) !== 'undefined' ? $(e.target) : $('div.js-read-comics-slider .owl-dot.active');
      $active.find('a').html('<span style="padding-right: 10px;">Страница</span>' + $active.find('a').text());

      //setTimeout(function(){$('.owl-item:not(.cloned) > div.item').hide();setTimeout(function(){$('.owl-item:not(.cloned) > div.item').show();},150)},150);
    }, 5);
  };

  //renuumerate();
window.setOnclick = function() {
  $('div.js-read-lection-slider .owl-dot, div.js-read-comics-slider .owl-dot, div.js-read-comics-slider div.owl-next, div.js-read-comics-slider div.owl-prev').click(function (el) {
    if(typeof $(el.target).attr('href') == "undefined") {
      el = $('div.js-read-comics-slider .owl-dot.active').find('a')[0];
      var target = el;
    } else {
      var target = el.target;
    }
    renuumerate(el)
    /* in case mishit within a and is container */
    var href = $(target).attr('href') || $(target).find('a').attr('href');
    //window.location.href = href;
    window.history.pushState({}, "", href);
    $('.read-comics')[0].scrollIntoView();
  });
};

  $('.js-comics-close').on('click tap', function(){
    if(window.startReferrer.replace(/\/+$/,'') == (window.location.protocol + '//' + window.location.host)) {
      window.location.href = window.location.protocol + '//' + window.location.host;
    } else {
      window.location.href = window.location.href + '/../../';
    }
  });

  window.rememberVisitedPosition = function (el, href) {
    $slider = $(el).parents('.js-slider-five');
    $sliderIdx = $('.js-slider-five').index($slider);
    $activeItem = $(el).parents('.slider__item');
    $activeItemIdx = $slider.find('.slider__item').index($activeItem);

    var jsSliderFivePositions = localStorage.getItem("jsSliderFivePositions") || '{}';
    try {
      jsSliderFivePositions = JSON.parse(jsSliderFivePositions)
    } catch (e) {
      ;
    }

    if(typeof jsSliderFivePositions !== "object") {
      jsSliderFivePositions = {};
    }

    if(window.location.href.split('/').slice(-1) == 'lection') ++$sliderIdx;
    jsSliderFivePositions[$sliderIdx] = $activeItemIdx;

    localStorage.setItem("jsSliderFivePositions", JSON.stringify(jsSliderFivePositions));

    window.location.href = href;
  };

  window.restorerVisitedPositions = function () {
    if (jsSliderFivePositions = localStorage.getItem("jsSliderFivePositions")) {
      try {
        var jsSliderFivePositions = JSON.parse(jsSliderFivePositions)
      } catch (e) {
        ;
      }
      if(typeof jsSliderFivePositions == "object") {
        for (s in jsSliderFivePositions) {
          var slider = (window.location.href.split('/').slice(-1) == 'lection') ? (s - 1) : s;
          var position = jsSliderFivePositions[s];
          $slider = $('.js-slider-five').eq(slider)
          if($slider.find('.slider__item').length > position) {
            $('.js-slider-five').eq(slider).data('owl.carousel').to(position);
          }
        }
      }
    }
  };
  setTimeout(function(){
    window.restorerVisitedPositions();
  },50);

  $('.popup-enter__button').click(function(){
    localStorage.setItem("jsSliderFivePositions",'');
  });
});
