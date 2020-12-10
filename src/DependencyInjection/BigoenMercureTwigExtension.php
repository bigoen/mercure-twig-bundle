<?php

declare(strict_types=1);

namespace Bigoen\MercureTwigBundle\DependencyInjection;

use Exception;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
class BigoenMercureTwigExtension extends Extension implements PrependExtensionInterface
{
    /**
     * @throws Exception
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('bigoen_mercure_twig.public_url', $config['public_url']);
        $container->setParameter('bigoen_mercure_twig.subscriber_js', $config['subscriber_js']);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yaml');
    }

    public function prepend(ContainerBuilder $container): void
    {
        // Auto-enable the fragments
        $container->prependExtensionConfig('framework', [
            'fragments' => [
                'path' => '/_fragment',
            ],
        ]);
    }
}
