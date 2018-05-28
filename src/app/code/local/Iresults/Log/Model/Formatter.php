<?php

class Iresults_Log_Model_Formatter implements Iresults_Log_Model_FormatterInterface
{
    /**
     * Format the given message and context data
     *
     * @param string $message
     * @param array  $context
     * @return string
     */
    public function format($message, array $context = [])
    {
        Webmozart\Assert\Assert::string($message);
        if ($context) {
            $contextString = ': ' . json_encode($context);
        } else {
            $contextString = '';
        }

        return str_replace(["\n", "\r"], ' ', $message) . $contextString;
    }
}
