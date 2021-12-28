<form class="mb-0" action="/researchs/medal" method="GET">
    <div class="card text-dark bg-light border-danger p-2 mb-2">
        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-10">
                <div class="row">
                    <input type="hidden" name="group_id" value="{{$group->id}}">
                    @foreach($medals as $k=> $m)
                    @if($k < 5)
                    <div class="col-xs-6 col-sm-6 col-md-3">
                        <div class="form-group required mb-0">
                            {!! Form::number('medals['.$k.']', '', array('required', 'placeholder' => $m,'class' => 'form-control', 'min'=>0)) !!}
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-2" style="margin: auto;">
                <button type="submit" class="btn btn-primary btn-block">Xác nhận</button>
            </div>
        </div>
    </div>
</form>