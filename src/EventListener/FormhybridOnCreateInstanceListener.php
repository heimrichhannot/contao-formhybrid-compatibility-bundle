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
use HeimrichHannot\FormhybridCompatibilityBundle\Asset\FrontendAsset;
use HeimrichHannot\FormHybrid\Form;

/**
 * @Hook("formhybridOnCreateInstance")
 */
class FormhybridOnCreateInstanceListener
{
    private FrontendAsset $frontendAsset;

    /**
     * FormhybridOnCreateInstanceListener constructor.
     */
    public function __construct(FrontendAsset $frontendAsset)
    {
        $this->frontendAsset = $frontendAsset;
    }

    /**
     * @param Form $form
     * @param $varConfig
     * @param int $id
     */
    public function __invoke(Form $form, $varConfig = null, $id = 0): void
    {
        $this->frontendAsset->addFrontendAssets();
    }
}