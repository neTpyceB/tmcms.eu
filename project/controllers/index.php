<?php

use TMCms\Admin\Users;
use TMCms\Modules\ModuleManager;
use TMCms\Modules\Wiki\ModuleWiki;
use TMCms\Routing\Controller;

ModuleManager::requireModule('wiki');

defined('INC') or exit;

class IndexController extends Controller
{
    public function index()
    {

    }

    public function sidebar() {

        $categories = ModuleWiki::getSideCategories();

        return [
            'side_categories' => $categories
        ];
    }
}