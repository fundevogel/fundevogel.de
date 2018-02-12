'use strict';

/*
 * Importing functions ..
 */

import jQuery from 'jquery';
import Astro from 'Astro';
import macy from 'macy';
import { tns } from 'tiny-slider/src/tiny-slider.module';
require('lightgallery.js');
// require('lightgallery.js/');
// require('lightgallery.js/');

window.$ = window.jQuery = jQuery;


/*
 * .. and executing them
 */

$(function() {

  var button  = $('#load-more');
  var element = $('#infinite-scroll');
  var url     = element.data('page') + '/.json';
  var limit   = parseInt(element.data('limit'));
  var offset  = limit;

  button.on('click', function(e) {
    $.get(url, {limit: limit, offset: offset}, function(data) {
      if (data.more === true) {
        console.log('Yay :)');
      } else {
        button.addClass('is-disabled');
        $('#load-more span').text(button.data('more'));
        console.log('Nay :(');
      }

      element.children().last().after(data.html);

      offset += limit;
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

function backToTop() {
  window.onscroll = function() {
    const toTop = document.getElementById('js-back-to-top');
    if (window.pageYOffset > 200) {
      toTop.classList.add('back-to-top--is-visible');
    } else {
      toTop.classList.remove('back-to-top--is-visible');
    }
  };

  // SmoothScroll back-to-top on all pages

  // Select all links with hashes
  $('a[href*="#"]')
  // Remove links that don't actually link to anything
  .not('[href="#"]')
  .not('[href="#0"]')
  .click(function(event) {
    // On-page links
    if (
      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
      &&
      location.hostname == this.hostname
    ) {
      // Figure out element to scroll to
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      // Does a scroll target exist?
      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 1000, function() {
          // Callback after animation
          // Must change focus!
          var $target = $(target);
          $target.focus();
          if ($target.is(":focus")) { // Checking if the target was focused
            return false;
          } else {
            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
            $target.focus(); // Set focus again
          };
        });
      }
    }
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

var galleries = document.getElementsByClassName('lightgallery');
for(var i = 0; i < galleries.length; i++) {
  lightGallery(galleries[i], {
    mode: 'lg-fade',
    speed: 1000,
    hideBarsDelay: 5000,
    download: false,
    counter: false,
  });
}

featureDetection();
astroJS();
backToTop();
macyJS();
