<?php

namespace App\Casts;

use JsonException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class Json implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param Model $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     * @return array
     * @throws JsonException
     */
    public function get($model, $key, $value, $attributes): array
    {
        return json_decode($value, true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param Model $model
     * @param string $key
     * @param array $value
     * @param array $attributes
     * @return string
     * @throws JsonException
     */
    public function set($model, $key, $value, $attributes): string
    {
        return json_encode($value, JSON_THROW_ON_ERROR);
    }
}
