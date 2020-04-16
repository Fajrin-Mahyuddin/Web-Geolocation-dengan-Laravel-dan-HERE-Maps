<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
    protected  $quarded = [];

    public function photos()
    {
        return $this->hasMany(Space::class, 'space_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
