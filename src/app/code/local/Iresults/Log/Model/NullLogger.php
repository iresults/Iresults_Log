<?php

/**
 * A Logger implementation that does not log anything
 */
class Iresults_Log_Model_NullLogger extends \Psr\Log\AbstractLogger
{
    public function log($level, $message, array $context = [])
    {
    }
}
