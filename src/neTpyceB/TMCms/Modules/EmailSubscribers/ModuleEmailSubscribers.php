<?php

namespace neTpyceB\TMCms\Modules\EmailSubscribers;

use neTpyceB\TMCms\Modules\IModule;
use neTpyceB\TMCms\Traits\singletonInstanceTrait;

defined('INC') or exit;

/**
 * Class ModuleEmailSubscribers
 * @package neTpyceB\TMCms\Modules\EmailSubscribers
 */
class ModuleEmailSubscribers implements IModule
{
    use singletonInstanceTrait;

    public static $tables = [
        'subscribers' => 'm_email_subscribers'
    ];
}