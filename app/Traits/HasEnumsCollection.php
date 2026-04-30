<?php

namespace App\Traits;

use Illuminate\Support\Collection;

trait HasEnumsCollection
{
    /**
     * Get a collection instance
     * @return Collection
     */
    public static function collection(): Collection
    {
        return collect(value: self::cases());
    }

    /**
     * Get the values as an array
     * @return array
     */
    public static function values(): array
    {
        return self::collection()->map(callback: fn($i) => $i->value)->toArray();
    }

    /**
     * Get the labels as an array
     * @return array
     */
    public static function labels(): array
    {
        return self::collection()->map(fn($i) => $i->name)->toArray();
    }

    /**
     * Search a value from cases collection
     * @param  string    $search
     * @param  bool|null $value
     * @return mixed
     */
    public static function search(string $search, ?bool $value = true): mixed
    {
        return self::collection()->first(callback: fn($i) => ($value === true ? $i->value : $i->name) === strtoupper($search));
    }

    /**
     * Get the validation rules
     * @return string
     */
    public static function rules(): string
    {
        return sprintf('in:%s', implode(separator: ',', array: self::values()));
    }
}
