<?php

namespace Gplanchat\Log\Writer;

use SplPriorityQueue as PriorityQueue;

interface WriterAwareInterface
{
    /**
     * @param WriterInterface $filter
     * @param int $priority
     */
    public function addWriter(WriterInterface $filter, $priority = null);

    /**
     * @return PriorityQueue
     */
    public function getWriterQueue();

    /**
     * @return WriterAwareInterface
     */
    public function clearWriters();
}
