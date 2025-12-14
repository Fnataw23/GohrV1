<?php

namespace App\Http\Controllers\Application;

use App\Models\Application;
use App\Http\Controllers\Controller;

class ShowController extends Controller
{
    public function __invoke(Application $application)
    {

        $application->load([
            'hunter.addresses',
            'hunter.passport',
            'hunter.socialStatus.organization',
            'hunter.membershipCards',
            'hunter.convictions',
            'hunter.huntingCards'
        ]);

        return view('applications.show', compact('application'));
    }
}
