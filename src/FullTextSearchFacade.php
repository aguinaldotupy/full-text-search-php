<?php

namespace Tupy\FullTextSearch;

use Illuminate\Support\Facades\Facade;

/**
 * Class FullTextSearchFacade
 * @package Tupy\FullTextSearch
 */
class FullTextSearchFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return new FullTextSearch();
    }
}
