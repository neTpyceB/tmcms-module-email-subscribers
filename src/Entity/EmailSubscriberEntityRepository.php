<?php

namespace TMCms\Modules\EmailSubscribers\Entity;

use TMCms\Orm\EntityRepository;

/**
 * Class EmailSubscriberEntityRepository
 * @package TMCms\Modules\EmailSubscribers
 */
class EmailSubscriberEntityRepository extends EntityRepository
{
    protected $db_table = 'm_email_subscribers';
}