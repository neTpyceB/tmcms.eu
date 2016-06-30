<?php

namespace TMCms\Modules\Wiki\Entity;

use TMCms\Orm\EntityRepository;

/**
 * Class WikiEntityRepository
 * @package TMCms\Modules\Wiki\Entity
 *
 * @method setWhereActive(bool $active)
 * @method setWhereCategoryId(bool $category_id)
 *
 *
 */

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