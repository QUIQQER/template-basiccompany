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
        $Project   = $params['Project'];
        $Site      = $params['Site'];
        $cacheName = md5($Project->getName().$Project->getLang().$Site->getId());

        try {
            return QUI\Cache\Manager::get(
                'quiqqer/templateBasicCompany/'.$cacheName
            );
        } catch (QUI\Exception $Exception) {
        }

        $Template = $params['Template'];
        $Engine   = $params['Engine'];
        $lang     = $Project->getLang();

        /**
         * Body Class
         */
        $bodyClass      = '';
        $showBreadcrumb = false;
        $showHeader     = true;

        switch ($Template->getLayoutType()) {
            case 'layout/startPage':
                $bodyClass      = 'homepage';
                $showBreadcrumb = $Project->getConfig('templateBasicCompany.settings.showBreadcrumbStartPage');
                $showHeader     = $Project->getConfig('templateBasicCompany.settings.showHeaderStartPage');

                break;

            case 'layout/noSidebar':
                $bodyClass      = 'no-sidebar';
                $showBreadcrumb = $Project->getConfig('templateBasicCompany.settings.showBreadcrumbNoSidebar');
                $showHeader     = $Project->getConfig('templateBasicCompany.settings.showHeaderNoSidebar');

                break;

            case 'layout/rightSidebar':
                $bodyClass      = 'right-sidebar';
                $showBreadcrumb = $Project->getConfig('templateBasicCompany.settings.showBreadcrumbRightSidebar');
                $showHeader     = $Project->getConfig('templateBasicCompany.settings.showHeaderRightSidebar');

                break;

            case 'layout/leftSidebar':
                $bodyClass      = 'left-sidebar';
                $showBreadcrumb = $Project->getConfig('templateBasicCompany.settings.showBreadcrumbLeftSidebar');
                $showHeader     = $Project->getConfig('templateBasicCompany.settings.showHeaderLeftSidebar');

                break;
        }

        /* site own show header */
        switch ($params['Site']->getAttribute('templateBasicCompany.showEmotion')) {
            case 'show':
                $showHeader = true;
                break;
            case 'hide':
                $showHeader = false;
        }

        /**
         * full size
         */
        $fullsize     = false;
        $pageMaxWidth = (int)$Project->getConfig('templateBasicCompany.settings.pageMaxWidth');

        if (!$pageMaxWidth) {
            $fullsize = true;
        }

        /***
         * Mega menu settings
         */
        $homeLink     = false;
        $homeLinkText = '';

        if ($Project->getConfig('templateBasicCompany.settings.homeLink')) {
            $homeLink = $Project->getConfig('templateBasicCompany.settings.homeLink');
        }

        if ($Project->getConfig('templateBasicCompany.settings.homeLinkText')) {
            $text = json_decode($Project->getConfig('templateBasicCompany.settings.homeLinkText'), true);

            if (isset($text[$lang]) && $text[$lang] !== '') {
                $homeLinkText = $text[$lang];
            }
        }

        $settingsCSS = include 'settings.css.php';

        $config = [
            'settingsCSS'    => '<style>'.$settingsCSS.'</style>',
            'bodyClass'      => $bodyClass,
            'showBreadcrumb' => $showBreadcrumb,
            'showHeader'     => $showHeader,
            'typeClass'      => 'type-'.str_replace(['/', ':'], '-', $Site->getAttribute('type')),
            'fullsize'       => $fullsize,
            'ownSideType'    => strpos($Site->getAttribute('type'), 'quiqqer/template-basiccompany:') !== false ? 1 : 0,
            'quiTplType'     => $Project->getConfig('templateBasicCompany.settings.standardType'),
            'homeLink'       => $homeLink,
            'homeLinkText'   => $homeLinkText
        ];

        // set cache
        QUI\Cache\Manager::set(
            'quiqqer/templateBasicCompany/'.$cacheName,
            $config
        );

        return $config;
    }
}
