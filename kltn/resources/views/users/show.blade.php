@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left dp-flex">
            <h3>
                {{$user->name}}
                @if(!empty($user->getRoleNames()))
                @foreach($user->getRoleNames() as $v)
                <label class="badge badge-success">{{ $v }}</label>
                @endforeach
                @endif
            </h3>
        </div>
        <div class="float-right">
            <a class="btn btn-primary" href="{{ url('/') }}"> Quay lại</a>
        </div>
    </div>
</div>

@include('topics.items.list', ['user' => $user])

@endsection