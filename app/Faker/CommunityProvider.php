<?php

namespace App\Faker;

use Faker\Provider\Base;

class CommunityProvider extends Base
{
    protected static $communities = [
        'things',
        'diy',
        'aww',
        'pics',
        'video',
        'games',
        'programming',
        'nature',
        'surfing',
        'cars',
        'animals',
        'dogs',
        'cats',
        'golf',
        'movies',
        'series',
        'xbox',
        'playstation',
        'ProgrammerHumor',
        'AskSience',
        'ANormalDayInRussia',
        'BlackMagicFuckery',
        'HoldMyCosmo',
        'memes',
        'PCMasterRace',
        'UpliftingNews',
        'WholesomeMemes',
        'insanepeoplefacebook',
        'whatcouldgowrong'
    ];
    public function community(): string
    {
        return static::randomElement(static::$communities);
    }
}
