<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2021 Heimrich & Hannot GmbH
 *
 * @author  Thomas Körner <t.koerner@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */


namespace HeimrichHannot\ContaoFormhybridCompatibilityBundle\EventListener;


use HeimrichHannot\FormHybrid\Event\FormhybridModifyAsyncFormSubmitResponseEvent;

class FormhybridModifyAsyncFormSubmitResponseEventListener
{
    public function __invoke(FormhybridModifyAsyncFormSubmitResponseEvent $event)
    {
        $responseData = $event->getData();
        $responseData['submitted'] = !$event->getDc()->isDoNotSubmit();
        $event->setData($responseData);
    }

}