@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <ul class="list-group">
                @foreach($contributions as $contribution)
                <li class="list-group-item">
                    <a href={{ $contribution->link }}>
                        {{ $contribution->title }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection