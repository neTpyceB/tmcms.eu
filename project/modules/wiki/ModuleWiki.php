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
        $categories->addOrderByField();
        $all_categories = $categories->getAsArrayOfObjects();

        ob_start();
        ?>
        <ul>
            <?php foreach($all_categories as $key => $category):
                $category_id = $category->getId();
                // Get wiki by category
                $wiki = new WikiEntityRepository();
                $wiki->setWhereCategoryId($category_id);
                $wiki->setWhereActive(true);
                $wiki->addOrderByField();
                $all_wiki = $wiki->getAsArrayOfObjects();
                if (count($all_wiki)): ?>
                    <li class="js-expand-child <?= (!$key ? 'expanded' : ''); ?>">
                        <a href="#"><?= $category->getTitle(); ?></a>
                        <ul>
                            <?php foreach ($all_wiki as $k => $wiki): $k++; ?>
                                <li>
                                    <a class="js-get-wiki-content" href="?wiki=<?= $wiki->getId(); ?>">
                                        <?= $k . '. ' . $wiki->getTitle(); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
        <?php
        return ob_get_clean();
    }

    public static function getLastAddedInFooter($limit) {

        $wiki = new WikiEntityRepository();
        $wiki->setWhereActive(true);
        $wiki->addOrderByField('created_at');
        $wiki->setLimit($limit);
        $all_wiki = $wiki->getAsArrayOfObjects();
        ob_start(); ?>
        <ul>
            <?php foreach($all_wiki as $wiki): ?>
                <li>
                    <a class="js-get-wiki-content" href="?wiki=<?= $wiki->getId(); ?>">
                        <?= $wiki->getTitle(); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php
        return ob_get_clean();
    }

}
