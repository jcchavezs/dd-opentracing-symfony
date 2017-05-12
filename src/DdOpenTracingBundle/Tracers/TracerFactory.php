<?php

namespace DdOpenTracingBundle\Tracers;

use DdTrace\Buffer;
use DdTrace\EncoderFactory;
use DdTrace\Tracer as DdTracer;
use DdTrace\Transport;
use DdTrace\Transports\Http;
use DdOpenTracing\Tracer;
use GuzzleHttp\ClientInterface;
use OpenTracing\GlobalTracer;
use Psr\Log\LoggerInterface;

class TracerFactory
{
    public function __construct(
        LoggerInterface $logger,
        ClientInterface $client,
        EncoderFactory $encoderFactory,
        Transport $transport

    ) {
        $this->client = $client;
        $this->logger = $logger;
        $this->encoderFactory = $encoderFactory;
        $this->transport = $transport;
    }
    public function build()
    {
        $transport = new Http($this->client, $this->logger, $this->encoderFactory);
        $buffer = new Buffer();
        $ddTracer = new DdTracer($buffer, $this->logger, $transport);
        $tracer = new Tracer($ddTracer, $this->logger);

        GlobalTracer::setGlobalTracer($tracer);

        return $tracer;
    }
}
