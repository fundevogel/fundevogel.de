'use strict';

/*
 * Importing functions ..
 */

import Astro from 'Astro';
import macy from 'macy';
import { tns } from 'tiny-slider/src/tiny-slider.module.js';

/*
 * .. and executing them
 */

function featureDetection() {
  let className = '';
  let html = '';
  html = document.documentElement;
  className = html.className.replace('no-js', 'js');
  html.className = className;
}

function astroJS() {
  Astro.init({
    toggleActiveClass: 'is-active',
    navActiveClass: 'is-active',
  });
}

function backToTop() {
  window.onscroll = function() {
    const toTop = document.getElementById('js-back-to-top');
    if (window.pageYOffset > 200) {
      toTop.classList.add('back-to-top--is-visible');
    } else {
      toTop.classList.remove('back-to-top--is-visible');
    }
  };
}

function macyJS() {
  macy({
    container: '#macy',
    trueOrder: false,
    columns: 2,
    breakAt: {
      768: 1,
    },
  });
}

let slider = tns({
  container: '.gallery',
  mode: 'gallery',
  speed: 1000,
  lazyload: true,
  autoplay: true,
  autoplayTimeout: 4000,
  autoplayHoverPause: true,
  autoplayButtonOutput: false,
  nav: false,
  controls: false,
});

featureDetection();
astroJS();
backToTop();
macyJS();
