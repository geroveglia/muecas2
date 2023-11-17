/* 	Author:     Lumba
  	Developer:  @lisandrojm (GitHub)    
	  URL:        https://muecascaba.com.ar/  */

/* /////////////////////////////////////////////////////////////////// */
/* // Header //  */
/* /////////////////////////////////////////////////////////////////// */

/* Abrir/cerrar el toggler y cambiar el height del header */
document.addEventListener('DOMContentLoaded', function () {
  const navbarToggler = document.getElementById('navbar-toggler');
  const siteHeader = document.getElementById('site-header');

  navbarToggler.addEventListener('click', function () {
    siteHeader.classList.toggle('navbar-open');
  });
});

/* Oculta logo header al hacer click en el toggler */
$(document).ready(function () {
  $('#navbar-toggler').click(function () {
    $('.navbar-brand').toggleClass('d-none');
  });
});

/* /////////////////////////////////////////////////////////////////// */
/* // Scrolling-text //  */
/* /////////////////////////////////////////////////////////////////// */

/* /////////////////////////////////////////////////////////////////// */
/* Scrolling-text | Módulo | real + simple */
(function ($) {
  $('.tt-scrolling-text').each(function () {
    var $tt_stSpeed = $(this).data('scroll-speed');
    $(this)
      .find('.tt-scrolling-text-inner')
      .css({
        'animation-duration': $tt_stSpeed + 's',
      });
  });
})(jQuery);

/* /////////////////////////////////////////////////////////////////// */
/* Scrolling-text | Módulo | Seguinos en @muecas.ok */

(function ($) {
  $('.tt-scrolling-text_seguinos').each(function () {
    var $tt_stSpeed = $(this).data('scroll-speed');
    $(this)
      .find('.tt-scrolling-text-inner_seguinos')
      .css({
        'animation-duration': $tt_stSpeed + 's',
      });
  });
})(jQuery);

/* /////////////////////////////////////////////////////////////////// */
/* // Owl Carousel //  */
/* /////////////////////////////////////////////////////////////////// */

/* /////////////////////////////////////////////////////////////////// */
/* Owl módulo | productos */
$(document).ready(function () {
  $('.owl-productos').owlCarousel({
    loop: true,
    autoplay: true,
    smartSpeed: 800,
    margin: 20,
    dots: true,
    nav: false,
    navText: ['<i class="fas fa-2x fa-chevron-left"></i>', '<i class="fas fa-2x fa-chevron-right"></i>'],
    responsiveClass: true,
    responsive: {
      0: {
        items: 2,
      },
      767: {
        items: 5,
      },
      991: {
        items: 6,
      },
    },
  });
});

/* /////////////////////////////////////////////////////////////////// */
/* Owl módulo | marcas */
$(document).ready(function () {
  $('.owl-marcas').owlCarousel({
    loop: true,
    autoplay: true,
    smartSpeed: 800,
    autoplayTimeout: 2000,
    margin: 30,
    dots: true,
    nav: false,
    navText: ['<i class="fas fa-2x fa-chevron-left"></i>', '<i class="fas fa-2x fa-chevron-right"></i>'],
    responsiveClass: true,
    responsive: {
      0: {
        items: 3,
        slideBy: 3,
      },
      767: {
        items: 5,
        slideBy: 3,
      },
      991: {
        items: 9,
        slideBy: 3,
      },
    },
  });
});

/* /////////////////////////////////////////////////////////////////// */
/* Owl módulo | comunidad */
$(document).ready(function () {
  $('.owl-comunidad').owlCarousel({
    loop: true,
    autoplay: true,
    smartSpeed: 800,
    margin: 60,
    dots: true,
    nav: false,
    navText: ['<i class="fas fa-2x fa-chevron-left"></i>', '<i class="fas fa-2x fa-chevron-right"></i>'],
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
      },
      767: {
        items: 2,
      },
      991: {
        items: 3,
      },
    },
  });
});

/* /////////////////////////////////////////////////////////////////// */
/* Owl módulo | nosotros / Desk*/
$(document).ready(function () {
  $('.owl-nosotros-desk').owlCarousel({
    loop: false,
    autoplay: false,
    /*     autoplaySpeed: 3000, */
    /*     autoplayTimeout: 15000, */
    smartSpeed: 500,
    margin: 0,
    dots: false,
    nav: true, // Cambiado a true para habilitar las flechas de navegación
    navText: ['<i class="fas fa-2x fa-chevron-left" style="color: #7a2583;"></i>', '<i class="fas fa-2x fa-chevron-right" style="color: #7a2583;"></i>'],
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
      },
      576: {
        items: 1,
      },
      991: {
        items: 1,
      },
    },
  });
});

/* /////////////////////////////////////////////////////////////////// */
/* Owl módulo | nosotros  / Mobile*/
$(document).ready(function () {
  $('.owl-nosotros-mobile').owlCarousel({
    loop: false,
    autoplay: false,
    /*     autoplaySpeed: 3000, // Cambia este valor al tiempo que desees en milisegundos (en este caso, 3 segundos) */
    /*     autoplayTimeout: 5000, */
    /*     smartSpeed: 500, */
    margin: 0,
    dots: false,
    nav: true, // Cambiado a true para habilitar las flechas de navegación
    navText: ['<i class="fas fa-2x fa-chevron-left" style="color: #7a2583;"></i>', '<i class="fas fa-2x fa-chevron-right" style="color: #7a2583;"></i>'],
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
      },
      576: {
        items: 1,
      },
      991: {
        items: 1,
        slideBy: 1,
      },
    },
  });
});
/* /////////////////////////////////////////////////////////////////// */
/* Forms */
/* /////////////////////////////////////////////////////////////////// */

/* Formulario check otros */
function toggleInputState1() {
  var checkbox = document.getElementById('otros1');
  var otrosInput = document.getElementById('otros_input1');

  if (checkbox.checked) {
    otrosInput.disabled = false;
  } else {
    otrosInput.disabled = true;
  }
}

/* Formulario check otros */
function toggleInputState2() {
  var checkbox = document.getElementById('otros2');
  var otrosInput = document.getElementById('otros_input2');

  if (checkbox.checked) {
    otrosInput.disabled = false;
  } else {
    otrosInput.disabled = true;
  }
}
