@extends('layouts.app')

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<div class="card">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Đăng ký đề tài khóa luận tốt nghiệp</h3>
            </div>
            <!-- <div class="col text-right">
                <a href="#!" class="btn btn-sm btn-primary">See all</a>
            </div> -->
        </div>
    </div>
    <div class="card-body">
        <div class="row">            
            <div class="col-lg-12">
                <p>
                    <span class="blockquote" style="color: red;">
                    <b>Chú ý:</b> Chưa đến thời gian đăng kí khóa luận tốt nghiệp. Xin vui lòng quay lại sau!
                    </span>
                </p>
            </div>
        </div>
    </div>
</div>

@endsection