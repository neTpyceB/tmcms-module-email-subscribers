<?php

namespace TMCms\AdminTMCms\Modules\EmailSubscribers;

use TMCms\AdminTMCms\Modules\EmailSubscribers\Entity\EmailSubscriberEntity;
use TMCms\AdminTMCms\Modules\IModule;
use TMCms\AdminTMCms\Strings\Verify;
use TMCms\AdminTMCms\Traits\singletonInstanceTrait;

defined('INC') or exit;

/**
 * Class ModuleEmailSubscribers
 * @package TMCms\AdminTMCms\Modules\EmailSubscribers
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