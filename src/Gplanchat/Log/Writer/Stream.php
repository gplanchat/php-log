<?php

namespace Gplanchat\Log\Writer;

use Gplanchat\Log\Formatter\FormatterInterface;
use Gplanchat\Log\Formatter\DefaultFormatter;
use RuntimeException;

class Stream
    implements WriterInterface
{
    use WriterTrait;

    private $stream = null;

    /**
     * @param string|resource $stream
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
            throw new RuntimeException(sprintf('%s constructor\'s first parameter should be a valid stream url or a writable stream.', __CLASS__));
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
