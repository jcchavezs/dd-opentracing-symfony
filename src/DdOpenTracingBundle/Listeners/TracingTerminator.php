<?php

namespace DdOpenTracingBundle\Listeners;

use DdOpenTracing\Tracer;
use DdOpenTracingBundle\Events\TracingTerminated;
use SimpleBus\Message\Bus\MessageBus;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

final class TracingTerminator
{
    private $tracer;

    public function __construct(
        Tracer $tracer,
        MessageBus $messageBus
    ) {
        $this->tracer = $tracer;
        $this->messageBus = $messageBus;
    }

    public function onKernelResponse(FilterResponseEvent $event)
    {
        $this->messageBus->handle(TracingTerminated::create($this->tracer));
    }

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $this->messageBus->handle(TracingTerminated::create($this->tracer));
    }
}
