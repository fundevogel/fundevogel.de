'use strict';

/*
 * Importing functions ..
 */

import jQuery from 'jquery';
import Astro from 'Astro';
import macy from 'macy';
import { tns } from 'tiny-slider/src/tiny-slider.module';
import 'lightgallery.js';
import Layzr from 'layzr.js';

window.$ = window.jQuery = jQuery;


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

$(function() {

  var button  = $('#load-more');
  var element = $('#infinite-scroll');
  var url     = element.data('page') + '/.json';
  var limit   = parseInt(element.data('limit'));
  var offset  = limit;

  button.on('click', function(e) {
    $.get(url, {limit: limit, offset: offset}, function(data) {
      if (data.more === true) {
        // more articles available
        console.log('Yay :)');
      } else {
        // no more articles available; disable button & swap text
        button.addClass('is-disabled');
        $('#load-more span').text(button.data('more'));
        console.log('Nay :(');
      }

      // Append AJAX-loaded articles to the list
      element.children().last().after(data.html);

      // Increase offset by limit
      offset += limit;

      // Update Layzr.js instance
      lazyload.update();

      // Update Lightgallery.js nodes
      var galleries = document.getElementsByClassName('lightgallery');
      for (var i = 0; i < galleries.length; i++) {
        lightGallery(galleries[i], options);
      }
    });
  });
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

