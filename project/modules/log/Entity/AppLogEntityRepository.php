<?php

namespace TMCms\Modules\Log\Entity;

use TMCms\Orm\EntityRepository;

class AppLogEntityRepository extends EntityRepository
{
    protected $table_structure = [
        'fields' => [
            'website_id' => [
                'type' => 'index',
            ],
            'entry_id'   => [
                'type' => 'ts',
            ],
            'ts'         => [
                'type' => 'ts',
            ],
            'user_id'    => [
                'type' => 'index',
            ],
            'url'        => [
                'type' => 'varchar',
            ],
            'msg'        => [
                'type' => 'varchar',
            ],
            'p'          => [
                'type' => 'varchar',
            ],
            'do'         => [
                'type' => 'varchar',
            ],
            'user'       => [
                'type' => 'varchar',
            ],
        ],
    ];
}