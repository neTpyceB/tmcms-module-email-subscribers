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
    protected $table_structure = [
        'fields' => [
            'ip' => [
                'type' => 'varchar',
                'unsigned' => true,
                'length' => '15',
            ],
            'ts' => [
                'type' => 'varchar',
                'unsigned' => true,
            ],
            'user_id' => [
                'type' => 'index',
            ],
            'email' => [
                'type' => 'varchar',
            ],
            'notes' => [
                'type' => 'varchar',
            ],
            'receive_news' => [
                'type' => 'bool',
            ],
            'receive_ads' => [
                'type' => 'bool',
            ],
        ],
    ];
}