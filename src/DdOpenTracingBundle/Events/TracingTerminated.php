<?php

namespace DdOpenTracingBundle\Events;

use DdOpenTracing\Tracer;
use SimpleBus\Message\Name\NamedMessage;

final class TracingTerminated implements NamedMessage
{
    private $tracer;

    private function __construct(Tracer $tracer)
    {
        $this->tracer = $tracer;
    }

    public static function create(Tracer $tracer)
    {
        return new self($tracer);
    }

    public function tracer()
    {
        return $this->tracer;
    }

    public static function messageName()
    {
        return 'tracing_terminated';
    }
}
