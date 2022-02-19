<?php

namespace App\Traits;

use App\Interfaces\Traits\HasIDInterface;
use Illuminate\Database\Eloquent\Builder;
use ReflectionException;

trait MagicMethodsTrait
{
    /**
     * Handles geting columns by set and get prefixes.
     *
     * @param mixed $method     Method.
     * @param mixed $parameters Parameters.
     *
     * @throws ReflectionException ReflectionException.
     *
     * @return $this
     */
    public function __call($method, $parameters) // phpcs:ignore
    {
        $constants = (new \ReflectionClass($this))->getConstants();
        $splitName = preg_split(
            '/([A-Z]+[^A-Z]+)/',
            $method,
            -1,
            PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY
        );

        $methodType = array_shift($splitName);
        $columnName = strtolower(implode('_', $splitName));

        if (!method_exists($this, $method) && in_array($columnName, $constants)) {
            if ($methodType === 'set') {
                $this->$columnName = current($parameters);

                return $this;
            }

            if ($methodType === 'get') {
                return $this->$columnName;
            }
        }

        return parent::__call($method, $parameters);
    }
}
