<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder;

use Illuminate\Support\Facades\Facade;

/**
 * @see \IPLeiria\ESTG\EI\DBContextSeeder\Skeleton\SkeletonClass
 */
class DBContextSeederFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'dbcontextseeder';
    }
}
