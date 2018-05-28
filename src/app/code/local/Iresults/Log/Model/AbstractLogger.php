<?php

use Iresults_Log_Model_FormatterInterface as FormatterInterface;
use Psr\Log\LogLevel;

/**
 * A Logger implementation utilizing `Mage::log()`
 */
abstract class Iresults_Log_Model_AbstractLogger extends \Psr\Log\AbstractLogger
{
    use Iresults_Log_Model_LogLevelTrait;

    /**
     * @var string
     */
    private $minimumLogLevel = LogLevel::ALERT;

    /**
     * @var Iresults_Log_Model_Formatter
     */
    protected $formatter;

    /**
     * @param string                  $minimumLogLevel
     * @param FormatterInterface|null $formatter
     */
    public function __construct($minimumLogLevel = LogLevel::ALERT, FormatterInterface $formatter = null)
    {
        $this->minimumLogLevel = $minimumLogLevel;
        $this->formatter = $formatter ?: new Iresults_Log_Model_Formatter();
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
