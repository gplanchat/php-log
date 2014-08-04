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

use Gplanchat\Log\Formatter\FormatterInterface;
use Gplanchat\Log\Formatter\DefaultFormatter;
use RuntimeException;

/**
 * Class Stream
 * @package Gplanchat\Log\Writer
 */
class Stream
    implements WriterInterface
{
    use WriterTrait;

    private $stream = null;

    /**
     * @param string|resource $stream
     * @param FormatterInterface $formatter
     * @throws RuntimeException
     */
    public function __construct($stream, FormatterInterface $formatter = null)
    {
        if (is_string($stream)) {
            $this->stream = @fopen($stream, 'ab');
        } else if (is_resource($stream)) {
            $this->stream = $stream;
        }

        if ($this->stream === null) {
            throw new RuntimeException(sprintf(
                '%s constructor\'s first parameter should be a valid stream url or a writable stream.', __CLASS__));
        }

        $this->setFormatter($formatter ?: new DefaultFormatter());
    }

    /**
     * @param int $level
     * @param string $message
     * @param array $context
     * @return WriterInterface
     * @throws RuntimeException
     */
    public function write($level, $message, array $context = array())
    {
        if (@fwrite($this->stream, $this->getFormatter()->format($level, $message, $context)) === false) {
            throw new RuntimeException('Could not write to stream');
        }

        return $this;
    }
}
