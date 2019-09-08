<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Contribution;
use Illuminate\Http\Request;

class ContributionController extends Controller
{
    public function index()
    {
        $contributions = Contribution::latest()->paginate(20);
        $channels = Channel::get(['id', 'name']);

        return view('home', compact('contributions', 'channels'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'link' => 'required|url',
            'channel_id' => 'required|exists:channels,id'
        ]);

        auth()->user()->contribution()->create($data);

        return back();
    }
}
