<?php

namespace Gplanchat\Log\Writer;

use Gplanchat\Log\Formatter\FormatterInterface;

interface WriterInterface
{
    /**
     * @return FormatterInterface
     */
    public function getFormatter();

    /**
     * @param FormatterInterface $formatter
     * @return WriterInterface
     */
    public function setFormatter(FormatterInterface $formatter);

    /**
     * @param int $level
     * @param string $message
     * @param array $context
     * @return WriterInterface
     */
    public function write($level, $message, array $context = array());
}
