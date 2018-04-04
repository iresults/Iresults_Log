<?php

class Iresults_Log_Model_Logger extends \Psr\Log\AbstractLogger
{
    public function log($level, $message, array $context = [])
    {
        Mage::log(sprintf('[%s] %s', strtoupper($level), $message));

        if (isset($context['exception']) && $context['exception'] instanceof Exception) {
            Mage::logException($context['exception']);
        }
    }
}