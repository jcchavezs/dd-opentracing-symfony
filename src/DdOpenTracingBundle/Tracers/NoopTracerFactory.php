<?php

namespace DdOpenTracingBundle\Tracers;

use OpenTracing\GlobalTracer;
use OpenTracing\NoopTracer;

class NoopTracerFactory
{
    public function build()
    {
        $tracer = new NoopTracer();

        GlobalTracer::setGlobalTracer($tracer);

        return $tracer;
    }
}
