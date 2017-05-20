<?php

namespace DdOpenTracingBundle;

use DdOpenTracingBundle\DependencyInjection\DdOpenTracingExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class DdOpenTracingBundle extends Bundle
{
    public function getContainerExtensionClass()
    {
        return DdOpenTracingExtension::class;
    }
}
