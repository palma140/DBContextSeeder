<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Modifiers;

/**
 * Class GenerateFromFieldModifier
 *
 * A modifier that generates a field's value based on another field's value,
 * using a user-defined callback function.
 *
 * @package IPLeiria\ESTG\EI\DBContextSeeder\Modifiers
 */
class GenerateFromFieldModifier implements RowAwareModifier
{
    /**
     * The name of the source field from which to derive the value.
     *
     * @var string
     */
    private string $sourceField;

    /**
     * A callable used to transform the value of the source field.
     *
     * @var callable
     */
    private $callback;

    /**
     * GenerateFromFieldModifier constructor.
     *
     * @param string $sourceField The name of the field whose value will be used for transformation.
     * @param callable $callback A function that accepts the value of the source field
     *                           and returns the transformed result.
     */
    public function __construct(string $sourceField, callable $callback)
    {
        $this->sourceField = $sourceField;
        $this->callback = $callback;
    }

    /**
     * Applies the transformation based on the value of another field in the row.
     *
     * @param mixed $value The current value of the field being modified.
     * @return mixed The generated or transformed value.
     */
    public function apply(mixed $value, $row): mixed
    {
        if (isset($row[$this->sourceField])) {
            return ($this->callback)($row[$this->sourceField]);
        }

        return $value;
    }
}
