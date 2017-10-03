<?php
declare(strict_types=1);

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

    /**
     * @param string $email
     * @param array  $additional_data
     *
     * @return bool
     */
    public static function addNewEmailSubscriber(string $email, array $additional_data = []): bool
    {
        // Check email
        if (!Verify::email($email)) {
            return false;
        }

        // Set supplied email
        $subscriber = new EmailSubscriberEntity;
        $subscriber->setEmail($email);
        $subscriber->findAndLoadPossibleDuplicateEntityByFields(['email']);

        // Set any supplied data
        if ($additional_data) {
            $subscriber->loadDataFromArray($additional_data);
        }

        // Create subscriber
        $subscriber->save();

        return true;
    }
}