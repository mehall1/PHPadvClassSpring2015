<?php

namespace lab\model\interfaces;

use lab\model\services\Scope;

interface IController {
    public function execute(Scope $scope);
}
