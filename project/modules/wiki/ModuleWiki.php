<?php

namespace TMCms\Modules\Wiki;

use TMCms\Modules\IModule;
use TMCms\Modules\Wiki\Entity\WikiCategoryEntityRepository;
use TMCms\Modules\Wiki\Entity\WikiEntityRepository;
use TMCms\Traits\singletonInstanceTrait;

class ModuleWiki implements IModule
{
    use singletonInstanceTrait;

    public static function getCategoryPairs()
    {
        return WikiCategoryEntityRepository::getInstance()->getPairs('title');
    }

}
