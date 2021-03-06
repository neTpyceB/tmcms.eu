<?php

use TMCms\Modules\Log\Entity\UsageEntityRepository;
use TMCms\Modules\Log\Entity\UsageWebsiteEntity;
use TMCms\Modules\Log\Entity\UsageWebsiteEntityRepository;
use TMCms\Modules\ModuleManager;
use TMCms\Modules\Wiki\ModuleWiki;
use TMCms\Routing\Controller;
use TMCms\Templates\PageHead;
use TMCms\Templates\PageTail;

ModuleManager::requireModule('log');

defined('INC') or exit;

class CommonController extends Controller
{
    public function header()
    {

    }
    public function index()
    {
        PageHead::getInstance()
            ->addMeta('IE=Edge', '', 'X-UA-Compatible')
            ->addMeta('width=device-width, initial-scale=1, maximum-scale=1', 'viewport')
            ->addCssUrl(DIR_ASSETS_URL . 'css/libs/bootstrap.min.css')
            ->addCssUrl(DIR_ASSETS_URL . 'css/libs/bootstrap-theme.min.css')
            ->addCssUrl(DIR_ASSETS_URL . 'css/main.min.css')
        ;

        PageTail::getInstance()
            ->addJsUrl(DIR_ASSETS_URL . 'js/libs/jquery-1.11.1.min.js')
            ->addJsUrl(DIR_ASSETS_URL . 'js/main.min.js')
        ;

    }
    public function footer() {

        $limit = 5;
        $last_added = ModuleWiki::getLastAddedInFooter($limit);
        $last_update = ModuleWiki::getLastUpdatedInFooter($limit);

        $public_websites_count = new UsageWebsiteEntityRepository();
        $public_websites_count->addOrderByField('last_update', true);

        $last_update_website = NOW;
        /** @var UsageWebsiteEntity $latest_website */
        if ($latest_website = $public_websites_count->getFirstObjectFromCollection()) {
            $last_update_website = $latest_website->getLastUpdate();
        }

        $usage = new UsageEntityRepository();
        $requests_served_count = q_value('SELECT SUM(`counter`) AS `counter` FROM `' . $usage->getDbTableName() . '`');

        return [
            'recently_added'        => $last_added,
            'recently_updated'      => $last_update,
            'last_stats_ts'         => $last_update_website,
            'public_websites_count' => $public_websites_count->getCountOfObjectsInCollection(),
            'requests_served_count' => $requests_served_count,
        ];
    }
}