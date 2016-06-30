<?php

use TMCms\Routing\View;

defined('INC') or exit;

class IndexView extends View
{

    public function sidebar() {
        ?>
        <aside class="col-sm-4">
            <h3><?= w('Categories'); ?></h3>
            <?= $this->side_categories; ?>
        </aside>
        <?php
    }
    public function index()
    {
        ?>
           <div class="content col-sm-8">
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <h2>Administration</h2>
                            <ul>
                                <li>
                                    <a href="#"><i class="glyphicon glyphicon-list-alt"></i>Reverse earth rotation</a>
                                </li>
                                <li>
                                    <a href="#"><i class="glyphicon glyphicon-book"></i>Make sun cooler</a>
                                </li>
                                <li>
                                    <a href="#"><i class="glyphicon glyphicon-book"></i>Make Trump disappear</a>
                                </li>
                                <li>
                                    <a href="#"><i class="glyphicon glyphicon-list-alt"></i>Multiple friends on facebook</a>
                                </li>
                                <li>
                                    <a href="#"><i class="glyphicon glyphicon-list-alt"></i>Increase brain memory</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <h2>Administration</h2>
                            <ul>
                                <li>
                                    <a href="#"><i class="glyphicon glyphicon-list-alt"></i>Reverse earth rotation</a>
                                </li>
                                <li>
                                    <a href="#"><i class="glyphicon glyphicon-book"></i>Make sun cooler</a>
                                </li>
                                <li>
                                    <a href="#"><i class="glyphicon glyphicon-book"></i>Make Trump disappear</a>
                                </li>
                                <li>
                                    <a href="#"><i class="glyphicon glyphicon-list-alt"></i>Multiple friends on facebook</a>
                                </li>
                                <li>
                                    <a href="#"><i class="glyphicon glyphicon-list-alt"></i>Increase brain memory</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <h2>Administration</h2>
                            <ul>
                                <li>
                                    <a href="#"><i class="glyphicon glyphicon-list-alt"></i>Reverse earth rotation</a>
                                </li>
                                <li>
                                    <a href="#"><i class="glyphicon glyphicon-book"></i>Make sun cooler</a>
                                </li>
                                <li>
                                    <a href="#"><i class="glyphicon glyphicon-book"></i>Make Trump disappear</a>
                                </li>
                                <li>
                                    <a href="#"><i class="glyphicon glyphicon-list-alt"></i>Multiple friends on facebook</a>
                                </li>
                                <li>
                                    <a href="#"><i class="glyphicon glyphicon-list-alt"></i>Increase brain memory</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <h2>Administration</h2>
                            <ul>
                                <li>
                                    <a href="#"><i class="glyphicon glyphicon-list-alt"></i>Reverse earth rotation</a>
                                </li>
                                <li>
                                    <a href="#"><i class="glyphicon glyphicon-book"></i>Make sun cooler</a>
                                </li>
                                <li>
                                    <a href="#"><i class="glyphicon glyphicon-book"></i>Make Trump disappear</a>
                                </li>
                                <li>
                                    <a href="#"><i class="glyphicon glyphicon-list-alt"></i>Multiple friends on facebook</a>
                                </li>
                                <li>
                                    <a href="#"><i class="glyphicon glyphicon-list-alt"></i>Increase brain memory</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <h2>Administration</h2>
                            <ul>
                                <li>
                                    <a href="#"><i class="glyphicon glyphicon-list-alt"></i>Reverse earth rotation</a>
                                </li>
                                <li>
                                    <a href="#"><i class="glyphicon glyphicon-book"></i>Make sun cooler</a>
                                </li>
                                <li>
                                    <a href="#"><i class="glyphicon glyphicon-book"></i>Make Trump disappear</a>
                                </li>
                                <li>
                                    <a href="#"><i class="glyphicon glyphicon-list-alt"></i>Multiple friends on facebook</a>
                                </li>
                                <li>
                                    <a href="#"><i class="glyphicon glyphicon-list-alt"></i>Increase brain memory</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <h2>Administration</h2>
                            <ul>
                                <li>
                                    <a href="#"><i class="glyphicon glyphicon-list-alt"></i>Reverse earth rotation</a>
                                </li>
                                <li>
                                    <a href="#"><i class="glyphicon glyphicon-book"></i>Make sun cooler</a>
                                </li>
                                <li>
                                    <a href="#"><i class="glyphicon glyphicon-book"></i>Make Trump disappear</a>
                                </li>
                                <li>
                                    <a href="#"><i class="glyphicon glyphicon-list-alt"></i>Multiple friends on facebook</a>
                                </li>
                                <li>
                                    <a href="#"><i class="glyphicon glyphicon-list-alt"></i>Increase brain memory</a>
                                </li>
                            </ul>
                        </div>
                    </div>
            </div>
        <?php
    }
}