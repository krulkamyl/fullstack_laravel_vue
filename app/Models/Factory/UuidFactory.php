<?php

namespace App\Models\Factory;

use Illuminate\Database\Eloquent\Model;

abstract class UuidFactory extends Model
{
    public function getIntementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}
