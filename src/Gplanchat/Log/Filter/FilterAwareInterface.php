<?php

namespace Gplanchat\Log\Filter;

use SplPriorityQueue as PriorityQueue;

interface FilterAwareInterface
{
    /**
     * @param FilterInterface $filter
     * @param int $priority
     */
    public function addFilter(FilterInterface $filter, $priority = null);

    /**
     * @return PriorityQueue
     */
    public function getFilterQueue();

    /**
     * @return FilterAwareInterface
     */
    public function clearFilters();

    /**
     * @param array $params
     * @return bool
     */
    public function isFiltered(array $params);
}
