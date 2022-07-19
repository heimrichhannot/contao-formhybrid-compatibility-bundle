<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2020 Heimrich & Hannot GmbH
 *
 * @author  Thomas Körner <t.koerner@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */


namespace HeimrichHannot\FormhybridCompatibilityBundle\Asset;


use HeimrichHannot\UtilsBundle\Container\ContainerUtil;

class FrontendAsset
{
    /**
     * @var ContainerUtil
     */
    private $containerUtil;
    /**
     * @var \HeimrichHannot\EncoreBundle\Asset\FrontendAsset
     */
    private $encoreFrontendAsset;

    /**
     * FrontendAsset constructor.
     */
    public function __construct(ContainerUtil $containerUtil)
    {
        $this->containerUtil = $containerUtil;
    }


    /**
     * @param \HeimrichHannot\EncoreBundle\Asset\FrontendAsset $encoreFrontendAsset
     */
    public function setEncoreFrontendAsset(\HeimrichHannot\EncoreBundle\Asset\FrontendAsset $encoreFrontendAsset): void
    {
        $this->encoreFrontendAsset = $encoreFrontendAsset;
    }

    public function addFrontendAssets()
    {
        if (!$this->containerUtil->isFrontend()) {
            return;
        }

        if ($this->encoreFrontendAsset) {
            $this->encoreFrontendAsset->addActiveEntrypoint('contao-formhybrid-compatibility-bundle');
        }
    }
}