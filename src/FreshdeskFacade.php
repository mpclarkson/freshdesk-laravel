<?php
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 22/04/2016
 * Time: 2:00 PM
 */

namespace Mpclarkson\Laravel\Freshdesk;

use Illuminate\Support\Facades\Facade;

class FreshdeskFacade extends Facade
{
    const VERSION = '0.2.0';
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'freshdesk';
    }
}
