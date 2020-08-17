<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2020 Heimrich & Hannot GmbH
 *
 * @author  Thomas Körner <t.koerner@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */


namespace HeimrichHannot\ContaoFormhybridCompatibilityBundle\EventListener;


use HeimrichHannot\FormHybrid\Event\FormhybridBeforeCreateWidgetEvent;

class FormhybridBeforeCreateWidgetEventListener
{
    public function __invoke(FormhybridBeforeCreateWidgetEvent $event)
    {
        if (isset($event->getDcaFieldData()['eval']['submitOnChange']) && true === $event->getDcaFieldData()['eval']['submitOnChange']) {
            $widgetData = $event->getWidgetData();
            $widgetData['data-submit-on-change'] = true;
            if ('FormhybridAjaxRequest' ===  substr($widgetData['onchange'], 0, 21)) {
                unset($widgetData['onchange']);
            }
            $event->setWidgetData($widgetData);
            return $event;
        }
        return $event;
    }
}