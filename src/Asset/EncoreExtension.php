<?php

namespace HeimrichHannot\FormhybridCompatibilityBundle\Asset;

use HeimrichHannot\EncoreContracts\EncoreEntry;
use HeimrichHannot\FormhybridCompatibilityBundle\HeimrichHannotFormhybridCompatibilityBundle;

class EncoreExtension implements \HeimrichHannot\EncoreContracts\EncoreExtensionInterface
{

    /**
     * @inheritDoc
     */
    public function getBundle(): string
    {
        return HeimrichHannotFormhybridCompatibilityBundle::class;
    }

    /**
     * @inheritDoc
     */
    public function getEntries(): array
    {
        return [
            EncoreEntry::create("contao-formhybrid-compatibility-bundle", "assets/js/contao-formhybrid-compatibility-bundle.js")
                ->addJsEntryToRemoveFromGlobals('jquery.formhybrid')
        ];
    }
}