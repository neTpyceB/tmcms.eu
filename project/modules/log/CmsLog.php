<?php
declare(strict_types=1);

namespace TMCms\Modules\Log;

use TMCms\HTML\BreadCrumbs;
use TMCms\HTML\Cms\CmsTableHelper;
use TMCms\Modules\Log\Entity\AppLogEntityRepository;
use TMCms\Modules\Log\Entity\UsageEntityRepository;
use TMCms\Modules\Log\Entity\UsageWebsiteEntityRepository;
use TMCms\Modules\Settings\ModuleSettings;

class CmsLog
{
    protected $server;
    protected $user;
    protected $pass;
    protected $port;
    protected $conn;
    protected $msg_cnt;
    protected $inbox;

    public function _default()
    {
        new AppLogEntityRepository();
        new UsageEntityRepository;

        $websites = new UsageWebsiteEntityRepository;
        $websites->addOrderByField('last_update', true);

        BreadCrumbs::getInstance()
            ->addCrumb(__('CMS Domain'), '?p=' . P)
            ->addAction(__('Scan emails'), '?p=' . P . '&do=_scan');

        echo CmsTableHelper::outputTable([
            'data'    => $websites,
            'columns' => [
                'last_update' => [
                    'type' => 'datetime',
                ],
                'domain'      => [],
            ],
        ]);
    }

    public function usages()
    {
        $websites = new UsageWebsiteEntityRepository;

        $usages = new UsageEntityRepository;
        $usages->addOrderByField('counter', true);

        BreadCrumbs::getInstance()
            ->addCrumb(__('CMS Usages'));

        echo CmsTableHelper::outputTable([
            'data'    => $usages,
            'columns' => [
                'website_id' => [
                    'pairs' => $websites->getPairs('domain'),
                ],
                'function_class',
                'function_name',
                'counter',
            ],
        ]);
    }

    public function _scan()
    {
        ModuleLog::parseEmails();

        back();
    }

    public function settings()
    {
        echo ModuleSettings::requireTableForExternalModule();
    }

    public function _settings()
    {
        ModuleSettings::requireUpdateModuleSettings();
    }
}