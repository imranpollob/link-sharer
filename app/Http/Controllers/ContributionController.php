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


        $is_old = Contribution::where('link', $data['link'])->first();

        if ($is_old) {
            $is_old->touch();

            return back();
        }

        auth()->user()->contribution()->create($data);

        return back();
    }

    public function vote(Request $request)
    {
        $data = $request->validate([
            'contribution_id' => 'required|exists:contributions,id'
        ]);

        $contribution = Contribution::find($data['contribution_id']);

        $contribution->upvotes()->toggle(auth()->id());

        return back();
    }
}
