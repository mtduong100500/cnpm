<div class="col-xs-12 col-sm-12 col-md-6">
    <div class="form-group required">
        <strong>Trường:</strong>
        {!! Form::select('school_'.$No, $schools??[], $school_id, array('placeholder' => 'Chọn trường','class' => 'form-control my-select schoolID '.($errors->has('school_'.$No) ? ' is-invalid' : ''), 'id'=>'school'.$No.'_ID')) !!}
        @if($errors->has('school_'.$No))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('school_'.$No) }}</strong>
        </span>
        @endif
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-6">
    <div class="form-group required">
        <strong>Tên trường (Tiếng Anh): </strong>
        {!! Form::text('school'.$No.'_nameEn', '', array( 'required','placeholder' => 'Nhập tên trường bằng Tiếng Anh','class' => 'form-control', 'id' => 'school'.$No.'_nameEn')) !!}
    </div>
</div>