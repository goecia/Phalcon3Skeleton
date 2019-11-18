<?php

namespace App\Controllers;

use Phalcon\Mvc\Controller;
use App\Models\IndexModel;

class IndexController extends Controller
{
    /**
     * Example Controller usage.
     *
     * @param void
     * @return string
     */
    public function indexAction(): string
    {
        $indexModel = new IndexModel();
        return $indexModel->getMessage();
    }
}
