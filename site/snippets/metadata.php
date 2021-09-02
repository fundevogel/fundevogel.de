<?php
    # Title
    $title = $page->isHomePage()
        ? $page->meta_title()->or($site->title())
        : $page->meta_title()->or($page->title()) . ' | ' . $site->meta_title()->or($site->title())
    ;

    # Description
    $description = $page->meta_description()->or($page->text()->excerpt(160))->or($site->meta_description());
?>

<!-- Schema -->
<style itemscope itemtype="https://schema.org/WebSite" itemref="schema_name schema_description schema_image"></style>

<!-- Title -->
<title><?= $title ?></title>
<meta id="schema_name" itemprop="name" content="<?= $title ?>">

<!-- Description -->
<meta name="description" content="<?= htmlspecialchars($description) ?>">
<meta id="schema_description" itemprop="description" content="<?= htmlspecialchars($description) ?>">

<!-- Keywords -->
<meta name="keywords" content="<?= $page->meta_keywords()->or($site->meta_keywords()) ?>">

<!-- Canonical & language URLs -->
<link rel="canonical" href="<?= $page->meta_canonical_url()->or($page->url()) ?>">
<?php foreach (kirby()->languages() as $language) : ?>
<?php if ($language->code() == kirby()->language()) continue ?>
<link rel="alternate" hreflang="<?= $language->code() ?>" href="<?= $page->url($language->code()) ?>">
<?php endforeach ?>

<!-- Image -->
<?php if ($metaImage = $page->getMetaImage()) : ?>
<meta id="schema_image" itemprop="image" content="<?= $metaImage->url() ?>">
<?php endif ?>

<!-- Author -->
<meta name="author" content="<?= $page->meta_author()->or($site->meta_author()) ?>">

<!-- Last modified -->
<meta name="date" content="<?= $page->modified('Y-m-d') ?>" scheme="YYYY-MM-DD">

<!-- Open Graph -->
<meta property="og:title" content="<?= $page->og_title()->or($page->meta_title())->or($site->og_title())->or($site->meta_title())->or($page->title()) ?>">
<meta property="og:description" content="<?= htmlspecialchars($page->og_description()->or($description)) ?>">
<?php if ($opengraphImage = $page->getOpengraphImage()) : ?>
<meta property="og:image" content="<?= $opengraphImage->url() ?>">
<meta property="og:width" content="<?= $opengraphImage->width() ?>">
<meta property="og:height" content="<?= $opengraphImage->height() ?>">
<?php endif ?>
<meta property="og:site_name" content="<?= $page->og_site_name()->or($site->og_site_name()) ?>">
<meta property="og:url" content="<?= $page->og_url()->or($page->url()) ?>">
<meta property="og:type" content="<?= $page->og_type()->or($site->og_type()) ?>">
<?php if ($page->og_determiner()->or($site->og_determiner())->isNotEmpty()) : ?>
<meta property="og:determiner" content="<?= $page->og_determiner()->or($site->og_determiner())->or('auto') ?>">
<?php endif ?>
<?php if ($page->og_audio()->isNotEmpty()) : ?>
<meta property="og:audio" content="<?= $page->og_audio() ?>">
<?php endif ?>
<?php if ($page->og_video()->isNotEmpty()) : ?>
<meta property="og:video" content="<?= $page->og_video() ?>">
<?php endif ?>
<?php if ($kirby->language() !== null) : ?>
<meta property="og:locale" content="<?= $kirby->language()->locale(LC_ALL) ?>">
<?php foreach($kirby->languages() as $language) : ?>
<?php if ($language !== $kirby->language()) : ?>
<meta property="og:locale:alternate" content="<?= $language->locale(LC_ALL) ?>">
<?php endif ?>
<?php endforeach ?>
<?php endif ?>
<?php
    $ogAuthors = $page->og_type_article_author()->or($site->og_type_article_author());
    foreach ($ogAuthors->toStructure() as $ogAuthor) :
?>
<meta property="article:author" content="<?= $ogAuthor->url()->html() ?>">
<?php endforeach ?>

<!-- Twitter Card -->
<meta name="twitter:card" content="<?= $page->twitter_card_type()->or($site->twitter_card_type())->value() ?>">
<meta name="twitter:title" content="<?= $page->twitter_title()->or($page->meta_title())->or($site->twitter_title())->or($site->meta_title())->or($page->title()) ?>">
<meta name="twitter:description" content="<?= htmlspecialchars($page->twitter_description()->or($description)) ?>">
<?php if ($twittercardImage = $page->getTwittercardImage()) : ?>
<meta name="twitter:image" content="<?= $twittercardImage->url() ?>">
<?php endif ?>
<meta name="twitter:site" content="<?= $page->twitter_site()->or($site->twitter_site()) ?>">
<meta name="twitter:creator" content="<?= $page->twitter_creator()->or($site->twitter_creator()) ?>">
