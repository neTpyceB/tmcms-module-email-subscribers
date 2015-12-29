<?php

namespace TMCms\AdminTMCms\Modules\EmailSubscribers\Entity;

use TMCms\AdminTMCms\Orm\EntityRepository;

/**
 * Class EmailSubscriberEntityRepository
 * @package TMCms\AdminTMCms\Modules\EmailSubscribers
 */
class EmailSubscriberEntityRepository extends EntityRepository
{
    protected $db_table = 'm_email_subscribers';
}