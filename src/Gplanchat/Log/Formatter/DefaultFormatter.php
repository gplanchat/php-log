<?php

namespace Gplanchat\Log\Formatter;

use Gplanchat\Log\Writer\WriterInterface;

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
     * @return WriterInterface
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
