    </main>
    <footer class="site-footer bg--primary center" role="contentinfo">
      <div class="site-footer_border"></div>
      <div class="wrap">
        <p class="lead">- <?= $site->title()->html() ?> -</p>
        <p>
          - Marienstr. 13 - 79098 Freiburg -<br>
          - <?= l::get('footer_telefon') ?>.: 0761/25218 - <?= l::get('footer_telefax') ?>: 0761/30041 -
        </p>
        <nav class="footer-nav">
          <ul class="inline-list spread-out">
            <li><a href="mailto:<?= $site->mail()->html() ?>" title="<?= l::get('footer_email') ?>"><span><?= $site->mail()->html() ?></span></a></li><li>|</li>
            <li><a href="<?= url('/unsere-agb') ?>" title="<?= l::get('footer_agb--title') ?>"><span><?= l::get('footer_agb') ?></span></a></li><li>|</li>
            <li><a href="<?= url('/widerruf') ?>" title="<?= l::get('footer_widerruf--title') ?>"><span><?= l::get('footer_widerruf') ?></span></a></li><li>|</li>
            <li><a href="<?= url('/datenschutz') ?>" title="<?= l::get('footer_datenschutz--title') ?>"><span><?= l::get('footer_datenschutz') ?></span></a></li><li>|</li>
            <li><a href="<?= url('/impressum') ?>" title="<?= l::get('footer_impressum--title') ?>"><span><?= l::get('footer_impressum') ?></span></a></li>
          </ul>
        </nav>
      </div>
    </footer>
  </body>
</html>
