<?php

$lang = $Project->getLang();

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
    'Project'  => $Project,
    'Site'     => $Site,
    'Template' => $Template
]);

$settings['BricksManager'] = $BricksManager;

$Engine->assign([
    'pageMaxWidth' => $Project->getConfig('templateBasicCompany.settings.pageMaxWidth')
]);

/**
 * Menu
 */
$homeLink     = false;
$homeLinkText = false;

if (isset($settings['homeLink']) && $settings['homeLink']) {
    $homeLink = true;
}

if (isset($settings['homeLinkText']) && $settings['homeLinkText'] !== '') {
    $homeLinkText = $settings['homeLinkText'];
}

$MegaMenu = new QUI\Menu\MegaMenu([
    'showStart' => $homeLink,
    'startText' => $homeLinkText,
]);

// show text next to the logo
$logoText  = "";
$logoUrl   = $Project->getMedia()->getPlaceholder();
$logoTitle = $Project->get(1)->getAttribute('title');
$logoAlt   = '';

if ($Project->getConfig('templateBasicCompany.settings.logoText')) {
    $logoText = '<span class="header-bar-inner-logo-text">'.
        $Project->getConfig('templateBasicCompany.settings.logoText').'</span>';
}

if ($Project->getMedia()->getLogoImage()) {
    $Logo = $Project->getMedia()->getLogoImage();

    $height = 60;
    $width  = false;
    try {
        $width   = $Logo->getResizeSize(false, $height)['width'];
        $logoUrl = $Logo->getSizeCacheUrl(false, $height);
    } catch (QUI\Exception $Exception) {
        QUI\System\Log::addNotice($Exception->getMessage());
    }

    $logoAltArray = json_decode($Logo->getAttribute('title'), true);

    if (isset($imgTitleArray[$lang])) {
        $logoAlt = $logoAltArray[$lang];
    } else {
        // alt attributes must be defined, otherwise the title comes from the image
        $logoAlt = $logoTitle;
    }

    $Engine->assign([
        'logoWidth'  => $width,
        'logoHeight' => $height,
        'Logo'       => $Logo,
        'logoText'   => $logoText
    ]);

    $MegaMenu->prependHTML($Engine->fetch(dirname(__FILE__).'/template/menu/prefix.html'));
}

/**
 * Breadcrumb
 */
$Breadcrumb = new QUI\Controls\Breadcrumb();

$Engine->assign($settings);

$Engine->assign([
    'MegaMenu'   => $MegaMenu,
    'Breadcrumb' => $Breadcrumb
]);
