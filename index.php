<?php

$lang = $Project->getLang();

/**
 * Emotion
 */

\QUI\Utils\Site::setRecursiveAttribute($Site, 'image_emotion');


// Inhalts Verhalten
if ($Site->getAttribute('templatePresentation.showTitle') || $Site->getAttribute('templatePresentation.showShort')
) {
    $Template->setAttribute('content-header', false);
}

$BricksManager = \QUI\Bricks\Manager::init();

/**
 * Template config
 */
$settings = QUI\TemplateBasicCompany\Utils::getConfig([
    'Project' => $Project,
    'Site' => $Site,
    'Template' => $Template,
    'Engine' => $Engine
]);

$settings['BricksManager'] = $BricksManager;

/**
 * Menu
 */
$homeLink = false;
$homeLinkText = false;

if (isset($settings['homeLink']) && $settings['homeLink']) {
    $homeLink = true;
}

if (isset($settings['homeLinkText']) && $settings['homeLinkText'] !== '') {
    $homeLinkText = $settings['homeLinkText'];
}

$MegaMenu = null;

if ($Template->getAttribute('template-header')) {
    $MegaMenu = new QUI\Menu\MegaMenu([
        'showStart' => $homeLink,
        'startText' => $homeLinkText,
    ]);

// show text next to the logo
    $logoText = "";
    $logoTitle = $Project->get(1)->getAttribute('title');
    $logoAlt = '';

    if ($Project->getConfig('templateBasicCompany.settings.logoText')) {
        $logoText = '<span class="header-bar-inner-logo-text">' .
            $Project->getConfig('templateBasicCompany.settings.logoText') . '</span>';
    }

    $Logo = $Project->getMedia()->getLogoImage();
    $logoHeight = 60;
    $logoWidth = false;

    if ($Logo) {
        if ($Project->getConfig('templateBasicCompany.settings.logoHeight')
            && $Project->getConfig(
                'templateBasicCompany.settings.logoHeight'
            ) > 0
        ) {
            $logoHeight = $Project->getConfig('templateBasicCompany.settings.logoHeight');
        }

        try {
            $logoWidth = $Logo->getResizeSize(false, $logoHeight)['width'];
        } catch (QUI\Exception $Exception) {
            QUI\System\Log::addNotice($Exception->getMessage());
        }

        $Engine->assign([
            'logoWidth' => $logoWidth,
            'logoHeight' => $logoHeight,
            'Logo' => $Logo,
            'logoText' => $logoText
        ]);

        $MegaMenu->prependHTML($Engine->fetch(dirname(__FILE__) . '/template/menu/prefix.html'));
    }
}

/**
 * Breadcrumb
 */
$Breadcrumb = new QUI\Controls\Breadcrumb();

$Engine->assign($settings);

$Engine->assign([
    'MegaMenu' => $MegaMenu,
    'Breadcrumb' => $Breadcrumb
]);
