<?php

namespace DdOpenTracingBundle\Transports;

use DdTrace\EncoderFactory;
use DdTrace\Transports\Http;
use DdTrace\Transports\Noop;
use GuzzleHttp\ClientInterface;
use Psr\Log\LoggerInterface;

class NoopFactory
{
    public function build()
    {
        return new Noop();
    }
}
