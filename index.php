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
 * no header?
 */
$showHeader = true;

switch ($Template->getLayoutType()) {
    case 'layout/startPage':
        $showHeader = $Project->getConfig('templateBasicCompany.settings.showHeaderStartPage');
        break;

    case 'layout/rightSidebar':
        $showHeader = $Project->getConfig('templateBasicCompany.settings.showHeaderRightSidebar');
        break;

    case 'layout/leftSidebar':
        $showHeader = $Project->getConfig('templateBasicCompany.settings.showHeaderLeftSidebar');
        break;

    case 'layout/noSidebar':
        $showHeader = $Project->getConfig('templateBasicCompany.settings.showHeaderNoSidebar');
        break;
}

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


/**
 * no breadcrumb?
 */

$showBreadcrumb = false;

switch ($Template->getLayoutType()) {
    case 'layout/startPage':
        $showBreadcrumb = $Project->getConfig('templateBasicCompany.settings.showBreadcrumbStartPage');
        break;

    case 'layout/noSidebar':
        $showBreadcrumb = $Project->getConfig('templateBasicCompany.settings.showBreadcrumbNoSidebar');
        break;

    case 'layout/rightSidebar':
        $showBreadcrumb = $Project->getConfig('templateBasicCompany.settings.showBreadcrumbRightSidebar');
        break;

    case 'layout/leftSidebar':
        $showBreadcrumb = $Project->getConfig('templateBasicCompany.settings.showBreadcrumbLeftSidebar');
        break;
}



$Engine->assign(array(
    'showBreadcrumb'        => $showBreadcrumb,
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
    'headerHeight'          => $Project->getConfig('templateBasicCompany.settings.headerHeight'),
    'headerHeightValue'     => $Project->getConfig('templateBasicCompany.settings.headerHeightValue'),
    'Background'            => $Background,
    'bgColorSwitcherPrefix' => $Project->getConfig('templateBasicCompany.settings.bgColorSwitcherPrefix'),
    'bgColorSwitcherSuffix' => $Project->getConfig('templateBasicCompany.settings.bgColorSwitcherSuffix'),
    'headerImagePosition'   => $Project->getConfig('templateBasicCompany.settings.headerImagePosition'),
    'logo'                  => $Project->getMedia()->getLogoImage(),
    'showHeader'            => $showHeader
));



/**
 * full size
 */

$fullsize     = false;
$pageMaxWidth = (int)$Project->getConfig('templateBasicCompany.settings.pageMaxWidth');

if (!$pageMaxWidth) {
    $fullsize = true;
}


/**
 * own site type?
 */

$Engine->assign(array(
    'fullsize'      => $fullsize,
    'ownSideType'   =>
        strpos($Site->getAttribute('type'), 'quiqqer/template-basiccompany:') !== false
            ? 1 : 0,
    'quiTplType'    => $Project->getConfig('templateBasicCompany.settings.standardType'),
    'BricksManager' => \QUI\Bricks\Manager::init()
));


/**
 * Body Class
 */
$bodyClass = '';

switch ($Template->getLayoutType()) {
    case 'layout/startpage':
        $bodyClass = 'homepage';
        break;

    case 'layout/leftSidebar':
        $bodyClass = 'left-sidebar';
        break;

    case 'layout/rightSidebar':
        $bodyClass = 'right-sidebar';
        break;

    default:
        $bodyClass = 'no-sidebar';
}

$Engine->assign('bodyClass', $bodyClass);

$Engine->assign(
    'typeClass',
    'type-' . str_replace(array('/', ':'), '-', $Site->getAttribute('type'))
);

/**
 * Mega menu
 */
$MegaMenu = new QUI\Menu\MegaMenu(array(
    'showStart' => false
));

// show text next to the logo
$logoText = "";
if ($Project->getConfig('templateBasicCompany.settings.logoText')) {
    $logoText = '<span class="header-bar-inner-logo-text">' .
        $Project->getConfig('templateBasicCompany.settings.logoText') . '</span>';
}

$alt = "QUIQQER";
$logoUrl = $Project->getMedia()->getPlaceholder();
if ($Project->getMedia()->getLogoImage()) {
    $Logo = $Project->getMedia()->getLogoImage();
    $alt = $Logo->getAttribute('title');
    $logoUrl = $Logo->getSizeCacheUrl(500, 300);
}

$MegaMenu->prependHTML(
    '<div class="header-bar-inner-logo">
                <a href="' . URL_DIR . '" class="page-header-logo">
                <img src="' . $logoUrl . '"/>' . $logoText . '</a>
            </div>'
);

$Engine->assign('MegaMenu', $MegaMenu);

/**
 * Breadcrumb
 */
$Breadcrumb = new QUI\Controls\Breadcrumb();

$Engine->assign('Breadcrumb', $Breadcrumb);


$Engine->assign($settings);