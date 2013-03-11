<?php

namespace Gplanchat\Log\Filter;

interface FilterInterface
{
    /**
     * @param int $level
     * @param string $message
     * @param array $context
     * @return bool
     */
    public function isFiltered($level, $message, array $context = array());
}
