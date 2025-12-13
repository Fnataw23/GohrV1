<?php

namespace App\Http\Controllers\Application;

use App\Models\Application;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShowController extends Controller
{
    public function __invoke(Application $application)
    {
        return view('applications.show', compact('application'));
    }
}
