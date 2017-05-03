<?php

namespace TMCms\Modules\Log;

use TMCms\HTML\BreadCrumbs;
use TMCms\HTML\Cms\CmsTableHelper;
use TMCms\Modules\Log\Entity\AppLogEntityRepository;
use TMCms\Modules\Log\Entity\UsageEntity;
use TMCms\Modules\Log\Entity\UsageEntityRepository;
use TMCms\Modules\Log\Entity\UsageWebsiteEntity;
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
        set_time_limit('10');
        ignore_user_abort(0);

        $this->server = ModuleSettings::getCustomSettingValue('log', 'email_server');
        $this->user = ModuleSettings::getCustomSettingValue('log', 'email_login');
        $this->pass = ModuleSettings::getCustomSettingValue('log', 'email_password');
        $this->port = ModuleSettings::getCustomSettingValue('log', 'email_port');

        imap_timeout(IMAP_READTIMEOUT, 2);
        imap_timeout(IMAP_OPENTIMEOUT, 2);
        imap_timeout(IMAP_WRITETIMEOUT, 2);
        imap_timeout(IMAP_CLOSETIMEOUT, 2);

        $this->conn = imap_open("{" . "$this->server:$this->port/imap/novalidate-cert" . "}INBOX", $this->user, $this->pass);

        $emails = imap_search($this->conn, 'UNSEEN');

        if ($emails) {
            rsort($emails);
            foreach ($emails as $email_number) {
//                $overview = imap_fetch_overview($this->conn, $email_number, 0);
//                $message = imap_fetchbody($this->conn, $email_number, 2);

                $structure = imap_fetchstructure($this->conn, $email_number);

                $attachments = [];
                if (isset($structure->parts) && count($structure->parts)) {
                    for ($i = 0; $i < count($structure->parts); $i++) {
                        $attachments[$i] = [
                            'is_attachment' => false,
                            'filename'      => '',
                            'name'          => '',
                            'attachment'    => '',
                        ];

                        if ($structure->parts[$i]->ifdparameters) {
                            foreach ($structure->parts[$i]->dparameters as $object) {
                                if (strtolower($object->attribute) == 'filename') {
                                    $attachments[$i]['is_attachment'] = true;
                                    $attachments[$i]['filename'] = $object->value;
                                }
                            }
                        }

                        if ($structure->parts[$i]->ifparameters) {
                            foreach ($structure->parts[$i]->parameters as $object) {
                                if (strtolower($object->attribute) == 'name') {
                                    $attachments[$i]['is_attachment'] = true;
                                    $attachments[$i]['name'] = $object->value;
                                }
                            }
                        }

                        if ($attachments[$i]['is_attachment']) {
                            $attachments[$i]['attachment'] = imap_fetchbody($this->conn, $email_number, $i + 1);

                            /* 3 = BASE64 encoding */
                            if ($structure->parts[$i]->encoding == 3) {
                                $attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
                            } /* 4 = QUOTED-PRINTABLE encoding */
                            elseif ($structure->parts[$i]->encoding == 4) {
                                $attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);
                            }
                        }
                    }
                }

                foreach ($attachments as $attachment) {
                    if ($attachment['is_attachment'] == 1) {

                        // Parse email content
                        $content = @gzdecode($attachment['attachment']);
                        if ($content) {
                            $content = @json_decode($content);

                            if ($content) {
                                $this->parse_log_data((array)$content);
                            }
                        }

                    }
                }

                // Delete email
                imap_delete($this->conn, $email_number);
            }
        }

        // Suppress errors
        imap_errors();
        imap_alerts();

        imap_close($this->conn);

        back();
    }

    private function parse_log_data($content)
    {
        // Update domain website
        $content['data'] = (array)$content['data'];
        $domain_name = $content['data']['domain'];

        /** @var UsageWebsiteEntity $website */
        $website = UsageWebsiteEntityRepository::findOneEntityByCriteria([
            'domain' => $domain_name,
        ]);

        if (!$website) {
            $website = new UsageWebsiteEntity();
            $website->setDomain($domain_name);
        }

        $website->setLastUpdate($content['data']['ts']);
        $website->save();

        // Update log entries
//          We do not save log apps of client's users
//        foreach ($content['logs']['app_log'] as $log_entry) {
//            $log_entry = (array)$log_entry;
//
//            $app_log = new AppLogEntity();
//            $app_log->setWebsiteId($website->getId());
//            $app_log->setEntryId($log_entry['id']);
//            $app_log->setTs($log_entry['ts']);
//            $app_log->setUserId($log_entry['user_id']);
//            $app_log->setUrl($log_entry['url']);
//            $app_log->setMsg($log_entry['msg']);
//            $app_log->setP($log_entry['p']);
//            $app_log->setDo($log_entry['do']);
//            $app_log->setUser($log_entry['user']);
//
//            $app_log->save();
//        }

        // Update usage data statistics
        $content['logs'] = (array)$content['logs'];
        foreach ($content['logs']['usage'] as $log_entry) {
            $log_entry = (array)$log_entry;

            /** @var UsageEntity $usage_log */
            $usage_log = UsageEntityRepository::findOneEntityByCriteria([
                'website_id'     => $website->getId(),
                'function_class' => $log_entry['function_class'],
                'function_name'  => $log_entry['function_name'],
            ]);

            if (!$usage_log) {
                $usage_log = new UsageEntity();
                $usage_log->setWebsiteId($website->getId());
                $usage_log->setFunctionClass($log_entry['function_class']);
                $usage_log->setFunctionName($log_entry['function_name']);
            }

            $usage_log->setCounter($usage_log->getCounter() + $log_entry['counter']);

            $usage_log->save();
        }
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