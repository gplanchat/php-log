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
namespace Gplanchat\Log\Formatter;

/**
 * Class DefaultFormatter
 * @package Gplanchat\Log\Formatter
 */
class DefaultFormatter
    implements FormatterInterface
{
    const DEFAULT_FORMAT_STRING = '[%timestamp%] %level% %message%';

    private $stringFormat = null;

    public function __construct($stringFormat = null)
    {
        if ($stringFormat === null) {
            $stringFormat = static::DEFAULT_FORMAT_STRING;
        }

        $this->stringFormat = $stringFormat;
    }

    public function setStringFormat($stringFormat)
    {
        $this->stringFormat = $stringFormat;

        return $this;
    }

    public function getStringFormat()
    {
        return $this->stringFormat;
    }

    /**
     * @param int $level
     * @param string $message
     * @param array $context
     * @return string
     */
    public function format($level, $message, array $context = array())
    {
        $output = str_replace("%level%", $level, $this->stringFormat);

        foreach ($context as $name => $value) {
            $output = str_replace("%$name%", $value, $output);
        }

        return $output;
    }
}
