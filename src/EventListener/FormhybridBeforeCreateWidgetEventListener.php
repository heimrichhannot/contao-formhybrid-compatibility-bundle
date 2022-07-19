<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2020 Heimrich & Hannot GmbH
 *
 * @author  Thomas Körner <t.koerner@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */


namespace HeimrichHannot\FormhybridCompatibilityBundle\EventListener;


use Contao\CoreBundle\ServiceAnnotation\Hook;
use HeimrichHannot\FormHybrid\Event\FormhybridBeforeCreateWidgetEvent;

/**
 * @Hook(FormhybridBeforeCreateWidgetEvent::NAME)
 */
class FormhybridBeforeCreateWidgetEventListener
{
    public function __invoke(FormhybridBeforeCreateWidgetEvent $event): void
    {
        if (isset($event->getDcaFieldData()['eval']['submitOnChange']) && true === $event->getDcaFieldData()['eval']['submitOnChange']) {
            $widgetData = $event->getWidgetData();
            $widgetData['data-submit-on-change'] = true;
            if ('FormhybridAjaxRequest' ===  substr($widgetData['onchange'], 0, 21)) {
                unset($widgetData['onchange']);
            }
            if ('FormhybridAjaxRequest' ===  substr($widgetData['onclick'], 0, 21)) {
                unset($widgetData['onclick']);
            }
            $event->setWidgetData($widgetData);
        }
    }
}