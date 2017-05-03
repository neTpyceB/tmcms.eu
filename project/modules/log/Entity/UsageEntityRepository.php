<?php

namespace TMCms\Modules\Log\Entity;

use TMCms\Orm\EntityRepository;

class UsageEntityRepository extends EntityRepository
{
    protected $table_structure = [
        'fields' => [
            'website_id'     => [
                'type' => 'index',
            ],
            'function_class' => [
                'type' => 'varchar',
            ],
            'function_name'  => [
                'type' => 'varchar',
            ],
            'counter'        => [
                'type' => 'ts',
            ],
        ],
    ];
}