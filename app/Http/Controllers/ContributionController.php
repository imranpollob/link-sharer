<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Contribution;
use Illuminate\Http\Request;

class ContributionController extends Controller
{
    public function index($slug = '')
    {
        $channels = Channel::get();

        if ($slug) {
            $contributions = Contribution::where('channel_id', $channels->where('slug', $slug)->first()->id)
                ->latest()->paginate(20);
        } else {
            $contributions = Contribution::latest()->paginate(20);
        }


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
