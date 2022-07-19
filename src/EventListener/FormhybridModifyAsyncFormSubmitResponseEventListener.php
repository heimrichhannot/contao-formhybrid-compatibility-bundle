<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2021 Heimrich & Hannot GmbH
 *
 * @author  Thomas Körner <t.koerner@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */


namespace HeimrichHannot\FormhybridCompatibilityBundle\EventListener;


use Contao\CoreBundle\ServiceAnnotation\Hook;
use HeimrichHannot\FormHybrid\Event\FormhybridModifyAsyncFormSubmitResponseEvent;

/**
 * @Hook(FormhybridModifyAsyncFormSubmitResponseEvent::NAME)
 */
class FormhybridModifyAsyncFormSubmitResponseEventListener
{
    public function __invoke(FormhybridModifyAsyncFormSubmitResponseEvent $event): void
    {
        $responseData = $event->getData();
        $responseData['submitted'] = !$event->getDc()->isDoNotSubmit();
        $event->setData($responseData);
    }

}