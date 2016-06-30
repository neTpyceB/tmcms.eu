<?php

namespace TMCms\Modules\Wiki\Entity;

use TMCms\Orm\EntityRepository;

class WikiEntityRepository extends EntityRepository
{
    protected $db_table = 'm_wiki';
    protected $translation_fields = ['title', 'text'];
    protected $table_structure = [
        'fields' => [
            'category_id' => [
                'type' => 'index'
            ],
            'title' => [
                'type' => 'translation'
            ],
            'text' => [
                'type' => 'translation'
            ],
            'order' => [
                'type' => 'int'
            ],
            'created_at' => [
                'type' => 'current_timestamp'
            ],
            'active' => [
                'type' => 'bool'
            ]
        ]
    ];
}