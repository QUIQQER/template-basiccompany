<?php

/**
 * Emotion
 */

\QUI\Utils\Site::setRecursiveAttribute($Site, 'image_emotion');


// Inhalts Verhalten
if ($Site->getAttribute('templatePresentation.showTitle') ||
    $Site->getAttribute('templatePresentation.showShort')
) {
    $Template->setAttribute('content-header', false);
}

$BricksManager = \QUI\Bricks\Manager::init();

/**
 * Template config
 */
$settings = QUI\TemplateBasicCompany\Utils::getConfig([
    'Project'       => $Project,
    'Site'          => $Site,
    'Template'      => $Template
]);

$settings['BricksManager'] = $BricksManager;

$Engine->assign([
    'pageMaxWidth'          => $Project->getConfig('templateBasicCompany.settings.pageMaxWidth'),
    'logo'                  => $Project->getMedia()->getLogoImage(),
]);

/**
 * Mega menu
 */
$MegaMenu = new QUI\Menu\MegaMenu([
    'showStart' => false
]);

// show text next to the logo
$logoText = "";
$logoUrl  = $Project->getMedia()->getPlaceholder();

if ($Project->getConfig('templateBasicCompany.settings.logoText')) {
    $logoText = '<span class="header-bar-inner-logo-text">' .
        $Project->getConfig('templateBasicCompany.settings.logoText') . '</span>';
}

if ($Project->getMedia()->getLogoImage()) {
    $Logo    = $Project->getMedia()->getLogoImage();
    $logoUrl = $Logo->getSizeCacheUrl(300, 60);
}

$MegaMenu->prependHTML(
    '<div class="header-bar-inner-logo">
        <a href="' . URL_DIR . '" class="page-header-logo">
        <img src="' . $logoUrl . '"/>' . $logoText . '</a>
    </div>'
);

/**
 * Breadcrumb
 */
$Breadcrumb = new QUI\Controls\Breadcrumb();

$Engine->assign($settings);

$Engine->assign([
    'MegaMenu'   => $MegaMenu,
    'Breadcrumb' => $Breadcrumb
]);
