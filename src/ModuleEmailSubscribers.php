<?php

namespace TMCms\Modules\EmailSubscribers;

use TMCms\Modules\EmailSubscribers\Entity\EmailSubscriberEntity;
use TMCms\Modules\IModule;
use TMCms\Strings\Verify;
use TMCms\Traits\singletonInstanceTrait;

defined('INC') or exit;

/**
 * Class ModuleEmailSubscribers
 * @package TMCms\Modules\EmailSubscribers
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