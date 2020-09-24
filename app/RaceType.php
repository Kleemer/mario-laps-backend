<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RaceType extends Model
{
    protected $keyType = 'string';

    public const ANIMAL_CROSSING = 'animal-crossing';
    public const BIG_BLUE = 'big-blue';
    public const MOUNT_WARIO = 'mount-wario';
    public const BABY_PARK = 'baby-park';
    public const RAINBOW_ROAD_WII_U = 'rainbow-road-wii-u';

    public const TYPES = [
        [
            'id' => self::ANIMAL_CROSSING,
            'name' => 'Animal Crossing'
        ],
        [
            'id' => self::BIG_BLUE,
            'name' => 'Big Blue'
        ],
        [
            'id' => self::MOUNT_WARIO,
            'name' => 'Descente Givrée'
        ],
        [
            'id' => self::BABY_PARK,
            'name' => 'Parc Baby'
        ],
        [
            'id' => self::RAINBOW_ROAD_WII_U,
            'name' => 'Route Arc-En-Ciel'
        ],
    ];
}
