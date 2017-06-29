<?php
declare(strict_types=1);

use TMCms\Modules\Log\ModuleLog;
use TMCms\Modules\ModuleManager;

ModuleManager::requireModule('log');

ModuleLog::parseEmails();

$data = NOW . ': Parse emails task' . PHP_EOL . PHP_EOL;

file_put_contents(DIR_FRONT_LOGS . 'tasks.log', $data, FILE_APPEND);