<?php

use TMCms\Routing\Structure;
use TMCms\Routing\View;
use TMCms\Templates\PageHead;

defined('INC') or exit;

class CommonView extends View
{
    public function header() {
        ?>
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <h1>Knowledge Base <small>Find answers and be happy</small></h1>
                    </div>
                    <div class="col-sm-6">
                        <input id="search_input" placeholder="Start typing for search..." class="form-control" type="text" name="search">
                    </div>
                </div>
            </div>
        </header>
        <?php
    }

    public function index() {}

    public function footer() {
        ?>
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <h3>Recently Added</h3>
                        <ul>
                            <li>
                                <a href="#">
                                    <i class="glyphicon glyphicon-list-alt"></i>
                                    Something wrong
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="glyphicon glyphicon-book"></i>
                                    Disabled Comments
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="glyphicon glyphicon-book"></i>
                                    Theme Set Up
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="glyphicon glyphicon-list-alt"></i>
                                    Follow Up Emails
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-4">
                        <h3>Recently Updated</h3>
                        <ul>
                            <li>
                                <a href="#">
                                    <i class="glyphicon glyphicon-list-alt"></i>
                                    Something wrong
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="glyphicon glyphicon-book"></i>
                                    Disabled Comments
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="glyphicon glyphicon-book"></i>
                                    Theme Set Up
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="glyphicon glyphicon-list-alt"></i>
                                    Follow Up Emails
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-4">
                        <h3>Popular</h3>
                        <ul>
                            <li>
                                <a href="#">
                                    <i class="glyphicon glyphicon-list-alt"></i>
                                    Something wrong
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="glyphicon glyphicon-book"></i>
                                    Disabled Comments
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="glyphicon glyphicon-book"></i>
                                    Theme Set Up
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="glyphicon glyphicon-list-alt"></i>
                                    Follow Up Emails
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row bottom">
                    <div class="col-sm-12">
                        <p>
                            Copyright 2016.
                        </p>
                    </div>
                </div>
            </div>
        </footer>
        <?php
    }
}