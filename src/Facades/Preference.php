<?php

namespace IdentifyDigital\Preferences\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static void set(string $key, $value, int $type = 1)
 * @method static string get(string $key)
 *
 * @see \IdentifyDigital\Preferences\Models\Preference
 */
class Preference extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        return 'preference';
    }
}
