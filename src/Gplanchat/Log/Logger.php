<?php

namespace Gplanchat\Log;

use Gplanchat\Log\Filter\FilterAwareInterface;
use Gplanchat\Log\Filter\FilterAwareTrait;
use Gplanchat\Log\Writer\WriterAwareInterface;
use Gplanchat\Log\Writer\WriterAwareTrait;
use Gplanchat\Log\Writer\WriterInterface;

use Psr\Log\LogLevel;
use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;

use SplPriorityQueue as PriorityQueue;

class Logger
    implements LoggerInterface, FilterAwareInterface, WriterAwareInterface
{
    use LoggerTrait;
    use FilterAwareTrait;
    use WriterAwareTrait;

    private $writers = [];

    public function __construct(Writer\WriterInterface $writer = null)
    {
        $this->writers = new PriorityQueue();
        $this->filters = new PriorityQueue();

        if ($writer !== null) {
            $this->addWriter($writer);
        }
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     * @return null
     */
    public function log($level, $message, array $context = array())
    {
        if ($this->isFiltered($level, $message, $context)) {
            return;
        }

        foreach ($this->getWriterQueue() as $writer) {
            /** @param WriterInterface $writer */
            $writer->write($level, $message, $context);
        }
    }
}
