<?php

namespace App\Repositories;

use App\Models\FCMJob;

class FCMJobRepository extends Repository {
    /**
     * @var FCMJob
     */
    public $model;

    public function __construct( FCMJob $model ) {
        $this->model = $model;
    }
}
