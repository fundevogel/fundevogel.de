<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel="preload" href="/assets/fonts/Dosis-Light-supersubset.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="/assets/fonts/CabinSketch-Bold-ultrasubset.woff2" as="font" type="font/woff2" crossorigin>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/svg4everybody/2.1.9/svg4everybody.legacy.min.js" integrity="sha256-G9YRHgJRIlBrGDnNDqafosjTgDoNPcrMcslghv19qCI=" crossorigin="anonymous"></script>

  <?= $page->metaTags() ?>

  <!-- CSS -->
  <style><?= (new Asset('assets/styles/main.css'))->read() ?></style>

  <!-- Favicon -->
  <link rel="shortcut icon" href="<?= url('favicon.ico') ?>">
  <?php snippet('generated/favicons') ?>

  <!-- Fallback CSS -->
  <noscript><?= css('assets/styles/main.css') ?></noscript>

  <!-- Font loading -->
  <script integrity="sha256-sv4jGGVCDUykONZVQdABKFT3hKgodDeF9539pQiKBKw="><?= (new Asset('assets/font-loading.js'))->read() ?></script>

  <?= js('assets/scripts/main.js', ['defer' => true]) ?>
</head>

<!-- <script type="text/javascript">

// forEach method
var forEach = function (array, callback, scope) {
  for (var i = 0; i < array.length; i++) {
    callback.call(scope, i, array[i]); // passes back stuff we need
  }
};

function fadeOut(el) {
  el.style.opacity = 1;

  (function fade() {
    if ((el.style.opacity -= .1) < 0) {
      el.style.display = "none";
    } else {
      requestAnimationFrame(fade);
    }
  })();
};

function fadeIn(el, display) {
  el.style.opacity = 0;
  el.style.display = display || "block";

  (function fade() {
    var val = parseFloat(el.style.opacity);
    if (!((val += .1) > 1)) {
      el.style.opacity = val;
      requestAnimationFrame(fade);
    }
  })();
};

function openModal(e) {
  e.classList.add('is-active');
  // fadeIn(e);
}

function closeModal(e) {
  e.classList.remove('is-active');
  // fadeOut(e);
}

document.addEventListener('DOMContentLoaded', function() {

// MODAL
var toggle = document.querySelector('.modal-toggle');
console.log(toggle);

  // forEach(toggles, function (i, button) {
    var target = toggle.dataset.toggle;
    var modal = document.querySelector('[data-modal="' + target + '"]');
    var overlay = modal.children[0];
    // var close = modal.querySelector('.delete');

    toggle.addEventListener('click', function(e){
      e.preventDefault();
      openModal(modal);
    });

    // close.addEventListener('click', function(e){
    //   closeModal(modal);
    // });

    overlay.addEventListener('click', function(e){
      closeModal(modal);
    });
  // });
});

</script>

<style media="screen">
  .modal {
    display: none;
    position: fixed;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    overflow: hidden;
    z-index: 1000;
  }

  .modal-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    top: 0;
    background: rgba(0, 0, 0, 0.5);
  }

  .modal-card {
    position: relative;
    margin: 0 20px;
    width: 100%;
    max-width: 80%;
    max-height: calc(100vh - 210px);
    overflow-y: auto;
  }

  .modal.is-active {
    display: flex;
  }
</style> -->
