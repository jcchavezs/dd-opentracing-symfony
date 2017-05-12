<?php

namespace DdOpenTracingBundle\Controllers;

interface TraceableController
{
    public function operationName($action = null);
}
