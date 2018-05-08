<?php

/**
 * A Logger implementation utilizing `Mage::log()`
 */
class Iresults_Log_Model_MageLogger extends Iresults_Log_Model_AbstractLogger
{
    public function log($level, $message, array $context = [])
    {
        if (!$this->matchesMinimumLogLevel($level)) {
            return;
        }
        Mage::log(sprintf('[%s] %s', strtoupper($level), $message));

        if (isset($context['exception']) && $context['exception'] instanceof Exception) {
            Mage::logException($context['exception']);
        }
    }
}
