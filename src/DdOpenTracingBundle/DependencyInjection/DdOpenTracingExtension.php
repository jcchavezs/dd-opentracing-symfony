<?php

namespace DdOpenTracingBundle\DependencyInjection;

use DdOpenTracingBundle\Transports\HttpFactory;
use DdTrace\Encoders\JsonFactory;
use DdTrace\Encoders\MsgPackFactory;
use DdTrace\Encoders\NoopFactory;
use Exception;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use DdOpenTracingBundle\Transports\NoopFactory as TransportNoopFactory;

final class DdOpenTracingExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter(
            'dd_opentracing.encoder_factory',
            $this->resolveEncoderFactory($config['encoder'])
        );

        $container->setParameter(
            'dd_opentracing.transport_factory',
            $this->resolveTransportFactory($config['transport'])
        );

        $container->setParameter(
            'dd_opentracing.datadog.service_url',
            $config['datadog']['service_url']
        );
    }

    private function resolveEncoderFactory($encoderFormat)
    {
        switch ($encoderFormat) {
            case 'noop':
                return NoopFactory::class;
                break;
            case 'msgpack':
                return MsgPackFactory::class;
                break;
            case 'json':
            case '':
                return JsonFactory::class;
                break;
            default:
                throw new Exception('Undefined encoding format.');
        }
    }

    private function resolveTransportFactory($transport)
    {

        switch ($transport) {
            case 'noop':
                return TransportNoopFactory::class;
                break;
            case 'http':
            case '':
                return HttpFactory::class;
                break;
            default:
                throw new Exception('Undefined transport.');
        }
    }
}
