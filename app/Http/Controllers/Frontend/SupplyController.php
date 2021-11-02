<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SupplyController extends Controller
{
    public function __invoke(): \Inertia\Response
    {
        $this->authorize('Access supply');

        return Inertia::render('Supply/Index');
    }
}
