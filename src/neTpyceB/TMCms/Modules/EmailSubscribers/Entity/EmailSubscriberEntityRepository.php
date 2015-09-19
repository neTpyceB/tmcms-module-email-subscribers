<?php

namespace neTpyceB\TMCms\Modules\EmailSubscribers;

use neTpyceB\TMCms\Modules\EntityRepository;

/**
 * Class EmailSubscriberEntityRepository
 * @package neTpyceB\TMCms\Modules\EmailSubscribers
 */
class EmailSubscriberEntityRepository extends EntityRepository
{
    protected $db_table = 'm_email_subscribers';
}