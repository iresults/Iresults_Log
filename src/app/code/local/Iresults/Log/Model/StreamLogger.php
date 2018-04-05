<?php

/**
 * A Logger implementation that logs messages to a given stream
 */
class Iresults_Log_Model_StreamLogger extends \Psr\Log\AbstractLogger
{
    private $stream;
    private $isStreamOwner = false;

    /**
     * @param resource|string $stream
     */
    public function __construct($stream = null)
    {
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
        fwrite($this->stream, sprintf('[%s] %s', strtoupper($level), $message) . PHP_EOL);
    }

    public function __destruct()
    {
        if ($this->isStreamOwner && $this->stream) {
            fclose($this->stream);
        }
    }
}
