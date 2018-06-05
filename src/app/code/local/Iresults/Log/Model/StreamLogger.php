<?php

use Iresults_Log_Model_FormatterInterface as FormatterInterface;
use Psr\Log\LogLevel;

/**
 * A Logger implementation that logs messages to a given stream
 */
class Iresults_Log_Model_StreamLogger extends Iresults_Log_Model_AbstractLogger
{
    private $stream;
    private $isStreamOwner = false;

    /**
     * @param resource|string         $stream
     * @param string                  $minimumLogLevel
     * @param FormatterInterface|null $formatter
     */
    public function __construct(
        $stream = null,
        $minimumLogLevel = LogLevel::ALERT,
        FormatterInterface $formatter = null
    ) {
        parent::__construct($minimumLogLevel, $formatter);
        if (null === $stream) {
            if (!defined('STDOUT')) {
                define('STDOUT', fopen('php://stdout', 'w'));
            }
            $this->stream = STDOUT;
        }
        if (is_string($stream)) {
            $this->isStreamOwner = true;
            $this->stream = fopen($stream, 'a');
        }
        if (is_resource($stream)) {
            $this->stream = $stream;
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

        fwrite(
            $this->stream,
            sprintf('[%s] %s', strtoupper($level), $this->formatter->format($message, $context)) . PHP_EOL
        );
    }

    public function __destruct()
    {
        if ($this->isStreamOwner && $this->stream) {
            fclose($this->stream);
        }
    }
}
