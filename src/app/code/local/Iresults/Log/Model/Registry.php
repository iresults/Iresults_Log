<?php

use Psr\Log\LoggerInterface;

/**
 * Registry to manage loggers
 */
class Iresults_Log_Model_Registry
{
    /**
     * Add the given logger to the registry
     *
     * @param LoggerInterface $logger
     * @param string          $name
     * @throws Mage_Core_Exception if a Logger with `$name` has already been registered
     */
    public static function addLogger(LoggerInterface $logger, $name)
    {
        Webmozart\Assert\Assert::stringNotEmpty($name);
        Mage::register(__CLASS__ . $name, $logger);
    }

    /**
     * Fetch the logger with the given name from the registry
     *
     * @param string $name
     * @return LoggerInterface|null
     */
    public static function getLogger($name)
    {
        Webmozart\Assert\Assert::stringNotEmpty($name);

        return Mage::registry(__CLASS__ . $name);
    }
}
