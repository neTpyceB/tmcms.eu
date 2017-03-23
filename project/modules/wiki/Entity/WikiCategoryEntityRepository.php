<?php

namespace TMCms\Modules\Wiki\Entity;

use TMCms\Orm\EntityRepository;

/**
 * Class WikiCategoryEntityRepository
 * @package TMCms\Modules\Wiki\Entity
 *
 * @method $this setWhereActive(bool $active)
 */

class WikiCategoryEntityRepository extends EntityRepository
{
    protected $db_table = 'm_wiki_categories';
    protected $translation_fields = ['title'];
    protected $table_structure = [
        'fields' => [
            'title' => [
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