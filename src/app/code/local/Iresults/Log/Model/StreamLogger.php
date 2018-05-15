<?php

use Psr\Log\LogLevel;

/**
 * A Logger implementation that logs messages to a given stream
 */
class Iresults_Log_Model_StreamLogger extends Iresults_Log_Model_AbstractLogger
{
    private $stream;
    private $isStreamOwner = false;

    /**
     * @param resource|string $stream
     * @param string          $minimumLogLevel
     */
    public function __construct($stream = null, $minimumLogLevel = LogLevel::ALERT)
    {
        parent::__construct($minimumLogLevel);
        if (null === $stream) {
            $this->stream = STDOUT;
        }
        if (is_string($stream)) {
            $this->isStreamOwner = true;
            $this->stream = fopen($stream, 'a');
        }
        if (!is_resource($this->stream)) {
            throw new InvalidArgumentException('Argument "stream" must either be a resource or valid file path');
        }
    }

    public function log($level, $message, array $context = [])
    {
        if (!$this->matchesMinimumLogLevel($level)) {
            return;
        }

        if ($context) {
            $contextString = ': ' . json_encode($context);
        } else {
            $contextString = '';
        }
        fwrite($this->stream, sprintf('[%s] %s%s', strtoupper($level), $message, $contextString) . PHP_EOL);
    }

    public function __destruct()
    {
        if ($this->isStreamOwner && $this->stream) {
            fclose($this->stream);
        }
    }
}
