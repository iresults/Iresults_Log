<?php

use Psr\Log\LogLevel;

/**
 * Trait for Loggers with a minimum log level configuration
 */
trait Iresults_Log_Model_LogLevelTrait
{
    protected static $logLevelWeight = [
        LogLevel::EMERGENCY => 8,
        LogLevel::ALERT     => 7,
        LogLevel::CRITICAL  => 6,
        LogLevel::ERROR     => 5,
        LogLevel::WARNING   => 4,
        LogLevel::NOTICE    => 3,
        LogLevel::INFO      => 2,
        LogLevel::DEBUG     => 1,
    ];

    /**
     * Return the minimum log level that should be logged
     *
     * @return LogLevel
     */
    abstract public function getMinimumLogLevel();

    /**
     * Return if the given level matches the configured minimum log level
     *
     * @param string $level
     * @return bool
     */
    protected function matchesMinimumLogLevel($level)
    {
        return $this->getWeightForLogLevel($this->getMinimumLogLevel()) <= $this->getWeightForLogLevel($level);
    }

    /**
     * @param string $level
     * @return int
     */
    private function getWeightForLogLevel($level)
    {
        if (!is_string($level)) {
            return -1;
        }
        if (!isset(self::$logLevelWeight[$level])) {
            return -1;
        }

        return self::$logLevelWeight[$level];
    }
}
