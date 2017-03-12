<?php

namespace TMCms\Modules\EmailSubscribers\Entity;

use TMCms\Orm\Entity;

/**
 * Class EmailSubscriberEntity
 * @package TMCms\Modules\EmailSubscribers
 *
 * @method setEmail(string $email)
 * @method setTs(int $ts)
 * @method setIp(string $ip)
 * @method setReceiveNews(bool $flag)
 * @method string getEmail()
 * @method bool getActive()
 *
 */
class EmailSubscriberEntity extends Entity
{
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