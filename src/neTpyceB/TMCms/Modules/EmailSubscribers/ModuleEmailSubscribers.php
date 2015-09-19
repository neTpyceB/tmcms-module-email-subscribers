<?php

namespace neTpyceB\TMCms\Modules\EmailSubscribers;

use neTpyceB\TMCms\Modules\EmailSubscribers\Entity\EmailSubscriberEntity;
use neTpyceB\TMCms\Modules\IModule;
use neTpyceB\TMCms\Strings\Verify;
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

    /**
     * @param $email
     * @param array $additional_data
     * @return bool
     */
    public static function addNewEmailSubscriber($email, array $additional_data = [])
    {
        // Check email
        if (!Verify::email($email)) {
            return false;
        }

        // Set supplied email
        $subscriber = new EmailSubscriberEntity;
        $subscriber->setEmail($email);

        // Set any supplied data
        if ($additional_data) {
            $subscriber->loadDataFromArray($additional_data);
        }

        // Create subscriber
        $subscriber->save();

        return true;
    }
}