<?php

namespace App\Http\Controllers;

use App\Contribution;
use Illuminate\Http\Request;

class ContributionController extends Controller
{
    public function index()
    {
        $contributions = Contribution::latest()->paginate(20);

        return view('home', compact('contributions'));
    }
}
