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


use HeimrichHannot\EncoreBundle\Asset\FrontendAsset as EncoreFrontendAsset;
use HeimrichHannot\UtilsBundle\Util\Utils;
use Psr\Container\ContainerInterface;
use Symfony\Contracts\Service\ServiceSubscriberInterface;

class FrontendAsset implements ServiceSubscriberInterface
{
    private ContainerInterface  $container;
    private Utils              $utils;

    /**
     * FrontendAsset constructor.
     */
    public function __construct(ContainerInterface $container, Utils $utils)
    {
        $this->container = $container;
        $this->utils = $utils;
    }

    public function addFrontendAssets()
    {
        if (!$this->utils->container()->isFrontend()) {
            return;
        }

        if (class_exists(EncoreFrontendAsset::class) && $this->container->has(EncoreFrontendAsset::class)) {
            $this->container->get(EncoreFrontendAsset::class)->addActiveEntrypoint('contao-formhybrid-compatibility-bundle');
        }
    }

    public static function getSubscribedServices()
    {
        $services = [];
        if (class_exists(EncoreFrontendAsset::class)) {
            $services[] = EncoreFrontendAsset::class;
        }
        return $services;
    }
}