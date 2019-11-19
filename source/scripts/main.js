/*
 * Importing functions ..
 */

import Turbolinks from 'turbolinks';
import Astro from 'Astro';
import macy from 'macy';
import Layzr from 'layzr.js';
import InfiniteScroll from 'infinite-scroll';
import {tns} from 'tiny-slider/src/tiny-slider.module';
import 'lightgallery.js';


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

const lazyload = Layzr({
  normal: 'data-layzr',
  threshold: 25,
});

function lightgalleryJS() {
  const galleries = document.getElementsByClassName('lightgallery');
  for (let i = 0; i < galleries.length; i++) {
    lightGallery(galleries[i], {
      speed: 1000,
      hideBarsDelay: 5000,
      download: false,
      counter: false,
    });
  }
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

Turbolinks.start();

document.addEventListener('turbolinks:load', function() {
  featureDetection();
  astroJS();
  lazyload
    .update()
    .check()
    .handlers(true);
  lightgalleryJS();

  if (document.body.classList.contains('news')) {
    const infScroll = new InfiniteScroll('.list', {
      path: '.load-more-target',
      append: '.post',
      history: false,
      // button: '.load-more',
      scrollThreshold: 100,
      hideNav: '.load-more-target',
    });

    infScroll.on('append', function() {
      lazyload.update().check();
      lightgalleryJS();
    });
  } else if (document.body.classList.contains('fundevogel-und-team')) {
    const slider = tns({
      container: '.gallery',
      mode: 'gallery',
      speed: 1000,
      // lazyload: true,
      autoplay: true,
      autoplayTimeout: 4000,
      autoplayHoverPause: true,
      autoplayButtonOutput: false,
      nav: false,
      controls: false,
    });
  } else if (document.body.classList.contains('unser-service') || document.body.classList.contains('unser-netzwerk')) {
    macyJS();
  }
});
