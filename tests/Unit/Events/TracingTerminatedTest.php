<?php

namespace DdOpenTracingBundleTests\Unit\Events;

use DdOpenTracing\Tracer;
use DdOpenTracingBundle\Events\TracingTerminated;
use PHPUnit_Framework_TestCase;

final class TracingTerminatedTest extends PHPUnit_Framework_TestCase
{
    private $tracer;

    /** @var TracingTerminated */
    private $tracingTerminated;

    public function testTracingTerminatedIsSuccessfullyCreate()
    {
        $this->givenATracer();
        $this->whenCreatingATracingTerminatedEvent();
        $this->thenTheTracingTerminatedEventIsCreated();
    }

    private function givenATracer()
    {
        $this->tracer = Tracer::noop();
    }

    private function whenCreatingATracingTerminatedEvent()
    {
        $this->tracingTerminated = TracingTerminated::create($this->tracer);
    }

    private function thenTheTracingTerminatedEventIsCreated()
    {
        $this->assertEquals('tracing_terminated', $this->tracingTerminated->messageName());
    }
}
