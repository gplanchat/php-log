<?php

namespace Gplanchat\Log\Filter;

use SplPriorityQueue as PriorityQueue;

trait FilterAwareTrait
{
    private $filterQueue = null;

    /**
     * @param FilterInterface $filter
     * @param int $priority
     */
    public function addFilter(FilterInterface $filter, $priority = null)
    {
        if ($this->filterQueue === null) {
            $this->filterQueue = new PriorityQueue();
        }

        $this->filterQueue->insert($filter, $priority);
    }

    /**
     * @return PriorityQueue
     */
    public function getFilterQueue()
    {
        return $this->filterQueue;
    }

    /**
     * @return FilterAwareInterface
     */
    public function clearFilters()
    {
        $this->filterQueue = null;
    }
    /**
     * @param int $level
     * @param string $message
     * @param array $context
     * @return bool
     */
    public function isFiltered($level, $message, array $context = array())
    {
        foreach ($this->getFilterQueue() as $filter) {
            /** @var FilterInterface $filter */
            if ($filter->isFiltered($level, $message, $context)) {
                return false;
            }
        }

        return true;
    }
}
