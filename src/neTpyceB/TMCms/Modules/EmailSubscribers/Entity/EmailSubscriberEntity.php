<?php

namespace neTpyceB\TMCms\Modules\EmailSubscribers\Entity;

use neTpyceB\TMCms\Modules\Entity;

/**
 * Class EmailSubscriberEntity
 * @package neTpyceB\TMCms\Modules\EmailSubscribers
 *
 * @method setEmail(string $email)
 * @method setTs(int $ts)
 * @method setIp(string $ip)
 */
class EmailSubscriberEntity extends Entity
{
    protected $db_table = 'm_email_subscribers';

    /**
     * @return $this
     */
    protected function beforeCreate()
    {
        $this->setTs(NOW);
        $this->setIp(IP);

        return $this;
    }
}