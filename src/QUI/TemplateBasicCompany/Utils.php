<?php

/**
 * This file contains QUI\TemplateBasicCompany\Utils
 */

namespace QUI\TemplateBasicCompany;

use QUI;

/**
 * Help Class for Template Basic Company
 *
 * @return array
 * @author www.pcsg.de (Michael Danielczok)
 *
 * @package QUI\TemplateBasicCompany
 */
class Utils
{
    /**
     * @param array $params
     * @return array
     */
    public static function getConfig($params)
    {
        /* @var $Project QUI\Projects\Project */
        $Project       = $params['Project'];
        $Template      = $params['Template'];
        $Site          = $params['Site'];
        $BricksManager = $params['BricksManager'];

        $cacheName = md5($params['Site']->getId() . $Project->getName() . $Project->getLang());

        try {
            return QUI\Cache\Manager::get(
                'quiqqer/templateBasicCompany/' . $cacheName
            );
        } catch (QUI\Exception $Exception) {
        }

        $config = [];

        /**
         * Background
         */

        $settingsCSS = include 'settings.css.php';

        $config += [
            'settingsCSS'  => '<style>' . $settingsCSS . '</style>',

            'typeClass'    => 'type-' . str_replace(['/', ':'], '-', $params['Site']->getAttribute('type')),
        ];

        /**
         * ALT
         */

//        $showHeader = false;
//        $showTitle  = $Project->getConfig('templateWhoIAm.settings.showTitle');
//        $showShort  = $Project->getConfig('templateWhoIAm.settings.showShort');
//
//        switch ($Template->getLayoutType()) {
//            case 'layout/startPage':
//                $showHeader = $Project->getConfig('templateWhoIAm.settings.showHeaderStartPage');
//                break;
//
//            case 'layout/noSidebar':
//                $showHeader = $Project->getConfig('templateWhoIAm.settings.showHeaderNoSidebar');
//                break;
//        }
//
//        /* site own show header */
//        switch ($params['Site']->getAttribute('templateWhoIAm.showHeader')) {
//            case 'show':
//                $showHeader = true;
//                break;
//            case 'hide':
//                $showHeader = false;
//        }
//
//        /* site own show title */
//        switch ($params['Site']->getAttribute('templateWhoIAm.showTitle')) {
//            case 'show':
//                $showTitle = true;
//                break;
//            case 'hide':
//                $showTitle = false;
//                break;
//        }
//
//        /* site own show short description */
//        switch ($params['Site']->getAttribute('templateWhoIAm.showShort')) {
//            case 'show':
//                $showShort = true;
//                break;
//            case 'hide':
//                $showShort = false;
//                break;
//        }
//
//        /**
//         * Scroll offset
//         */
//        $scrollOffset =
//
//            /**
//             * Menu entries
//             */
//        $subPage = false;
//        $StartPage    = $Site;
//        $menuEntries  = [];
//
//        if ($Site->getId() !== 1) {
//            $subPage   = true;
//            $StartPage = $Project->get(1);
//        }
//
//        $bricks = \array_merge(
//            $BricksManager->getBricksByArea('startpageHeader', $StartPage),
//            $BricksManager->getBricksByArea('startpageContent', $StartPage),
//            $BricksManager->getBricksByArea('headerSuffix', $StartPage),
//            $BricksManager->getBricksByArea('footerPrefix', $StartPage)
//        );
//
//        foreach ($bricks as $Brick) {
//            if (!$Brick->getSetting('navText')) {
//                continue;
//            }
//
//            $navText = $Brick->getSetting('navText');
//
//            if ($Brick->getSetting('navTarget')) {
//                $target = \rawurlencode(str_replace(' ', '-', $Brick->getSetting('navTarget')));
//
//            } else {
//                $target = \rawurlencode(str_replace(' ', '-', $Brick->getSetting('navText')));
//
//            }
//
//            $menuEntries[] = ['navText' => $navText, 'target' => $target];
//        }
//
//        $settingsCSS = include 'settings.css.php';
//
//        $config += [
//            'settingsCSS'  => '<style>' . $settingsCSS . '</style>',
//            'menuEntries'  => $menuEntries,
//            'subPage'      => $subPage,
//            'StartPage'    => $StartPage,
//            'showHeader'   => $showHeader,
//            'showTitle'    => $showTitle,
//            'showShort'    => $showShort,
//            'urlList'      => self::getUrlList($Project),
//            'scrollOffset' => $Project->getConfig('templateWhoIAm.settings.scrollOffset'),
//            'typeClass'    => 'type-' . str_replace(['/', ':'], '-', $params['Site']->getAttribute('type')),
//        ];

        // set cache
        QUI\Cache\Manager::set(
            'quiqqer/templateBasicCompany/' . $cacheName,
            $config
        );

        return $config;
    }
}
