<?php

namespace Mangrio\OpenAiLaravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Mangrio\OpenAiLaravel\OpenAiLaravel
 */
class OpenAiLaravel extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Mangrio\OpenAiLaravel\OpenAiLaravel::class;
    }
}