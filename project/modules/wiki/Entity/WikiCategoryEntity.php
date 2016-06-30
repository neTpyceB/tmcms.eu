<?php

namespace TMCms\Modules\Wiki\Entity;

use TMCms\DB\SQL;
use TMCms\Orm\Entity;

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