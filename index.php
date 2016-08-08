<?php

/**
 * Emotion
 */

\QUI\Utils\Site::setRecursivAttribute($Site, 'image_emotion');


/**
 * Background
 */

$Background = false;

if ($Project->getConfig('templateBasicCompany.settings.pageBackground')) {
    try {
        $Background = QUI\Projects\Media\Utils::getImageByUrl(
            $Project->getConfig('templateBasicCompany.settings.pageBackground')
        );
    } catch (QUI\Exception $Exception) {
        \QUI\System\Log::writeRecursive($Exception->getMessage());
    }
}

/**
 * Project Logo
 */

$logo = false;
$configLogo = $Project->getConfig('templateBasicCompany.settings.logo');

if (QUI\Projects\Media\Utils::isMediaUrl($configLogo)) {
    $logo = $configLogo;
}

/**
 * Project Logo Small
 */

$logoSmall = false;
$configLogoSmall = $Project->getConfig('templateBasicCompany.settings.logoSmall');

if (QUI\Projects\Media\Utils::isMediaUrl($configLogoSmall)) {
    $logoSmall = $configLogoSmall;
}


/**
 * no header?
 */

$noHeader = false;

switch ($Template->getLayoutType()) {
    case 'layout/rightSidebar':
        $noHeader = $Project->getConfig('templateBasicCompany.settings.noHeaderRightSidebar');
        break;

    case 'layout/leftSidebar':
        $noHeader = $Project->getConfig('templateBasicCompany.settings.noHeaderLeftSidebar');
        break;

    case 'layout/noSidebar':
        $noHeader = $Project->getConfig('templateBasicCompany.settings.noHeaderNoSidebar');
        break;
}

/**
 * colors
 */

$colorFooterBackground = '#414141';
$colorFooterFont = '#D1D1D1';
$colorMain = '#dd151b';
$buttonFontColor = '#ffffff';
$colorBackground = '#F7F7F7';
$colorFooterLinks = '#E6E6E6';
$colorMainContentBg = '#ffffff';
$colorMainContentFont = '5d5d5d';

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

if ($Project->getConfig('templateBasicCompany.settings.colorMainContentFont')) {
    $colorMainContentFont = $Project->getConfig('templateBasicCompany.settings.colorMainContentFont');
}


$Engine->assign(array(
    'colorFooterBackground' => $colorFooterBackground,
    'colorFooterFont'       => $colorFooterFont,
    'colorMain'             => $colorMain,
    'buttonFontColor'       => $buttonFontColor,
    'colorBackground'       => $colorBackground,
    'colorFooterLinks'      => $colorFooterLinks,
    'colorMainContentBg'    => $colorMainContentBg,
    'colorMainContentFont'  => $colorMainContentFont,
    'navPos'                => $Project->getConfig('templateBasicCompany.settings.navPos'),
    'pageMaxWidth'          => $Project->getConfig('templateBasicCompany.settings.pageMaxWidth'),
    'headerHeight'          => $Project->getConfig('templateBasicCompany.settings.headerHeight'),
    'headerHeightValue'     => $Project->getConfig('templateBasicCompany.settings.headerHeightValue'),
    'Background'            => $Background,
    'bgColorSwitcherPrefix' => $Project->getConfig('templateBasicCompany.settings.bgColorSwitcherPrefix'),
    'bgColorSwitcherSuffix' => $Project->getConfig('templateBasicCompany.settings.bgColorSwitcherSuffix'),
    'shadow'                => $Project->getConfig('templateBasicCompany.settings.shadow'),
    'menuShadow'            => $Project->getConfig('templateBasicCompany.settings.menuShadow'),
    'headerImagePosition'   => $Project->getConfig('templateBasicCompany.settings.headerImagePosition'),
    'logoHeight'            => $Project->getConfig('templateBasicCompany.settings.logoHeight')
));

/**
 * full size
 */

$fullsize = false;
$pageMaxWidth = (int)$Project->getConfig('templateBasicCompany.settings.pageMaxWidth');

if (!$pageMaxWidth) {
    $fullsize = true;
}


/**
 * own site type?
 */

$Engine->assign(array(
    'logo'          => $logo,
    'logoSmall'     => $logoSmall,
    'fullsize'      => $fullsize,
    'ownSideType'   =>
        strpos($Site->getAttribute('type'), 'quiqqer/template-basiccompany:') !== false
            ? 1 : 0,
    'quiTplType'    => $Project->getConfig('templateBasicCompany.settings.standardType'),
    'BricksManager' => \QUI\Bricks\Manager::init(),
    'noHeader'     => $noHeader
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
    'type-'. str_replace(array('/',':'), '-', $Site->getAttribute('type'))
);
