<?php

$GLOBALS['TL_HOOKS']['formhybridOnCreateInstance'][]            = [
    \HeimrichHannot\ContaoFormhybridCompatibilityBundle\EventListener\FormhybridOnCreateInstanceListener::class, '__invoke'];
$GLOBALS['TL_HOOKS'][\HeimrichHannot\FormHybrid\Event\FormhybridBeforeCreateWidgetEvent::NAME][] = [
    \HeimrichHannot\ContaoFormhybridCompatibilityBundle\EventListener\FormhybridBeforeCreateWidgetEventListener::class, '__invoke'];