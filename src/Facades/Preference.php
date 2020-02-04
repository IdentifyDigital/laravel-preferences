<?php

namespace IdentifyDigital\Preferences\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static void set(string $key, $value, int $type = 1, int $user_group_id = null)
 * @method static string get(string $key, int $user_group_id = null)
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
