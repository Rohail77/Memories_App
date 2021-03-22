<?php


namespace helpers;

use Ramsey\Uuid\Uuid;

class UtilFunctions
{
    public static function getRandom() : string {
        return $uuid = Uuid::uuid4();
    }
}