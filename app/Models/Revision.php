<?php

namespace Hifone\Models;

use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
