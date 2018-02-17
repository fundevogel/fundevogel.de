'use strict';

/*
 * Importing functions ..
 */

import Astro from 'Astro';
import macy from 'macy';
import { tns } from 'tiny-slider/src/tiny-slider.module';
import 'lightgallery.js';
import Layzr from 'layzr.js';
import InfiniteScroll from 'infinite-scroll';


/*
 * .. and executing them
 */

const lazyload = Layzr({
  normal: 'data-layzr',
  threshold: 0
})

lazyload.update().check().handlers(true);

var options = {
  speed: 1000,
  hideBarsDelay: 5000,
  download: false,
  counter: false
};

var galleries = document.getElementsByClassName('lightgallery');
for(var i = 0; i < galleries.length; i++) {
  lightGallery(galleries[i], options);
}

var infScroll = new InfiniteScroll('.list', {
  path: '.next-page',
  append: '.post',
  history: false,
  button: '.load-more',
  scrollThreshold: false,
  hideNav: '.next-page'
});

infScroll.on('append', function() {
  lazyload.update();
  for(var i = 0; i < galleries.length; i++) {
    lightGallery(galleries[i], options);
  }
});

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
macyJS();