<?php

use Psr\Log\LogLevel;

/**
 * A Logger implementation utilizing `Mage::log()`
 */
abstract class Iresults_Log_Model_AbstractLogger extends \Psr\Log\AbstractLogger
{
    use Iresults_Log_Model_LogLevelTrait;

    private $minimumLogLevel = LogLevel::ALERT;

    /**
     * @param string $minimumLogLevel
     */
    public function __construct($minimumLogLevel = LogLevel::ALERT)
    {
        $this->minimumLogLevel = $minimumLogLevel;
    }

    public function getMinimumLogLevel()
    {
        return $this->minimumLogLevel;
    }

    public function setMinimumLogLevel($logLevel)
    {
        $this->minimumLogLevel = $logLevel;

        return $this;
    }
}
