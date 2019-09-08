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
            $channel = $channels->where('slug', $slug)->first();

            $dropdown['channel'] =  $channel->name;

            $contributions = Contribution::withCount('upvotes')
                ->where('channel_id', $channel->id);
        } else {
            $dropdown['channel'] =  'All';

            $contributions = Contribution::withCount('upvotes');
        }

        if (request()->input('popularity') == '1') {
            $dropdown['sort'] = 'Popular';

            $contributions = $contributions->orderBy('upvotes_count', 'desc')->paginate(20);
        } else {
            $dropdown['sort'] = 'Recent';

            $contributions = $contributions->latest()->paginate(20);
        }

        return view('home', compact('contributions', 'channels', 'dropdown'));
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
