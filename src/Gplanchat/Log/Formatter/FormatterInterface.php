<?php

namespace Gplanchat\Log\Formatter;

use Gplanchat\Log\Writer\WriterInterface;

interface FormatterInterface
{
    /**
     * @param int $level
     * @param string $message
     * @param array $context
     * @return WriterInterface
     */
    public function format($level, $message, array $context = array());
}
