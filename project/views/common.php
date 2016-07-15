<?php

use TMCms\Routing\Languages;
use TMCms\Routing\Structure;
use TMCms\Routing\View;
use TMCms\Templates\PageHead;

defined('INC') or exit;

class CommonView extends View
{
    public function header() {
        ?>

        <noscript>
            <style type="text/css">
                aside ul li ul {
                    display: block;
                }
            </style>
        </noscript>
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <h1>Knowledge Base <small>Find answers and be happy</small></h1>
                    </div>
                    <div class="col-sm-4">
                        <input id="search_input" placeholder="Start typing for search..." class="form-control" type="text" name="search">
                    </div>
                    <div class="col-sm-2 languages">
                        <ul>
                            <?php foreach(Languages::getPairs() as $k => $v): ?>
                                <li>
                                    <a <?= $k == LNG ? ' class="active"' : '' ?> href="<?= Languages::getUrl($k) ?>" title="<?= $v ?>"><?= $v ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
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
                    <div class="col-sm-6">
                        <h3><?= w('recently_added'); ?></h3>
                        <?= $this->recently_added; ?>
                    </div>
                    <div class="col-sm-6">
                        <h3><?= w('recently_updated'); ?></h3>
                        <?= $this->recently_updated; ?>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row bottom">
                    <div class="col-sm-12">
                        <ul class="list-inline">
                            <li>
                                Copyright &copy; <a href="http://devp.eu" target="_blank">DEVP</a> 2016.
                            </li>
                            <li>
                                Contacts us: <a href="mailto:info@devp.eu">info@devp.eu</a>
                            </li>
                            <li>
                                Checkout our homepage: <a href="http://devp.eu" target="_blank">www.devp.eu</a>
                            </li>
                            <li>
                                Call us: <a href="tel:+37129662045" title="Better write us">+371 29662045</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        <?php
    }
}