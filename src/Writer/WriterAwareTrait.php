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
namespace Gplanchat\Log\Writer;

use SplPriorityQueue as PriorityQueue;

/**
 * Trait WriterAwareTrait
 * @package Gplanchat\Log\Writer
 */
trait WriterAwareTrait
{
    private $writerQueue = null;

    /**
     * @param WriterInterface $writer
     * @param int $priority
     * @return $this
     */
    public function addWriter(WriterInterface $writer, $priority = null)
    {
        if ($this->writerQueue === null) {
            $this->writerQueue = new PriorityQueue();
        }

        $this->writerQueue->insert($writer, $priority);

        return $this;
    }

    /**
     * @return PriorityQueue|WriterInterface[]
     */
    public function getWriterQueue()
    {
        return $this->writerQueue;
    }

    /**
     * @return $this
     */
    public function clearWriters()
    {
        $this->writerQueue = null;

        return $this;
    }
}
