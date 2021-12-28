@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h3> Vòng [{{$round}}]: {{ $group->name }}</h3>
        </div>
        <div class="float-right">
            <a class="btn btn-primary" href="{{ '/groups?type=3' }}"> Quay lại</a>
        </div>
    </div>
</div>


<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <tr>
            <th>Mã</th>
            <th width="300px">Tên</th>
            <th>P1</th>
            <th>P2</th>
            <th>P3</th>
            <th>P4</th>
            <th>P5</th>
            <th>TB</th>
            <th>Điểm</th>
            <!-- <th>Giải</th> -->
        </tr>
        @foreach ($researchs as $research)
        <tr title="{{ $research->name }}" id="{{ $research->id }}">
            <td class="align-middle">{{ $research->key }}</td>
            <td class="align-middle">
                <k class="text-truncate-2" style="min-width: 200px; max-width: 600px">{{ $research->name }}</k>
            </td>
            @php
            $t=0; $d=0; $tb = 0;
            $es = $research->examiners()->wherePivot('round', $round??1)->get();
            @endphp
            @foreach ( $es as $e)
            @php
            $t+=$e->pivot->point;
            if($e->pivot->point)$d++;
            @endphp

            @if($e->pivot->comment!='Hủy')
            <td class="align-middle table-success text-center" title="{{$e->key}}">{{$e->pivot->point}}</td>
            @else
            <td class="align-middle table-danger text-center" title="{{$e->key}}">{{$e->pivot->point}}</td>
            <!-- <td onclick="{{'changeCM('.$research->id.','. $e->id.','. $round.')'}}" class="align-middle table-danger text-center" title="{{$e->key}}">{{$e->pivot->point}}</td> -->
            @endif
            @endforeach
            <td class="align-middle text-center">
                @if($d>0)
                {{round($t/$d,2)}}
                @endif
            </td>
            <td class="{{'align-middle text-center table-warning alert-link'}}">
                @if($round==1)
                {{$research->p1}}
                @else
                {{$research->p2}}
                @endif
            </td>
        </tr>
        @endforeach
    </table>
</div>

<div class="text-right mb-2">
    @can('point-report')
    <a class="btn btn-success" href="/reports/point?group_id={{$group->id}}&round={{$round}}">In danh sách điểm</a>
    @endcan
</div>

<script>
    function changeCM(a, b, c) {
        r = confirm('Bạn có muốn hủy điểm này không?')
        if (r) {
            var url = document.location.origin + '/medal-award/change?research_id=' + a+'&examiner_id='+b+'&round='+c;
            $.ajax({
                type: 'GET',
                url: url,
                data: '',
                dataType: 'json',
                async: false,
                success: function(data) {
                    console.log(data)
                    location.reload();
                }
            });
        }
    }
</script>
@endsection