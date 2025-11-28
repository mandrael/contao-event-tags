<?php

namespace Mandrael\EventTagsBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class MandraelEventTagsBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        // KORREKTUR: Pfad angepasst auf Resources/contao/config
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__ . '/Resources/contao/config')
        );
        $loader->load('services.yaml');
    }
}
