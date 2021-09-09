<?php
declare(strict_types=1);

namespace App\Domain\Entity;

use ArrayObject;
use JsonSerializable;

/**
 * Class AbstractCollection.
 *
 * @package Sireniti\App\Domain\Entity
 */
abstract class AbstractCollection extends ArrayObject implements JsonSerializable
{
    /**
     * Empty.
     *
     * @return bool
     */
    public function empty(): bool
    {
        return $this->count() === 0;
    }


    /**
     * Reset.
     *
     * @return null|mixed
     */
    public function last()
    {
        return !empty($this) ? $this[$this->count() - 1] : null;
    }

    /**
     * Reset.
     *
     * @return false|mixed
     */
    public function reset()
    {
        foreach ($this as $element) {
            return $element;
        }

        return false;
    }

    /**
     * Search an entity.
     *
     * @param callable $callback
     *
     * @return mixed|null
     */
    public function search(callable $callback)
    {
        foreach ($this as $element) {
            if ($callback($element)) {
                return $element;
            }
        }

        return null;
    }

    /**
     * Search an entity by field.
     *
     * @param string $fieldName
     * @param $value
     *
     * @return mixed|null
     */
    public function searchField(string $fieldName, $value)
    {
        return
            $this->search(
                function ($obj) use ($fieldName, $value) {
                    $pascalCase = b_pascal_case($fieldName);
                    $methodGet = 'get' . $pascalCase;
                    $methodIs = 'is' . $pascalCase;

                    if (method_exists($obj, $methodGet)) {
                        if (call_user_func([$obj, $methodGet]) == $value) {
                            return true;
                        }
                    }

                    if (method_exists($obj, $methodIs)) {
                        if (call_user_func([$obj, $methodIs]) == $value) {
                            return true;
                        }
                    }

                    return false;
                }
            );
    }

    /**
     * Filter.
     *
     * @param callable $callback
     * @param bool $preserve_keys
     *
     * @return static
     */
    public function filter(callable $callback, bool $preserve_keys = false)
    {
        $newList = clone $this;
        $newList->exchangeArray([]);

        foreach ($this as $key => $element) {
            if ($callback($element)) {
                if ($preserve_keys) {
                    $newList[$key] = $element;
                    continue;
                }

                $newList->append($element);
            }
        }

        return $newList;
    }

    /**
     * Slice.
     *
     * @param int $offset
     * @param int|null $length
     * @param bool $preserve_keys
     *
     * @return static
     */
    public function slice(int $offset, int $length = null, bool $preserve_keys = false)
    {
        $newList = clone $this;
        $newList->exchangeArray(array_slice($this->getArrayCopy(), $offset, $length, $preserve_keys));

        return $newList;
    }

    /**
     * Filter field.
     *
     * @param string $fieldName
     * @param mixed $value
     *
     * @return static
     */
    public function filterField(string $fieldName, $value)
    {
        return
            $this->filter(
                function ($obj) use ($fieldName, $value) {
                    $pascalCase = b_pascal_case($fieldName);
                    $methodGet = 'get' . $pascalCase;
                    $methodIs = 'is' . $pascalCase;

                    if (method_exists($obj, $methodGet)) {
                        if (call_user_func([$obj, $methodGet]) == $value) {
                            return true;
                        }
                    }

                    if (method_exists($obj, $methodIs)) {
                        if (call_user_func([$obj, $methodIs]) == $value) {
                            return true;
                        }
                    }

                    return false;
                }
            );
    }

    public function jsonSerialize()
    {
        return $this->getArrayCopy();
    }

    public function filterFields(array $fields)
    {
        if (empty($fields)) {
            return $this->getArrayCopy();
        }

        $items = [];
        foreach ($this->getArrayCopy() as $item) {
            if ($item instanceof JsonSerializable) {
                $items[] = array_intersect_key($item->jsonSerialize(), array_flip($fields));
            }
        }

        return $items;
    }
}