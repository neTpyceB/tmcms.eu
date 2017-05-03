<?php

namespace TMCms\Modules\Log\Entity;

use TMCms\Orm\EntityRepository;

class UsageWebsiteEntityRepository extends EntityRepository
{
    protected $table_structure = [
        'fields' => [
            'domain'      => [
                'type' => 'varchar',
            ],
            'last_update' => [
                'type' => 'ts',
            ],
        ],
    ];
}