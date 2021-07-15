<form method="POST">
    <div class="flex flex-col md:flex-row">
    </div>
    <div class="flex-1">
        <label for="subject"><?= t('Betreff') ?></label>
        <input id="subject" name="subject" type="text" value="<?= $form->old('email') ?>" required>
    </div>
    <div class="flex-1">
        <label for="email">E-Mail<span class="text-red-medium"> * <?= t('erforderlich') ?></span></label>
        <input id="email" name="email" type="email" value="<?= $form->old('email') ?>">
    </div>
    <div>
        <label for="message"><?= t('Nachricht') ?></label>
        <textarea id="message" name="message"><?= $form->old('message') ?></textarea>
    </div>
    <?= csrf_field() ?>
    <?= honeypot_field() ?>
    <input type="submit" value="Submit">
</form>
