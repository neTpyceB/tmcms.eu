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
                    <div class="col-sm-12">
                        <h3><?= w('recently_added'); ?></h3>
                        <?= $this->recently_added; ?>
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