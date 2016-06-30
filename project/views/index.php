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
                        <div class="col-sm-12">
                            <div class="js-error-message error-message">
                                <?= w('something_wrong'); ?>
                            </div>
                            <div class="js-put-wiki-content">
                                Welcome
                            </div>
                        </div>
                    </div>
            </div>
        <?php
    }
}