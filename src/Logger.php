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
namespace Gplanchat\Log;

use Gplanchat\Log\Filter\FilterAwareInterface;
use Gplanchat\Log\Filter\FilterAwareTrait;
use Gplanchat\Log\Writer\WriterAwareInterface;
use Gplanchat\Log\Writer\WriterAwareTrait;
use Gplanchat\Log\Writer\WriterInterface;

use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;

use SplPriorityQueue as PriorityQueue;

/**
 * Class Logger
 * @package Gplanchat\Log
 */
class Logger
    implements LoggerInterface, FilterAwareInterface, WriterAwareInterface
{
    use LoggerTrait;
    use FilterAwareTrait;
    use WriterAwareTrait;

    private $writers = [];

    public function __construct(WriterInterface $writer = null)
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
            $writer->write($level, $message, $context);
        }
    }
}
