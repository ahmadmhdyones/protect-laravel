<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function test_protect() {
        return "Cillum sunt sunt esse quis. Irure ad anim occaecat eiusmod occaecat tempor. Duis ullamco minim esse magna ullamco occaecat nostrud fugiat adipisicing sit. Culpa ad occaecat enim minim veniam mollit sunt dolore irure sint occaecat. Id ex voluptate nisi mollit aliquip nulla. Dolore aliquip dolor nulla eiusmod proident et nostrud eu cillum ut.";
    }
}
