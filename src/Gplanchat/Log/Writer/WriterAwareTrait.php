<?php

namespace Gplanchat\Log\Writer;

use SplPriorityQueue as PriorityQueue;

trait WriterAwareTrait
{
    private $writerQueue = null;

    /**
     * @param WriterInterface $writer
     * @param int $priority
     */
    public function addWriter(WriterInterface $writer, $priority = null)
    {
        if ($this->writerQueue === null) {
            $this->writerQueue = new PriorityQueue();
        }

        $this->writerQueue->insert($writer, $priority);
    }

    /**
     * @return PriorityQueue
     */
    public function getWriterQueue()
    {
        return $this->writerQueue;
    }

    /**
     * @return WriterAwareInterface
     */
    public function clearWriters()
    {
        $this->writerQueue = null;
    }
}
