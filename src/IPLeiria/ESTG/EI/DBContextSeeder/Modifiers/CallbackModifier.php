<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Modifiers;

/**
 * Class CallbackModifier
 *
 * A modifier that applies a user-defined callback function to a given value.
 * This allows for custom transformation logic during row generation.
 *
 * @package IPLeiria\ESTG\EI\DBContextSeeder\Modifiers
 */
class CallbackModifier implements RowAwareModifier
{
    /**
     * The user-defined callback function.
     *
     * The callable must accept two arguments: the original value and the full row array,
     * and return the modified value.
     *
     * @var callable
     */
    private $callback;

    /**
     * CallbackModifier constructor.
     *
     * Initializes the modifier with a user-defined callback function.
     *
     * @param callable $callback A callable that receives the value and the row as parameters,
     *                           and returns the modified value.
     */
    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    /**
     * Applies the callback function to transform the input value based on the given row.
     *
     * @param mixed $value The original value to be modified.
     * @param array $row The entire row of data currently being generated.
     * @return mixed The value after applying the callback function.
     */
    public function apply(mixed $value, array $row): mixed
    {
        return ($this->callback)($value, $row);
    }
}
