<?php

namespace TMCms\AdminTMCms\Modules\EmailSubscribers\Entity;

use TMCms\AdminTMCms\Orm\Entity;

/**
 * Class EmailSubscriberEntity
 * @package TMCms\AdminTMCms\Modules\EmailSubscribers
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