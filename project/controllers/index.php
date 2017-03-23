<?php

use TMCms\Modules\ModuleManager;
use TMCms\Modules\Wiki\Entity\WikiEntity;
use TMCms\Modules\Wiki\ModuleWiki;
use TMCms\Routing\Controller;

ModuleManager::requireModule('wiki');

defined('INC') or exit;

class IndexController extends Controller
{
    public static function getComponents()
    {
        return [
            'welcome_text' => [
                'type' => 'textarea',
                'edit' => 'wysiwyg',
            ],
        ];
    }

    public function index()
    {

        $text = null;

        if (!empty($_GET['wiki'])) {
            $wiki_id = $_GET['wiki'];
            $wiki = new WikiEntity($wiki_id);
            $text = $wiki->getText();
        }

        return [
            'wiki_text' => $text
        ];
    }

    public function sidebar() {
        $wiki_id = null;

        if (!empty($_GET['wiki'])) {
            $wiki_id = $_GET['wiki'];
        }

        $categories = ModuleWiki::getSideCategories($wiki_id);

        return [
            'side_categories' => $categories
        ];
    }
}