@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <ul class="list-group">
                @foreach($contributions as $contribution)
                <li class="list-group-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div>
                                <form action="/vote" method="POST">
                                    @csrf
                                    <input type="hidden" name="contribution_id" value="{{ $contribution->id }}"/>
                                    <button class="btn {{ $contribution->upvotes->contains(auth()->id()) == true ? 'btn-primary' : 'btn-secondary' }}" style="width:50px" type="submit">
                                        {{ $contribution->upvotes->count() }}
                                    </button>
                                </form>
                            </div>

                            <div class="pl-3">
                                <div>
                                    <a href={{ $contribution->link }} class="h4 text-dark font-weight-bold">{{ $contribution->title }}</a>
                                </div>
                                <div>
                                    <a href="#">{{ $contribution->user->name }}</a> <span class="text-muted">posted</span>
                                    <span class="text-dark">{{ $contribution->updated_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>

                        <a class="btn btn-sm ml-3 text-white" style="background-color: {{ $contribution->channel->color }}; font-size: .8rem;;" href="/channel/{{ $contribution->channel->slug }}">{{ $contribution->channel->name }}</a>
                    </div>
                </li>
                @endforeach
            </ul>

            <div class="pt-5 d-flex justify-content-center">
                {{ $contributions->links() }}
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold text-center">Submit your link</h5>
                    <hr>
                    <form action="/" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title for your link</label>
                            <input type="text" name="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Some title">
                            @error('title')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="link">Link</label>
                            <input type="text" name="link" value="{{ old('link') }}" class="form-control @error('link') is-invalid @enderror" id="link" placeholder="https://somelink.dev">
                            @error('link')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="channel">Channel</label>
                            <select class="form-control" name="channel_id" id="channel">
                                @foreach($channels as $channel)
                                <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>
                                    {{ $channel->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection