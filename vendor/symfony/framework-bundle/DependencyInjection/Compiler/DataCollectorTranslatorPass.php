<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Bundle\FrameworkBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Translation\TranslatorBagInterface;

/**
 * @author Christian Flothmann <christian.flothmann@sensiolabs.de>
 */
class DataCollectorTranslatorPass implements CompilerPassInterface
{
    /**
     * @return void
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('translator')) {
            return;
        }

        $translatorClass = $container->getParameterBag()->resolveValue($container->findDefinition('translator')->getClass());

        if (!is_subclass_of($translatorClass, TranslatorBagInterface::class)) {
            $container->removeDefinition('translator.data_collector');
            $container->removeDefinition('data_collector.translation');
        }
    }
}
