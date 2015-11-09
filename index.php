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
    'colorBackground'       => $colorBackground,
    'colorFooterLinks'      => $colorFooterLinks,
    'colorMainContentBg'    => $colorMainContentBg,
    'colorMainContentFont'  => $colorMainContentFont,
    'navPos'                => $Project->getConfig('templateBasicCompany.settings.navPos'),
    'pageMaxWidth'          => $Project->getConfig('templateBasicCompany.settings.pageMaxWidth'),
    'Background'            => $Background,
    'bgColorSwitcher'       => $Project->getConfig('templateBasicCompany.settings.bgColorSwitcher'),
    'shadow'                => $Project->getConfig('templateBasicCompany.settings.shadow')
));


/**
 * full size
 */

$fullsize = false;
$pageMaxWidth = (int)$Project->getConfig('templateBasicCompany.settings.pageMaxWidth');

if (!$pageMaxWidth){
    $fullsize = true;
}


/**
 * own site type?
 */

$Engine->assign(array(
    'logo'          => $logo,
    'fullsize'      => $fullsize,
    'ownSideType'   =>
        strpos($Site->getAttribute('type'), 'quiqqer/template-basiccompany:') !== false
            ? 1 : 0,
    'quiTplType'    => $Project->getConfig('templateBasicCompany.settings.standardType'),
    'BricksManager' => \QUI\Bricks\Manager::init(),
    'noHeader'     => $noHeader
));
