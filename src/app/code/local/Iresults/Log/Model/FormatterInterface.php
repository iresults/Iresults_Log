<?php

interface Iresults_Log_Model_FormatterInterface
{
    /**
     * Format the given message and context data
     *
     * @param string $message
     * @param array  $context
     * @return string
     */
    public function format($message, array $context = []);
}
