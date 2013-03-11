<?php

namespace Gplanchat\Log\Writer;

use Gplanchat\Log\Formatter\FormatterInterface;

trait WriterTrait
{
    /**
     * @var FormatterInterface
     */
    private $formatter;

    /**
     * @return FormatterInterface
     */
    public function getFormatter()
    {
        return $this->formatter;
    }

    /**
     * @param FormatterInterface $formatter
     * @return WriterInterface
     */
    public function setFormatter(FormatterInterface $formatter)
    {
        $this->formatter = $formatter;

        return $this;
    }
}
