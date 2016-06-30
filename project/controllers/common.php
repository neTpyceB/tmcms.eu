<?php

use TMCms\Admin\Users;
use TMCms\Routing\Controller;
use TMCms\Templates\PageHead;
use TMCms\Templates\PageTail;

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
    public function footer() {}
}