<?php

use Uniform\Form;

return function ($kirby) {
   $form = new Form([
        'subject' => [],
        'email' => [
            'rules' => ['required', 'email'],
            'message' => t('Eine Email wird benötigt!'),
        ],
        'message' => [
            'rules' => ['required'],
            'message' => t('Eine Nachricht wird benötigt!'),
        ],
    ]);

    if ($kirby->request()->is('POST')) {
        # Save form data
        # (1) Create directory & log data
        $dataDir = $kirby->root('logs') . '/contact-form/';

        if (Dir::make($dataDir)) {
            # Build unique token from current time & email
            $timestamp = date('Y-m-d_H-i-s');
            $hash = md5($timestamp . $form->data()['email']);

            # Log data
            $form->logAction([
                'template' => 'uniform/log-json',
                'file' => $dataDir . $timestamp . '-' . $hash . '.json',
            ]);
        }

        # (2) Send data via email
        try {
            $form->emailAction([
                'from' => 'noreply@fundevogel.de',
                'to' => 'info@fundevogel.de',
                'subject' => 'Neue Anfrage von {{ email }}',
                'template' => 'email',
            ]);
        } catch (Exception $e) {}

        if ($form->success()) {
            go(page('kontakt/vielen-dank')->url());
        }
    }

    return compact('form');
};
