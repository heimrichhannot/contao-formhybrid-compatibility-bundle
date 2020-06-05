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


use HeimrichHannot\ContaoFormhybridCompatibilityBundle\Asset\FrontendAsset;
use HeimrichHannot\FormHybrid\Form;

class FormhybridOnCreateInstanceListener
{
    /**
     * @var FrontendAsset
     */
    private $frontendAsset;

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
    public function __invoke(Form $form, $varConfig = null, $id = 0)
    {
        $this->frontendAsset->addFrontendAssets();
        return;
    }
}