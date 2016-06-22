<?php

namespace Hifone\Models\Pm;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    protected $table = 'pm_metas';

    protected $fillable = ['body'];
}
