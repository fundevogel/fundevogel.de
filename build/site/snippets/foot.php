<a data-scroll id="js-back-to-top" class="back-to-top show-medium-up" href="#">
  <?= (new Asset("assets/images/arrow-up.svg"))->content() ?>
</a>

<?= js('assets/scripts/main.js') ?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.0.47/jquery.fancybox.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.js"></script>
<script type="text/javascript">

  // AJAX content loading on home page
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

  // Slick carousel on team page
  $('.slick-carousel').slick();

  // Fancybox (lightbox alternative)
  $('[data-fancybox]').fancybox({

    // Should display toolbars
    infobar: true,
    buttons: true,

    // What buttons should appear in the toolbar
    slideShow: false,
    fullScreen: false,
    thumbs: false,
    closeBtn: true,

  });
</script>
