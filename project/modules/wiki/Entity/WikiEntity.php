<?php

namespace TMCms\Modules\Wiki\Entity;

use TMCms\DB\SQL;
use TMCms\Orm\Entity;

class WikiEntity extends Entity
{
    protected $db_table = 'm_wiki';
    protected $translation_fields = ['title', 'text'];

    protected function beforeCreate()
    {
        $this->setOrder(SQL::getNextOrder($this->getDbTableName()));
        $this->setActive(true);

        return $this;
    }

}