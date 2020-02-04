<?php

namespace IdentifyDigital\Preferences\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'preferences';

    const TYPES = [
        'STRING' => 1,
        'INTEGER' => 2,
        'DATETIME' => 3,
        'ARRAY' => 4
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['key', 'value', 'type'];

    /**
     * Alters the return of the value to be the correct type.
     *
     * @param $value
     * @return Carbon|int|mixed|string
     */
    public function getValueAttribute($value)
    {
        switch($this->attributes['type']) {
            case self::TYPES['STRING']:
                return strval($value);
            case self::TYPES['INTEGER'];
                return intval($value);
            case self::TYPES['DATETIME']:
                return Carbon::parse($value);
            case self::TYPES['ARRAY']:
                return json_decode($value);
            default:
                return $value;
        }
    }

    /**
     * Returns the value of the selected $key.
     *
     * @param string $key
     * @param int $user_group_id
     * @return Carbon|int|mixed|string|null
     */
    public function get($key, $user_group_id = null)
    {
        $preference = self::where('key', '=', $key)->when($user_group_id, function ($query, $group_id) {
            return $query->where('user_group_id', '=', $group_id);
        }, function ($query) {
            $group_namespace = config('preferences.group_namespace');

            return $query->when($group_namespace, function ($query, $namespace) {
                return $query->where('user_group_id', '=', $namespace::currentGroup()->getKey());
            });
        })->first();

        if(!$preference)
            return null;

        return $preference->value;
    }

    /**
     * Creates a new preference by $key and $value.
     *
     * @param string $key
     * @param $value
     * @param int $type
     * @param null $user_group_id
     * @return self
     */
    public function set($key, $value, $type = null, $user_group_id = null)
    {
        $group_namespace = config('preferences.group_namespace');

        return self::updateOrCreate([
            'key' => $key,
            'user_group_id' => $user_group_id ? $user_group_id : ($group_namespace ? $group_namespace::currentGroup()->getKey() : null)
        ], [
            'value' => $value,
            'key' => $key
        ]);
    }
}
