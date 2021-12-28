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
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <tr class="badge-default">
                        <th class="text-align-center">STT</th>
                        <th style="width: 40%;" class="text-align-center">
                            <a class="thead" href=" {{ url('topics-register-list', ['sort' => $sort_param['topic_name']]) }} ">    
                                <div class="col-xl-12">
                                    Tên đề tài  <i class="fas fa-arrows-alt-v"></i>
                                </div>
                            </a>
                        </th>
                        <th class="text-align-center">
                            <a class="thead" href=" {{ url('topics-register-list', ['sort' => $sort_param['topic_department']]) }} ">    
                                <div class="col-xl-12">
                                    Bộ môn  <i class="fas fa-arrows-alt-v"></i>
                                </div>
                            </a>
                        </th>
                        <!-- <th>Số lượng SV</th>
                        <th>Ghi chú</th> -->
                        <th class="text-align-center">
                            <a class="thead" href=" {{ url('topics-register-list', ['sort' => $sort_param['instructor_name']]) }} ">    
                                <div class="col-xl-12">
                                    Giảng viên hướng dẫn  <i class="fas fa-arrows-alt-v"></i>
                                </div>
                            </a>
                        </th>
                        <th class="text-align-center">
                            <a class="thead" href=" {{ url('topics-register-list', ['sort' => $sort_param['topic_status']]) }} ">    
                                <div class="col-xl-12">
                                    Trạng thái  <i class="fas fa-arrows-alt-v"></i>
                                </div>
                            </a>
                        </th>
                        <th class="text-align-center">Xem chi tiết</th>
                    </tr>
                    
                    @foreach ($topics as $key => $topic)
                    <tr>
                        <td class="text-align-center">{{ ++$i }}</td>
                        @if($topic->status == '1')
                            <td class="align-middle"><a href="{{ route('topic-register-confirm', ['topic_id' => $topic->id]) }}" rel="noopener noreferrer">{{ $topic->name }}</a></td>
                        @else
                            <td class="align-middle"><a rel="noopener noreferrer">{{ $topic->name }}</a></td>   
                        @endif 
                        
                        <td class="text-align-center">{{ $topic->department }}</td>
                        <td class="text-align-center">{{ $topic->instructor_name }}</td>
                        <td class="text-align-center">
                            @if($topic->status == '1')
                            <div class="badge badge-success">Có thể đăng ký</div>   
                            @else
                            <div class="badge badge-danger">Đã đủ SV</div>   
                            @endif               
                        </td>
                        <td class="text-align-center" style="text-align: center;">
                            @if($topic->status == '1')
                                @can('topic-register')
                                    <a href="{{ route('topic-register-confirm', ['topic_id' => $topic->id]) }}" class="btn btn-primary" type="submit"><i class="far fa-edit"></i></a>
                                @endcan  
                            @else
                                <input type="hidden" name="topic_id" value="{{$topic->id}}">
                                <button class="btn btn-primary" disabled><i class="far fa-edit"></i></button>
                            @endif
                            
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>

{!! $topics->render() !!}
@endsection