<?php
/**
 * This file contains \QUI\TemplateBasicCompany\EventHandler
 */

namespace QUI\TemplateBasicCompany;

use QUI;

/**
 * Event Class
 *
 * @author www.pcsg.de (Michael Danielczok)
 */
class EventHandler
{
    /**
     * Clear system cache on project save
     *
     * @return void
     */
    public static function onProjectConfigSave()
    {
        QUI\Cache\Manager::clear('quiqqer/templateBasicCompany');
    }

    /**
     * Clear system cache on site save
     *
     * @param $Site QUI\Projects\Site
     * @return void
     * @throws QUI\Exception
     */
    public static function onSiteSave($Site)
    {
        $Project   = $Site->getProject();
        $cacheName = md5($Project->getName().$Project->getLang().$Site->getId());

        try {
            QUI\Cache\Manager::clear('quiqqer/templateBasicCompany/'.$cacheName);
        } catch (QUI\Exception $Exception) {
            QUI\System\Log::writeException($Exception);
        }
    }
}
