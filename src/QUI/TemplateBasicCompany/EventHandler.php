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
     * Event : on smarty init
     * @param \Smarty $Smarty - \Smarty
     */
    public static function onSmartyInit($Smarty)
    {
        if (!isset($Smarty->registered_plugins['function']) ||
            !isset($Smarty->registered_plugins['function']['fetch'])
        ) {
            $Smarty->registerPlugin(
                "function",
                "fetch",
                "\\QUI\\TemplateBasicCompany\\EventHandler::fetch"
            );
        }
    }

    /**
     * @param $params
     * @param $Smarty
     * @return string
     */
    public static function fetch($params, $Smarty)
    {
        $template = $params['template'];
        $path     = OPT_DIR.'quiqqer/template-basiccompany/';

        $Engine = QUI::getTemplateManager()->getEngine();
        $Engine->assign($params);

        return $Engine->fetch($path.$template);
    }
}