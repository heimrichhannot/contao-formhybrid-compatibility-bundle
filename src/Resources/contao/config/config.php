<?php

$GLOBALS['TL_HOOKS']['formhybridOnCreateInstance'][] = [
    \HeimrichHannot\ContaoFormhybridCompatibilityBundle\EventListener\FormhybridOnCreateInstanceListener::class, '__invoke'];