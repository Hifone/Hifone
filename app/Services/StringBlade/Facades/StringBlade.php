<?php 
namespace Hifone\Services\StringBlade\Facades;

use Illuminate\Support\Facades\Facade;

class StringBlade extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'stringblade';
    }
}