<?php
/**
 * This file is part of gplanchat\php-log.
 *
 * gplanchat\php-log is free software: you can redistribute it and/or modify it under the
 * terms of the GNU LEsser General Public License as published
 * by the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * gplanchat\php-log is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with gplanchat\php-log.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Grégory PLANCHAT <g.planchat@gmail.com>
 * @license Lesser General Public License v3 (http://www.gnu.org/licenses/lgpl-3.0.txt)
 * @copyright Copyright (c) 2013 Grégory PLANCHAT (http://planchat.fr/)
 */

/**
 * @namespace
 */
namespace Gplanchat\Log\Filter;

use SplPriorityQueue as PriorityQueue;

/**
 * Class FilterAwareTrait
 * @package Gplanchat\Log\Filter
 */
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
