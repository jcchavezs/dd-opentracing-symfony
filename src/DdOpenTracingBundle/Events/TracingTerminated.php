<?php

namespace DdOpenTracingBundle\Events;

use DdOpenTracing\Tracer;

final class TracingTerminated
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
}
