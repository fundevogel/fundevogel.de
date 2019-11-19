    </main>
    <footer class="site-footer bg--primary center" role="contentinfo">
      <div class="site-footer_border"></div>
      <div class="wrap">
        <p class="lead">- <?= $site->title()->html() ?> -</p>
        <p>
          - Marienstr. 13 - 79098 Freiburg -<br>
          - <?= t('footer_telefon') ?>.: 0761/25218 - <?= t('footer_telefax') ?>: 0761/30041 -
        </p>
        <nav class="footer-nav">
          <ul class="inline-list spread-out">
            <li><a href="mailto:<?= $site->mail()->html() ?>" title="<?= t('footer_email') ?>"><span><?= $site->mail()->html() ?></span></a></li><li>|</li>
            <li><a href="<?= url('/unsere-agb') ?>" title="<?= t('footer_agb--title') ?>"><span><?= t('footer_agb') ?></span></a></li><li>|</li>
            <li><a href="<?= url('/widerruf') ?>" title="<?= t('footer_widerruf--title') ?>"><span><?= t('footer_widerruf') ?></span></a></li><li>|</li>
            <li><a href="<?= url('/datenschutz') ?>" title="<?= t('footer_datenschutz--title') ?>"><span><?= t('footer_datenschutz') ?></span></a></li><li>|</li>
            <li><a href="<?= url('/impressum') ?>" title="<?= t('footer_impressum--title') ?>"><span><?= t('footer_impressum') ?></span></a></li>
          </ul>
        </nav>
      </div>
    </footer>
    <script>

    svg4everybody({
        polyfill: true
    });

    </script>
  </body>
</html>
