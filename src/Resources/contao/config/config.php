<?php

use HeimrichHannot\ContaoFormhybridCompatibilityBundle\EventListener\FormhybridBeforeCreateWidgetEventListener;
use HeimrichHannot\ContaoFormhybridCompatibilityBundle\EventListener\FormhybridModifyAsyncFormSubmitResponseEventListener;
use HeimrichHannot\ContaoFormhybridCompatibilityBundle\EventListener\FormhybridOnCreateInstanceListener;
use HeimrichHannot\FormHybrid\Event\FormhybridBeforeCreateWidgetEvent;
use HeimrichHannot\FormHybrid\Event\FormhybridModifyAsyncFormSubmitResponseEvent;

$GLOBALS['TL_HOOKS']['formhybridOnCreateInstance'][]                       = [FormhybridOnCreateInstanceListener::class, '__invoke'];
$GLOBALS['TL_HOOKS'][FormhybridBeforeCreateWidgetEvent::NAME][]            = [FormhybridBeforeCreateWidgetEventListener::class, '__invoke'];
$GLOBALS['TL_HOOKS'][FormhybridModifyAsyncFormSubmitResponseEvent::NAME][] = [FormhybridModifyAsyncFormSubmitResponseEventListener::class, '__invoke'];