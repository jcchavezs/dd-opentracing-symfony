<?php

namespace DdOpenTracingBundle\Listeners;

use DdOpenTracing\Tracer;
use DdOpenTracingBundle\Events\TracingTerminated;
use Exception;
use Psr\Log\LoggerInterface;

final class TracingFlusher
{
    const MAX_NUMBER_OF_ATTEMPTS = 3;

    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function notify(TracingTerminated $event)
    {
        $tracer = $event->tracer();

        $this->flushTraces($tracer, self::MAX_NUMBER_OF_ATTEMPTS);
    }

    private function flushTraces(Tracer $tracer, $numberOfAttempts)
    {
        try {
            $tracer->tracer()->flushTraces();
        } catch (Exception $e) {
            if ($numberOfAttempts == 1) {
                $this->logger->error($e->getMessage());
                return;
            }

            $this->flushTraces($tracer, $numberOfAttempts - 1);
        }
    }
}
