<?php

namespace Modules\Admin\Main\app\Http\Controllers;

use App\Http\Controllers\Controller;

class MainController extends Controller
{

    public function index()
    {
        return view('AdminMain::Views/index');
    }

}
