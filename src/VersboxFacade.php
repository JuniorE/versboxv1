<?php

namespace JuniorE\Versbox;

use Illuminate\Support\Facades\Facade;

/**
 * @see \JuniorE\Versbox\Skeleton\SkeletonClass
 */
class VersboxFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'versbox';
    }
}
