<?php

namespace Mangrio\OpenAiLaravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \YellowDigital\OpenAiLaravel\OpenAiLaravel
 */
class OpenAiLaravel extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Mangrio\OpenAiLaravel\OpenAiLaravel::class;
    }
}