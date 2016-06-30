<?php

namespace TMCms\Modules\Wiki;

use TMCms\Modules\IModule;
use TMCms\Modules\Wiki\Entity\WikiCategoryEntityRepository;
use TMCms\Modules\Wiki\Entity\WikiEntityRepository;
use TMCms\Traits\singletonInstanceTrait;

class ModuleWiki implements IModule
{
    use singletonInstanceTrait;

    public static function getCategoryPairs()
    {
        return WikiCategoryEntityRepository::getInstance()->getPairs('title');
    }

    public static function getSideCategories() {

        // Get categories
        $categories = new WikiCategoryEntityRepository();
        $categories->setWhereActive(true);
        $all_categories = $categories->getPairs('title','id');

        // Get wiki
        $all_wiki = WikiEntityRepository::findAllEntitiesByCriteria(['active' => true]);

        ?>
        <ul>
            <li>
                <a href="#">Getting started</a>
            </li>
            <li>
                <a href="#">Administration</a>
            </li>
            <li>
                <a href="#">Admin panel</a>
            </li>
        </ul>
        <?php
    }

}
