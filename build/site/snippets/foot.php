<a data-scroll id="js-back-to-top" class="back-to-top show-medium-up" href="#top" title="<?= l::get('back-to-top--title') ?>">
  <?= (new Asset("assets/images/arrow-up.svg"))->content() ?>
</a>

<?= js('assets/scripts/main.js', true) ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.0.47/jquery.fancybox.min.js" integrity="sha256-MXT+AJD8HdXQ4nLEbqkMqW3wXXfvjaGQt/Q/iRlBNSU=" crossorigin="anonymous"></script>
<script type="text/javascript">

  // AJAX content loading on home page
  var button  = $('#load-more');
  var element = $('#infinite-scroll');
  var url     = element.data('page') + '/.json';
  var limit   = parseInt(element.data('limit'));
  var offset  = limit;

  $(function() {
    button.on('click', function(e) {

      $.get(url, {limit: limit, offset: offset}, function(data) {

        if (data.more === true) {
          console.log('Yay :)');
        } else {
          button.addClass('is-disabled');
          $('#load-more span').text('<?= l::get('home_mehr-anzeigen--ende') ?>');
          console.log('Nay :(');
        }

        element.children().last().after(data.html).css({ opacity: 0 }).fadeTo('normal', 0.5);

        offset += limit;
      });
    });
  });

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
