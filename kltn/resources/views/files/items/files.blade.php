<div class="card text-dark bg-light border-success mb-3" id="list-files">
    <div class="card-header">
        <div class="float-left">
            DANH SÁCH TỆP ĐÍNH KÈM <b class="text-red">(Bắt buộc để được phê duyệt)</b>
        </div>
        <div class="float-right">
            <a class="btn btn-primary" href="{{ asset('uploads/20201007_CV Huong dan HD NCKHKT_2020-2021.pdf') }}"> Công văn hướng dẫn</a>
        </div>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            @include('files.items.file', ['id'=>$id, 'files'=>$files, 'type' => 1 ])
        </li>
        <li class="list-group-item">
            @include('files.items.file', ['id'=>$id, 'files'=>$files, 'type' => 2 ])
        </li>
        <li class="list-group-item">
            @include('files.items.file', ['id'=>$id, 'files'=>$files, 'type' => 3 ])
        </li>
        <li class="list-group-item">
            @include('files.items.file', ['id'=>$id, 'files'=>$files, 'type' => 0 ])
        </li>
    </ul>
</div>