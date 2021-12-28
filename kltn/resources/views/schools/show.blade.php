@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>{{ $school->name }}</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-primary" href="{{ route('schools.index') }}"> Quay lại</a>
        </div>
    </div>
</div>


<fieldset disabled>
    @include('schools.form')
</fieldset>
@endsection