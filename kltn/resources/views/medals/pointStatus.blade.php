<div class="table-responsive">
    <table class="table table-bordered table-hover mb-0">
        <tr>
            <th>Mã</th>
            <th width="300px">Tên</th>
            <th>P1</th>
            <th>P2</th>
            <th>P3</th>
            <th>P4</th>
            <th>P5</th>
            <!-- <th>Tỷ lệ</th> -->
            <!-- <th>Giải</th> -->
        </tr>
        @foreach ($researchs as $research)
        <tr title="{{ $research->name }}">
            <td class="align-middle">{{ $research->key }}</td>
            <td class="align-middle">
                <k class="text-truncate-2" style="min-width: 200px; max-width: 700px">{{ $research->name }}</k>
            </td>
            @php
            $es = $research->examiners()->wherePivot('round', $round??1)->get(); 
            $d=0; 
            @endphp
            @foreach ( $es as $e)
            @if($e->pivot->point)
            @php $d++; @endphp
            <td class="align-middle table-success text-center">{{substr($e->key, -1)}}</td>
            @else
            <td class="align-middle text-center table-danger">{{substr($e->key, -1)}}</td>
            @endif
            @endforeach
        </tr>
        @endforeach
    </table>
</div>