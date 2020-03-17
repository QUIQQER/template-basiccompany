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
    'Template'      => $Template,
    'BricksManager' => $BricksManager
]);

$settings['BricksManager'] = $BricksManager;


/**
 * colors
 */

$colorFooterBackground = '#414141';
$colorFooterFont       = '#D1D1D1';
$colorMain             = '#dd151b';
$buttonFontColor       = '#ffffff';
$colorBackground       = '#F7F7F7';
$colorFooterLinks      = '#E6E6E6';
$colorMainContentBg    = '#ffffff';
$colorFont             = '#5d5d5d';
$mobileMenuBackground  = '#252122';


if ($Project->getConfig('templateBasicCompany.settings.colorFooterBackground')) {
    $colorFooterBackground = $Project->getConfig('templateBasicCompany.settings.colorFooterBackground');
}

if ($Project->getConfig('templateBasicCompany.settings.colorFooterFont')) {
    $colorFooterFont = $Project->getConfig('templateBasicCompany.settings.colorFooterFont');
}

if ($Project->getConfig('templateBasicCompany.settings.colorMain')) {
    $colorMain = $Project->getConfig('templateBasicCompany.settings.colorMain');
}

if ($Project->getConfig('templateBasicCompany.settings.buttonFontColor')) {
    $buttonFontColor = $Project->getConfig('templateBasicCompany.settings.buttonFontColor');
}

if ($Project->getConfig('templateBasicCompany.settings.colorBackground')) {
    $colorBackground = $Project->getConfig('templateBasicCompany.settings.colorBackground');
}

if ($Project->getConfig('templateBasicCompany.settings.colorFooterLinks')) {
    $colorFooterLinks = $Project->getConfig('templateBasicCompany.settings.colorFooterLinks');
}

if ($Project->getConfig('templateBasicCompany.settings.colorMainContentBg')) {
    $colorMainContentBg = $Project->getConfig('templateBasicCompany.settings.colorMainContentBg');
}

if ($Project->getConfig('templateBasicCompany.settings.colorFont')) {
    $colorFont = $Project->getConfig('templateBasicCompany.settings.colorFont');
}

if ($Project->getConfig('templateBasicCompany.settings.mobileMenuBackground')) {
    $mobileMenuBackground = $Project->getConfig('templateBasicCompany.settings.mobileMenuBackground');
}


$Engine->assign([
    'Convert'               => new \QUI\Utils\Convert(),
    'colorFooterBackground' => $colorFooterBackground,
    'colorFooterFont'       => $colorFooterFont,
    'colorMain'             => $colorMain,
    'mobileMenuBackground'  => $mobileMenuBackground,
    'buttonFontColor'       => $buttonFontColor,
    'colorBackground'       => $colorBackground,
    'colorFooterLinks'      => $colorFooterLinks,
    'colorMainContentBg'    => $colorMainContentBg,
    'colorFont'             => $colorFont,

    'pageMaxWidth'          => $Project->getConfig('templateBasicCompany.settings.pageMaxWidth'),
    'bgColorSwitcherPrefix' => $Project->getConfig('templateBasicCompany.settings.bgColorSwitcherPrefix'),
    'bgColorSwitcherSuffix' => $Project->getConfig('templateBasicCompany.settings.bgColorSwitcherSuffix'),
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
    $logoUrl = $Logo->getSizeCacheUrl(300, 100);
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
