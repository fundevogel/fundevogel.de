<a data-scroll id="js-back-to-top" class="back-to-top show-medium-up" href="#top" title="<?= l::get('back-to-top--title') ?>">
  <?= (new Asset("assets/images/arrow-up.svg"))->content() ?>
</a>

<?= js('assets/scripts/main.js', true) ?>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.0.47/jquery.fancybox.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.js"></script>
<script type="text/javascript">

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

  // AJAX content loading on home page
  var element = $('#infinite-scroll');
  var url     = element.data('page') + '/.json';
  var limit   = parseInt(element.data('limit'));
  var offset  = limit;

  $(function() {
    $('#load-more').on('click', function(e) {

      $.get(url, {limit: limit, offset: offset}, function(data) {

        if (data.more === true) {
          $('.list').append('<hr>');
        } else {
          $('#load-more').addClass('is-disabled');
          $('#load-more span').text('<?= l::get('home_mehr-anzeigen--ende') ?>');
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
