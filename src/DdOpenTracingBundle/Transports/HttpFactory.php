<?php

namespace DdOpenTracingBundle\Transports;

use DdTrace\EncoderFactory;
use DdTrace\Transports\Http;
use GuzzleHttp\ClientInterface;
use Psr\Log\LoggerInterface;

class HttpFactory
{
    private $client;
    private $logger;
    private $encoderFactory;
    private $serviceUrl;

    public function __construct(
        ClientInterface $client,
        LoggerInterface $logger,
        EncoderFactory $encoderFactory,
        $serviceUrl = self::DEFAULT_SERVICE_URL
    ) {
        $this->client = $client;
        $this->logger = $logger;
        $this->encoderFactory = $encoderFactory;
        $this->serviceUrl = $serviceUrl;
    }

    public function build()
    {
        return new Http($this->client, $this->logger, $this->encoderFactory, $this->serviceUrl);
    }
}
