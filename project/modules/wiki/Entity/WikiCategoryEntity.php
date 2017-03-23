<?php

namespace TMCms\Modules\Wiki\Entity;

use TMCms\DB\SQL;
use TMCms\Orm\Entity;

/**
 * Class WikiCategoryEntity
 * @package TMCms\Modules\Wiki\Entity
 *
 * @method string getTitle()
 *
 * @method $this setActive(int $flag)
 * @method $this setOrder(int $order)
 */
class WikiCategoryEntity extends Entity
{
    protected $db_table = 'm_wiki_categories';
    protected $translation_fields = ['title'];

    protected function beforeCreate()
    {
        $this->setOrder(SQL::getNextOrder($this->getDbTableName()));
        $this->setActive(true);

        return $this;
    }

}