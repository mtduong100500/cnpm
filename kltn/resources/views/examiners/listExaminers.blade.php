@foreach ($examiners as $examiner)
<div class="card text-dark bg-light border-primary p-3 mb-3">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h3>{{'0'.$round.'-'.$examiner->key.': '.$examiner->name??''}} </h3>
            </div>
            <div class="float-right">
                @can('group-create')
                <a class="btn btn-success" href="{{ '/groups/'.$group->id .'/setup?download=true&round='.$round.'&examiner_id='.$examiner->id }}">Tải danh sách</a>
                @endcan
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            @include('examiners.listResearch', [
            'researchs'=> $examiner->researchs()->wherePivot('round', $round??1)->orderBy('key', 'ASC')->get()
            ])
        </div>
    </div>
</div>
@endforeach