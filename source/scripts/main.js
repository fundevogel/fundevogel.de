'use strict';

/*
 * Requiring vendor js files
 */

var astro = require('Astro');
var Macy = require('macy');


/*
 * Loading main js files
 */

// Simple JS feature detection
var className, html;
html = document.documentElement;
className = html.className.replace('no-js', 'js');
html.className = className;

// Astro (header navigation)
astro.init({
  toggleActiveClass: 'is-active',
  navActiveClass: 'is-active',
});

// SmoothScroll (smooth anchor navigation)
var smoothScroll = require('smooth-scroll');
smoothScroll.init({
  activeClass: 'is-active',
});

// Show back-to-top link
window.onscroll = function() {
  var toTop = document.getElementById('js-back-to-top');
  if (window.pageYOffset > 200) {
    toTop.classList.add('back-to-top--is-visible');
  } else {
    toTop.classList.remove('back-to-top--is-visible');
  }
};

// Macy (masonry layout)
Macy.init({
  container: '#macy',
  trueOrder: false,
  // waitForImages: false,
  // margin: 1,
  columns: 2,
  breakAt: {
  //   1200: 5,
    // 1024: 2,
    768: 1,
    // 481: 1,
  },
});
