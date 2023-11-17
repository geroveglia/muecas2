/* 	Author:     Lumba
  	Developer:  @lisandrojm (GitHub)    
    URL:        https://muecas.com.ar/  */

/* /////////////////////////////////////////////////////////////////// */
/* // Gsap  //  */
/* /////////////////////////////////////////////////////////////////// */

/* 	///////////////////////////////////////////////////////////////////////// */
/* Gsap Navbar Desk */

gsap.from('.navbar-brand', { opacity: 0, y: -20, duration: 0.5, delay: 0.1 });
gsap.from('.nav-link', { opacity: 0, y: -20, duration: 0.3, stagger: 0.1, delay: 0.5 });
gsap.from('.header-span', { opacity: 0, x: -20, duration: 0.3, stagger: 0.1, delay: 0.8 });

/* 	///////////////////////////////////////////////////////////////////////// */
/* Gsap Mobile Menu */

/* Evitar scroll cuando el navbar está desplegado */
$(document).ready(function () {
  $('#navbar-toggler').click(function () {
    $('body').toggleClass('navbar-open');
  });
});

let navbarOpen = false; // Estado inicial del navbar

function animateNavbar() {
  gsap.from('.nav-link', { opacity: 0, x: -30, duration: 0.3, stagger: 0.1, delay: 0.1 });
  gsap.from('.header-span', { opacity: 0, x: -30, duration: 0.3, stagger: 0.1, delay: 0.2 });
}

function toggleNavbar() {
  if (navbarOpen) {
    gsap.killTweensOf('.nav-link, .header-span'); // Detener las animaciones
  } else {
    animateNavbar(); // Volver a activar las animaciones
  }

  navbarOpen = !navbarOpen; // Cambiar el estado del navbar
}

// Agregar evento de clic al botón del toggler
document.getElementById('navbar-toggler').addEventListener('click', function () {
  toggleNavbar();
});

/* 	///////////////////////////////////////////////////////////////////////// */
/* // Gsap Scroll Vertical //  */

function animateFrom(elem, direction) {
  direction = direction || 1;
  var x = 0,
    y = direction * 100;
  if (elem.classList.contains('gs_reveal_fromLeft')) {
    x = -100;
    y = 0;
    var duration = 1.25;
  } else if (elem.classList.contains('gs_reveal_fromRightFooter')) {
    x = 100;
    y = 0;
    var duration = 2.5;
  } else if (elem.classList.contains('gs_reveal_fromRight')) {
    x = 100;
    y = 0;
    var duration = 1.25;
  } else if (elem.classList.contains('gs_reveal_fromRight2')) {
    x = 200;
    y = 0;
    var duration = 2;
  } else if (elem.classList.contains('gs_reveal_fromLeftHexa4')) {
    x = -100;
    y = 0;
    var duration = 1;
  } else if (elem.classList.contains('gs_reveal_fromLeftHexa3')) {
    x = -100;
    y = 0;
    var duration = 1.5;
  } else if (elem.classList.contains('gs_reveal_fromLeftHexa2')) {
    x = -100;
    y = 0;
    var duration = 1.75;
  } else if (elem.classList.contains('gs_reveal_fromLeftHexa1')) {
    x = -100;
    y = 0;
    var duration = 2;
  } else if (elem.classList.contains('gs_reveal_fromLeftAlgoDulce')) {
    x = -100;
    y = 0;
    var duration = 2;
  } else if (elem.classList.contains('gs_reveal_fromBottom1')) {
    x = 0;
    y = 100;
    var duration = 1.25;
  } else if (elem.classList.contains('gs_reveal_fromBottom2')) {
    x = 0;
    y = 100;
    var duration = 1.5;
  } else if (elem.classList.contains('gs_reveal_fromBottom3')) {
    x = 0;
    y = 100;
    var duration = 1.75;
  } else if (elem.classList.contains('gs_reveal_fromUp')) {
    x = 0;
    y = -100;
    var duration = 1.75;
  } else {
    var duration = 1.25; // Duración predeterminada para otros elementos
  }
  elem.style.transform = 'translate(' + x + 'px, ' + y + 'px)';
  elem.style.opacity = '0';
  gsap.fromTo(
    elem,
    { x: x, y: y, autoAlpha: 0 },
    {
      duration: duration,
      x: 0,
      y: 0,
      autoAlpha: 1,
      ease: 'expo',
      overwrite: 'auto',
    }
  );
}

function hide(elem) {
  gsap.set(elem, { autoAlpha: 0 });
}

document.addEventListener('DOMContentLoaded', function () {
  gsap.registerPlugin(ScrollTrigger);

  gsap.utils.toArray('.gs_reveal').forEach(function (elem) {
    hide(elem); // asegura que el elemento esté oculto al desplazarse a la vista

    ScrollTrigger.create({
      trigger: elem,
      /*       markers: true, */
      onEnter: function () {
        animateFrom(elem);
      },
      onEnterBack: function () {
        animateFrom(elem, -1);
      },
      onLeave: function () {
        hide(elem);
      }, // asegura que el elemento esté oculto al desplazarse a la vista
    });
  });
});
