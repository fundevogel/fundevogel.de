var $ = require('jquery');

var element = $('#infinite-scroll');
var url     = element.data('page') + '/.json';
var limit   = parseInt(element.data('limit'));
var offset  = limit;

$(function() {
  $('#load-more').on('click', function(e) {

    $.get(url, {limit: limit, offset: offset}, function(data) {

      if(data.more === true) {
        $('.list').append('<hr>');
      } else {
        $('#load-more').addClass('is-disabled');
        $('#load-more span').text('Ihr seid super, weiter so!');
      }

      element.children().last().after(data.html);

      offset += limit;
    });
  });
});
