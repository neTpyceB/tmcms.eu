<?php

namespace TMCms\Modules\Wiki\Entity;

use TMCms\DB\SQL;
use TMCms\Orm\Entity;

/**
 * Class WikiEntity
 * @package TMCms\Modules\Wiki\Entity
 *
 * @method string getText()
 * @method string getTitle()
 *
 * @method $this setActive(int $flag)
 * @method $this setLastUpdate(string $last_update_date)
 * @method $this setOrder(int $order)
 */
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

    protected function beforeSave()
    {
        $this->setLastUpdate(date('Y-m-d H:i:s', NOW));
        return $this;
    }

}