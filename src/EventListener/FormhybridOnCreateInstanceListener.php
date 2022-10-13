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
use HeimrichHannot\EncoreContracts\PageAssetsTrait;
use HeimrichHannot\FormHybrid\Form;
use Symfony\Contracts\Service\ServiceSubscriberInterface;

/**
 * @Hook("formhybridOnCreateInstance")
 */
class FormhybridOnCreateInstanceListener implements ServiceSubscriberInterface
{
    use PageAssetsTrait;

    /**
     * @param Form $form
     * @param $varConfig
     * @param int $id
     */
    public function __invoke(Form $form, $varConfig = null, $id = 0): void
    {
        $this->addPageEntrypoint('contao-formhybrid-compatibility-bundle');
    }
}