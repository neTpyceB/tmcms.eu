<?php

namespace TMCms\Modules\Wiki;

use TMCms\Admin\Menu;
use TMCms\Admin\Messages;
use TMCms\DB\SQL;
use TMCms\HTML\BreadCrumbs;
use TMCms\HTML\Cms\CmsFormHelper;
use TMCms\HTML\Cms\CmsTable;
use TMCms\HTML\Cms\Column\ColumnActive;
use TMCms\HTML\Cms\Column\ColumnCheckbox;
use TMCms\HTML\Cms\Column\ColumnData;
use TMCms\HTML\Cms\Column\ColumnDelete;
use TMCms\HTML\Cms\Column\ColumnEdit;
use TMCms\HTML\Cms\Column\ColumnOrder;
use TMCms\HTML\Cms\Columns;
use TMCms\Log\App;
use TMCms\Modules\Wiki\Entity\WikiCategoryEntity;
use TMCms\Modules\Wiki\Entity\WikiCategoryEntityRepository;
use TMCms\Modules\Wiki\Entity\WikiEntity;
use TMCms\Modules\Wiki\Entity\WikiEntityRepository;

Menu::getInstance()
    ->addSubMenuItem('categories')
;

class CmsWiki
{
    /* Wiki */

    public function _default()
    {
        $wiki = new WikiEntityRepository();
        $wiki->addOrderByField('order');

        echo BreadCrumbs::getInstance()
            ->addCrumb(__('Wiki'), '?p=' . P)
            ->addCrumb(__('All Wiki'))
        ;

        echo Columns::getInstance()
            ->add('<a class="btn btn-success" href="?p=' . P . '&do=add">' . __('Add Wiki') . '</a><br><br>', ['align' => 'right'])
        ;

        echo CmsTable::getInstance()
            ->addData($wiki)
            ->addColumn(ColumnData::getInstance('id')
                ->setTitle('Wiki #')
                ->enableNarrowWidth()
                ->enableOrderableColumn()
                ->disableNewlines()
            )
            ->addColumn(ColumnData::getInstance('category_id')
                ->setTitle('Category')
                ->setPairedDataOptionsForKeys(ModuleWiki::getCategoryPairs())
                ->enableNarrowWidth()
                ->enableOrderableColumn()
                ->disableNewlines()
            )
            ->addColumn(ColumnData::getInstance('title')
                ->enableTranslationColumn()
                ->setHref('?p=' . P . '&do=edit&id={%id%}')
                ->enableOrderableColumn()
            )
            ->addColumn(ColumnActive::getInstance())
            ->addColumn(ColumnOrder::getInstance()
                ->enableDraggable()
            )
            ->addColumn(ColumnEdit::getInstance('edit'))
            ->addColumn(ColumnDelete::getInstance('delete'))
        ;
    }

    public function _add_edit_form($data = null)
    {
        $wiki = new WikiEntityRepository();
        $wiki->addOrderByField('id');

        return CmsFormHelper::outputForm($wiki->getDbTableName(), [
            'combine' => true,
            'data' => $data,
            'button' => 'Add',
            'fields' => [
                'category_id' => [
                    'title' => 'Category',
                    'type' => 'select',
                    'options' => ModuleWiki::getCategoryPairs()
                ],
                'title' => [
                    'translation' => true
                ],
                'text' => [
                    'translation' => true,
                    'type' => 'textarea',
                    'edit' => 'tinymce'
                ],
            ],
            'unset' => [
                'created_at',
                'last_update',
                'active',
                'order'
            ]
        ]);
    }

    public function add()
    {
        echo BreadCrumbs::getInstance()
            ->addCrumb(__('Wiki'), '?p=' . P)
            ->addCrumb(__('All Wiki'), '?p=' . P)
            ->addCrumb(__('Add Wiki'))
        ;

        echo $this->_add_edit_form();
    }

    public function _add()
    {
        $wiki = new WikiEntity();
        $wiki->loadDataFromArray($_POST);
        $wiki->save();

        Messages::sendGreenAlert('Wiki was created');
        App::add('Wiki "' . $wiki->getTitle() . '" was created');

        go('?p=' . P . '&highlight=' . $wiki->getId());
    }

    public function edit()
    {
        $wiki = new WikiEntity($_GET['id']);

        echo BreadCrumbs::getInstance()
            ->addCrumb(__('Wiki'), '?p=' . P)
            ->addCrumb(__('All Wiki'), '?p=' . P)
            ->addCrumb($wiki->getTitle())
            ->addCrumb(__('Edit'))
        ;

        echo $this->_add_edit_form($wiki)
            ->setSubmitButton('Update')
            ->setCancelButton(__('Cancel'))
        ;
    }

    public function _edit()
    {
        $wiki = new WikiEntity($_GET['id']);
        $wiki->loadDataFromArray($_POST);
        $wiki->save();

        Messages::sendGreenAlert('Wiki was updated');
        App::add('Wiki "' . $wiki->getTitle() . '" was updated');

        go('?p=' . P . '&highlight=' . $wiki->getId());
    }

    public function _delete()
    {
        $wiki = new WikiEntity($_GET['id']);
        $wiki->deleteObject();

        Messages::sendGreenAlert('Wiki was deleted');
        App::add('Wiki "' . $wiki->getTitle() . '" was deleted');

        if (IS_AJAX_REQUEST) {
            die('1');
        }

        go('?p=' . P);
    }

    public function _active()
    {
        $category = new WikiEntity($_GET['id']);
        $category->flipBoolValue('active');
        $category->save();

        Messages::sendGreenAlert('Wiki was updated');
        App::add('Wiki "' . $category->getTitle() . '" was updated');

        if (IS_AJAX_REQUEST) {
            die('1');
        }

        go('?p=' . P . '&do=wiki&highlight=' . $category->getId());
    }

    public function _order()
    {
        $category = new WikiEntity($_GET['id']);

        if (isset($_GET['ajax'])) {
            SQL::orderMoveByStep($category->getId(), $category->getDbTableName(), $_GET['direct'], $_GET['step']);
            die(1);
        } else {
            SQL::order($category->getId(), $category->getDbTableName(), $_GET['direct']);
            back();
        }
    }

    /* Wiki Categories */

    public function categories()
    {
        $categories = new WikiCategoryEntityRepository();
        $categories->addOrderByField('order');

        echo BreadCrumbs::getInstance()
            ->addCrumb(__('Wiki'), '?p=' . P)
            ->addCrumb(__('Categories'), '?p=' . P . '&do=categories')
            ->addCrumb(__('All Categories'))
        ;

        echo Columns::getInstance()
            ->add('<a class="btn btn-success" href="?p=' . P . '&do=categories_add">' . __('Add Category') . '</a><br><br>', ['align' => 'right'])
        ;

        echo CmsTable::getInstance()
            ->addData($categories)
            ->addColumn(ColumnData::getInstance('id')
                ->setTitle('Category #')
                ->enableNarrowWidth()
                ->enableOrderableColumn()
                ->disableNewlines()
            )
            ->addColumn(ColumnData::getInstance('title')
                ->enableTranslationColumn()
                ->setHref('?p=' . P . '&do=categories_edit&id={%id%}')
                ->enableOrderableColumn()
            )
            ->addColumn(ColumnActive::getInstance())
            ->addColumn(ColumnOrder::getInstance()
                ->enableDraggable()
            )
            ->addColumn(ColumnEdit::getInstance('edit'))
            ->addColumn(ColumnDelete::getInstance('delete'))
        ;
    }

    public function _categories_add_edit_form($data = null)
    {
        $categories = new WikiCategoryEntityRepository();

        return CmsFormHelper::outputForm($categories->getDbTableName(), [
            'combine' => true,
            'data' => $data,
            'button' => 'Add',
            'fields' => [
                'title' => [
                    'translation' => true
                ],
            ],
            'unset' => [
                'created_at',
                'active',
                'order'
            ]
        ]);
    }

    public function categories_add()
    {
        echo BreadCrumbs::getInstance()
            ->addCrumb(__('Wiki'), '?p=' . P)
            ->addCrumb(__('Categories'), '?p=' . P . '&do=categories')
            ->addCrumb(__('Add Category'))
        ;

        echo $this->_categories_add_edit_form();
    }

    public function _categories_add()
    {

        $category = new WikiCategoryEntity();
        $category->loadDataFromArray($_POST);
        $category->save();

        Messages::sendGreenAlert('Category was created');
        App::add('Category "' . $category->getName() . '" was created');

        go('?p=' . P . '&do=categories&highlight=' . $category->getId());
    }

    public function categories_edit()
    {
        $category = new WikiCategoryEntity($_GET['id']);

        echo BreadCrumbs::getInstance()
            ->addCrumb(__('Wiki'), '?p=' . P)
            ->addCrumb(__('Categories'), '?p=' . P . '&do=categories')
            ->addCrumb($category->getName())
            ->addCrumb(__('Edit'))
        ;

        echo $this->_categories_add_edit_form($category)
            ->setSubmitButton('Update')
            ->setCancelButton(__('Cancel'))
        ;
    }

    public function _categories_edit()
    {
        $category = new WikiCategoryEntity($_GET['id']);
        $category->loadDataFromArray($_POST);
        $category->save();

        Messages::sendGreenAlert('Category was updated');
        App::add('Category "' . $category->getName() . '" was updated');

        go('?p=' . P . '&do=categories&highlight=' . $category->getId());
    }

    public function _categories_delete()
    {
        $category = new WikiCategoryEntity($_GET['id']);
        $category->deleteObject();

        Messages::sendGreenAlert('Category was deleted');
        App::add('Category "' . $category->getName() . '" was deleted');

        if (IS_AJAX_REQUEST) {
            die('1');
        }

        go('?p=' . P . '&do=categories');
    }

    public function _categories_active()
    {
        $category = new WikiCategoryEntity($_GET['id']);
        $category->flipBoolValue('active');
        $category->save();

        Messages::sendGreenAlert('Category was updated');
        App::add('Category "' . $category->getTitle() . '" was updated');

        if (IS_AJAX_REQUEST) {
            die('1');
        }

        go('?p=' . P . '&do=categories&highlight=' . $category->getId());
    }

    public function _categories_order()
    {
        $category = new WikiCategoryEntity($_GET['id']);

        if (isset($_GET['ajax'])) {
            SQL::orderMoveByStep($category->getId(), $category->getDbTableName(), $_GET['direct'], $_GET['step']);
            die(1);
        } else {
            SQL::order($category->getId(), $category->getDbTableName(), $_GET['direct']);
            back();
        }
    }

}