<form method="POST">
    <div class="flex flex-col md:flex-row">
        <div class="flex-1 mb-4 md:mr-2">
            <label for="subject" class=""><?= t('Betreff') ?></label>
            <input
                class="form-input placeholder-orange-medium placeholder-opacity-100 focus:outline-none active:outline-none<?php e($form->error('subject'), ' error') ?>"
                id="subject"
                name="subject"
                type="text"
                value="<?= $form->old('subject') ?>"
            >
        </div>
        <div class="flex-1 mb-4 md:ml-2">
            <div class="flex justify-between">
                <label for="email">E-Mail <span class="font-bold text-red-medium">*</span></label>
                <span class="font-bold text-xs text-red-medium">*<?= t('erforderlich') ?></span>
            </div>
            <input
                class="form-input placeholder-orange-medium placeholder-opacity-100 focus:outline-none active:outline-none<?php e($form->error('email'), ' error') ?>"
                id="email"
                name="email"
                type="email"
                value="<?= $form->old('email') ?>"
            >
        </div>
    </div>
    <div class="mb-4">
        <div class="flex justify-between">
            <label for="message"><?= t('Nachricht') ?> <span class="font-bold text-red-medium">*</span></label>
            <span class="font-bold text-xs text-red-medium">*<?= t('erforderlich') ?></span>
        </div>
        <textarea
            class="form-input placeholder-orange-medium placeholder-opacity-100 focus:outline-none active:outline-none<?php e($form->error('message'), ' error') ?>"
            id="message"
            name="message"
            rows="8"
        ><?= $form->old('message') ?></textarea>
    </div>
    <?= csrf_field() ?>
    <?= honeypot_field() ?>
    <input
        class="w-full h-16 px-4 flex justify-center items-center sketch text-2xl text-white text-shadow bg-red-light hover:bg-red-medium transition-all cursor-pointer rounded-lg"
        type="submit"
        value="<?= t('Absenden') ?>"
    >
</form>
