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
     * @param QUI\Interfaces\Projects\Site $Site
     * @return void
     * @throws QUI\Exception
     */
    public static function onSiteSave(QUI\Interfaces\Projects\Site $Site): void
    {
        $Project   = $Site->getProject();
        $cacheName = md5($Project->getName() . $Project->getLang() . $Site->getId());

        try {
            QUI\Cache\Manager::clear('quiqqer/templateBasicCompany/' . $cacheName);
        } catch (QUI\Exception $Exception) {
            QUI\System\Log::writeException($Exception);
        }
    }
}
