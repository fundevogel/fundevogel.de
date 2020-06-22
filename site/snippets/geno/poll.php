<form action="<?= $page->url() ?>" method="POST">
    <div class="mb-12">
        <div class="mb-6">
            <label>Name, Vorname oder anonym:</label>
            <input class="form-input placeholder-orange-medium placeholder-opacity-100<?php e($form->error('Name'), ' error') ?>" name="Name" type="text" value="<?= $form->old('Name') ?>">
        </div>
        <div class="mb-6">
            <label>ggf. Adresse:</label>
            <textarea name="Adresse" class="form-input placeholder-orange-medium placeholder-opacity-100" style="min-height: 10rem"><?= $form->old('Adresse'); ?></textarea>
        </div>
        <div class="mb-6">
            <label>Ich bin Kunde/Kundin im FUNDEVOGEL seit:</label>
            <input class="form-input placeholder-orange-medium placeholder-opacity-100<?php e($form->error('KundeSeit'), ' error') ?>" name="KundeSeit" type="text" value="<?= $form->old('KundeSeit') ?>">
        </div>
    </div>

    <div class="mb-12">
        <label>Sind Sie an einer auf Kinder- und Jugendliteratur spezialisierten Buchhandlung wie dem FUNDEVOGEL auch in Zukunft interessiert?</label>
        <?php $value = $form->old('InteresseKJL') ?>
        <select name="InteresseKJL" class="form-select">
            <option value="---"<?php e(!$value || $value=='---', ' selected')?>>---</option>
            <option value="Ja"<?php e($value=='Ja', ' selected')?>>Ja</option>
            <option value="Nein"<?php e($value=='Nein', ' selected')?>>Nein</option>
        </select>
    </div>

    <div class="mb-12">
        <label>Was ist für Sie die Besonderheit des FUNDEVOGELs, wodurch zeichnet er sich für Sie aus?</label>
        <textarea name="BesonderheitenFV" class="form-input placeholder-orange-medium placeholder-opacity-100<?php e($form->error('BesonderheitenFV'), ' error') ?>" style="min-height: 10rem"><?= $form->old('BesonderheitenFV') ?></textarea>
    </div>

    <div class="mb-12">
        <div class="mb-6">
            <label>Wünschen Sie sich ein erweitertes Angebot?</label>
            <?php $value = $form->old('AngebotErweitern') ?>
            <select class="form-select" name="AngebotErweitern">
                <option value="---"<?php e(!$value || $value=='---', ' selected')?>>---</option>
                <option value="Ja"<?php e($value=='Ja', ' selected')?>>Ja</option>
                <option value="Nein"<?php e($value=='Nein', ' selected')?>>Nein</option>
            </select>
        </div>
        <div class="mb-6">
            <label>.. wenn ja, welches?</label>
            <textarea name="AngebotErweiternWie" class="form-input placeholder-orange-medium placeholder-opacity-100<?php e($form->error('AngebotErweiternWie'), ' error') ?>" style="min-height: 10rem"><?= $form->old('AngebotErweiternWie') ?></textarea>
        </div>
    </div>

    <div class="mb-12">
        <div class="mb-6">
            <label>Sind Sie mit der jetzigen Zusammenstellung des Sortiments und der Qualität der Beratung zufrieden?</label>
            <?php $value = $form->old('SortimentBeratungZufrieden') ?>
            <select class="form-select" name="SortimentBeratungZufrieden">
                <option value="---"<?php e(!$value || $value=='---', ' selected')?>>---</option>
                <option value="Ja"<?php e($value=='Ja', ' selected')?>>Ja</option>
                <option value="Nein"<?php e($value=='Nein', ' selected')?>>Nein</option>
            </select>
        </div>
        <div class="mb-6">
            <label>.. wenn nein, was könnte besser sein?</label>
            <textarea name="SortimentBeratungWas" class="form-input placeholder-orange-medium placeholder-opacity-100<?php e($form->error('SortimentBeratungWas'), ' error') ?>" style="min-height: 10rem"><?= $form->old('SortimentBeratungWas') ?></textarea>
        </div>
    </div>

    <div class="mb-12">
        <div class="mb-6">
            <label>Sind Sie mit dem Service und der Schnelligkeit bei der Bearbeitung ihrer Aufträge zufrieden?</label>
            <?php $value = $form->old('ServiceSchnelligkeitZufrieden') ?>
            <select class="form-select" name="ServiceSchnelligkeitZufrieden">
                <option value="---"<?php e(!$value || $value=='---', ' selected')?>>---</option>
                <option value="Ja"<?php e($value=='Ja', ' selected')?>>Ja</option>
                <option value="Nein"<?php e($value=='Nein', ' selected')?>>Nein</option>
            </select>
        </div>
        <div class="mb-6">
            <label>.. wenn nicht, was könnte besser gemacht werden?</label>
            <textarea name="ServiceSchnelligkeitWas" class="form-input placeholder-orange-medium placeholder-opacity-100<?php e($form->error('ServiceSchnelligkeitWas'), ' error') ?>" style="min-height: 10rem"><?= $form->old('ServiceSchnelligkeitWas') ?></textarea>
        </div>
    </div>

    <div class="mb-12">
        <p>Welche Öffnungszeiten wünschen Sie sich?</p>
        <div class="mb-6">
            <label>Montag - Freitag:</label>
            <input class="form-input placeholder-orange-medium placeholder-opacity-100<?php e($form->error('OeffnungszeitenWerktag'), ' error') ?>" name="OeffnungszeitenWerktag" type="text" value="<?= $form->old('OeffnungszeitenWerktag') ?>">
        </div>
        <div class="mb-6">
            <label>Samstag:</label>
            <input class="form-input placeholder-orange-medium placeholder-opacity-100<?php e($form->error('OeffnungszeitenSamstag'), ' error') ?>" name="OeffnungszeitenSamstag" type="text" value="<?= $form->old('OeffnungszeitenSamstag') ?>">
        </div>
    </div>

    <div class="mb-12">
        <div class="mb-6">
            <label>Wären Sie grundsätzlich bereit, sich an einem genossenschaftlichen Betrieb des FUNDEVOGELs durch den Beitritt zur Genossenschaft und den Kauf von Genossenschaftsanteilen zu beteiligen?</label>
            <?php $value = $form->old('BeitrittGenoVorstellbar') ?>
            <select class="form-select" name="BeitrittGenoVorstellbar">
                <option value="---"<?php e(!$value || $value=='---', ' selected')?>>---</option>
                <option value="Ja"<?php e($value=='Ja', ' selected')?>>Ja</option>
                <option value="Nein"<?php e($value=='Nein', ' selected')?>>Nein</option>
            </select>
        </div>
        <div class="mb-6">
            <label>Welchen Betrag (Mindestzeichnung 100 €) wären Sie bereit zu investieren?</label>
            <?php $value = $form->old('HoeheAnteile') ?>
            <select class="form-select" name="HoeheAnteile">
                <option value="---"<?php e(!$value || $value=='---', ' selected')?>>---</option>
                <option value="100 €"<?php e($value=='100 €', ' selected')?>>100 €</option>
                <option value="200 €"<?php e($value=='200 €', ' selected')?>>200 €</option>
                <option value="300 €"<?php e($value=='300 €', ' selected')?>>300 €</option>
                <option value="400 €"<?php e($value=='400 €', ' selected')?>>400 €</option>
                <option value="500 €"<?php e($value=='500 €', ' selected')?>>500 €</option>
            </select>
        </div>
        <div class="mb-6">
            <label>.. anderer Betrag:</label>
            <input class="form-input placeholder-orange-medium placeholder-opacity-100<?php e($form->error('HoeheAnteileAlternativ'), ' error') ?>" name="HoeheAnteileAlternativ" type="text" value="<?= $form->old('HoeheAnteileAlternativ') ?>">
        </div>
    </div>

    <div class="mb-12">
        <div class="mb-6">
            <label>Können Sie sich eine ehrenamtliche Tätigkeit oder solidarische gelegentliche stundenweise Mithilfe innerhalb oder außerhalb des Ladens vorstellen (z. B. Betreuung eines Büchertischs oder einer Veranstaltung, Liefern von Bestellungen, Bücher räumen oä)?</label>
            <?php $value = $form->old('MithilfeVorstellbar') ?>
            <select class="form-select" name="MithilfeVorstellbar">
                <option value="---"<?php e(!$value || $value=='---', ' selected')?>>---</option>
                <option value="Ja"<?php e($value=='Ja', ' selected')?>>Ja</option>
                <option value="Nein"<?php e($value=='Nein', ' selected')?>>Nein</option>
            </select>
        </div>
        <div class="mb-6">
            <label>.. wenn ja, zB diese Tätigkeiten:</label>
            <textarea name="MithilfeWas" class="form-input placeholder-orange-medium placeholder-opacity-100<?php e($form->error('MithilfeWas'), ' error') ?>" style="min-height: 10rem"><?= $form->old('MithilfeWas') ?></textarea>
        </div>
    </div>

    <?= csrf_field(); ?>
    <?= honeypot_field(); ?>
    <input class="h-16 px-4 sketch text-xl sm:text-3xl text-white text-shadow bg-red-light hover:bg-red-medium rounded-lg select-none transition-all cursor-pointer" type="submit" value="<?= t('Absenden') ?>">
</form>
