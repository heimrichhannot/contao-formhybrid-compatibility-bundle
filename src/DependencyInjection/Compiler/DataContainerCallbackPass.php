<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2021 Heimrich & Hannot GmbH
 *
 * @author  Thomas Körner <t.koerner@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */


namespace HeimrichHannot\ContaoFormhybridCompatibilityBundle\DependencyInjection\Compiler;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class DataContainerCallbackPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('contao.listener.data_container_callback')) {
            return;
        }

        $definition = $container->getDefinition('contao.listener.data_container_callback');


        $callbacks = $definition->getMethodCalls();
        if (empty($callbacks)) {
            return;
        }
        $callbacks = array_column($callbacks, 1, 0);
        if (!isset($callbacks['setCallbacks'])) {
            return;
        }
        $callbacks = $callbacks['setCallbacks'];

        $serviceIds = $container->findTaggedServiceIds('contao.callback');
        $callbackUpdates = [];
        foreach ($serviceIds as $serviceId => $tags) {
            if (!in_array('config.onload', array_column($tags, 'target'))) {
                continue;
            }

            if (empty(array_column($tags, 'formhybrid'))) {
                continue;
            }

            if ($container->hasAlias($serviceId)) {
                $serviceId = (string) $container->getAlias($serviceId);
            }

            foreach ($tags as $tag) {
                if (!in_array('config.onload', $tag) || !isset($tag['formhybrid']) || true !== $tag['formhybrid'] ) {
                    continue;
                }
                $prioroty = isset($tag['prority']) ? $tag['prority'] : 0;
                $callbackUpdates[] = [$tag['table']]



            }

        }



//        $callbacks = $this->getCallbacks($container);


//        if (empty($callbacks)) {
//            return;
//        }
//
//        $definition = $container->getDefinition('contao.listener.data_container_callback');
//        $definition->addMethodCall('setCallbacks', [$callbacks]);
    }

    /**
     * @return array<string, array<int, array<string>>>
     */
    private function getCallbacks(ContainerBuilder $container): array
    {
        $callbacks = [];
        $serviceIds = $container->findTaggedServiceIds('contao.callback');

        foreach ($serviceIds as $serviceId => $tags) {
            if ($container->hasAlias($serviceId)) {
                $serviceId = (string) $container->getAlias($serviceId);
            }

            $definition = $container->findDefinition($serviceId);
            $definition->setPublic(true);

            foreach ($tags as $attributes) {
//                $this->addCallback($callbacks, $serviceId, $definition->getClass(), $attributes);
            }
        }

        return $callbacks;
    }

    private function addCallback(array &$callbacks, string $serviceId, string $class, array $attributes): void
    {
        if (!isset($attributes['table'])) {
            throw new InvalidDefinitionException(sprintf('Missing table attribute in tagged callback service ID "%s"', $serviceId));
        }

        if (!isset($attributes['target'])) {
            throw new InvalidDefinitionException(sprintf('Missing target attribute in tagged callback service ID "%s"', $serviceId));
        }

        if (
            '_callback' !== substr($attributes['target'], -9)
            && false === strpos($attributes['target'], '.panel_callback.')
            && !\in_array(substr($attributes['target'], -7), ['.wizard', '.xlabel'], true)
        ) {
            $attributes['target'] .= '_callback';
        }

        $priority = (int) ($attributes['priority'] ?? 0);

        $callbacks[$attributes['table']][$attributes['target']][$priority][] = [
            $serviceId,
            $this->getMethod($attributes, $class, $serviceId),
        ];
    }
}