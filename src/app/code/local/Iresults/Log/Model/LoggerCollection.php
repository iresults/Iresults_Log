<?php

use Psr\Log\AbstractLogger;
use Psr\Log\LoggerInterface;

/**
 * A container that groups different logger instances together
 */
class Iresults_Log_Model_LoggerCollection extends AbstractLogger implements LoggerInterface
{
    /**
     * @var array
     */
    private $loggers;

    /**
     * @param LoggerInterface[] $loggers
     */
    public function __construct(array $loggers = [])
    {
        $this->loggers = $loggers;
    }

    /**
     * Add the given logger to the collection
     *
     * @param LoggerInterface $logger
     */
    public function addLogger(LoggerInterface $logger)
    {
        $this->loggers[] = $logger;
    }

    public function log($level, $message, array $context = [])
    {
        foreach ($this->loggers as $logger) {
            $logger->log($level, $message, $context);
        }
    }
}
