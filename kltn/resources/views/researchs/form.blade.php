<div class="card text-dark bg-light border-danger p-3 mb-3">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group required">
                <strong>Tên đề tài (Tiếng Việt):</strong>
                {!! Form::textarea('name', $research->name??'', array('rows' => 2, 'style' => 'resize:none','placeholder' => 'Nhập tên đề tài - Tiếng Việt','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group required">
                <strong>Tên đề tài (Tiếng Anh):</strong>
                {!! Form::textarea('nameEn', $research->nameEn??'', array('rows' => 2, 'style' => 'resize:none','placeholder' => 'Nhập tên đề tài - Tiếng Anh ','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group required">
                <strong>Lĩnh vực (Tiếng Việt):</strong>
                {!! Form::select('field_id', $fields, $research->field_id??0, array('required', 'placeholder' => 'Chọn lĩnh vực...', 'class' => 'form-control', 'id' => 'fieldVi')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Lĩnh vực (Tiếng Anh):</strong>
                <input disabled type="text" id="fieldEn" value="{{ $fieldsEn[$research->field_id??0]??'' }}" class="form-control" placeholder="Tên lĩnh vực - Tiếng Anh">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group required">
                <strong>Tỉnh/Thành phố:</strong>
                {!! Form::select('province_id', $provinces??[], $research->province_id??$user->id_ref??'', array('placeholder'=>'Chọn tỉnh','class' => 'form-control', 'required', 'id'=>'provinceID', (($user->role??1)>2)?'disabled':'')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group required">
                <strong>Đơn vị dự thi:</strong>
                {!! Form::select('user_id', $users??[], $research->user_id??$user->id??0, array('required', 'placeholder' => 'Chọn đơn vị dự thi...', 'class' => 'form-control', (($user->role??1)>2)?'disabled':'')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group required mb-0">
                <div style="line-height: 36px;" id='research-type'>
                    <strong class="mr-3">Loại dự án:</strong>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="type" {{ (($research->type??1)==1?'checked':'') }} value="1">Cá nhân
                        </label>
                    </div>
                    <div class="form-check-inline" id="type_2">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="type" {{ (($research->type??1)==2?'checked':'') }} value="2">Tập thể
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group required mb-0">
                <div style="line-height: 36px;" id='research-level'>
                    <strong class="mr-3">Cấp học:</strong>
                    <!-- <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="level" {{ (($research->level??1)==1?'checked':'') }} value="1">Tất cả
                        </label>
                    </div> -->
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="level" {{ (($research->level??2)==2?'checked':'') }} value="2">THCS
                        </label>
                    </div>
                    <div class="form-check-inline" id="type_2">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="level" {{ (($research->level??1)==3?'checked':'') }} value="3">THPT
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="students"> 
@include('researchs.items.student', ['student' => $research['student_1']??[], 'No' => 1, 'provinces'=>$provinces, 'province_id'=>$research->province_id??0, 'school_id'=>$research->school_1??''])
@include('researchs.items.student', ['student' => $research['student_2']??[], 'No' => 2, 'provinces'=>$provinces, 'province_id'=>$research->province_id??0, 'school_id'=>$research->school_2??''])

</div>
@include('researchs.items.teacher', ['teacher' => $research['teacher']??[], 'No' => 1])

<script>
    $(document).ready(function() {
        $("#student1_NAME").html(removeUnicode($("#student1_name").val().slice(0, 20)).toUpperCase());
        $("#student2_NAME").html(removeUnicode($("#student2_name").val().slice(0, 20)).toUpperCase());
        var targetBox = $("#student_2");
        if ({!!$research->type ?? 1!!} == 1) $("#student_2").remove();
        $('#research-type input[type="radio"]').click(function() {
            var inputValue = $(this).attr("value");
            if (inputValue == 2) $('#students').append(targetBox);
            else $('#student_2').remove();
        });
        $('#research-level input[type="radio"]').click(function() {
            var inputValue = $(this).attr("value");
            renderSchool(schools, inputValue);
            var select = $('.grade-select').empty();
            select.append("<option> Chọn lớp </option>")
            if (inputValue == 2) grades = [6, 7, 8, 9]
            else grades = [10, 11, 12]
            for (i = 0; i < grades.length; i++) {
                select.append("<option value='" + grades[i] + "'>" + grades[i] + "</option>");
            }
        });
    });

    var schools = {!!str_replace("'", "\'", json_encode($schools ?? [])) !!} || [];
    if (!Object.entries(schools).length) getSchool();

    var fields = {!!str_replace("'", "\'", json_encode($fieldsEn)) !!}; //eslint-disable-line
    $('#fieldVi').on('change', function(e) {
        var optionSelected = $("option:selected", this);
        var valueSelected = this.value;
        $('#fieldEn').val(fields[valueSelected])
    });

    $("#student1_name").on("input", function() {
        $("#student1_name").val(toTitleCase($(this).val()));
        $("#student1_NAME").html(removeUnicode($(this).val().slice(0, 20)).toUpperCase());
    });
    $("#student2_name").on("input", function() {
        $("#student2_name").val(toTitleCase($(this).val()));
        $("#student2_NAME").html(removeUnicode($(this).val().slice(0, 20)).toUpperCase());
    });
    $("#teacher_name").on("input", function() {
        $("#teacher_name").val(toTitleCase($(this).val()));
    });


    $('#provinceID').on('change', function() {
        getSchool()
    });

    $('#school1_ID').on('change', function() {
        getNameEnSchool(1)
    });
    $('#school2_ID').on('change', function() {
        getNameEnSchool(2)
    });
    if($('#school1_ID').val())getNameEnSchool(1)
    if($('#school2_ID').val())getNameEnSchool(2)

    function getNameEnSchool(i) {
        var list_url = document.location.origin + '/schools/name_en/' + $('#school' + i + '_ID').val();
        $.ajax({
            type: 'GET',
            url: list_url,
            data: '',
            dataType: 'json',
            async: false,
            success: function(data) {
                $('#school' + i + '_nameEn').val(data[0].nameEn)
            }
        });
    }

    function getSchool() {
        var state_code = $('#provinceID').val();
        var list_url = document.location.origin + '/schools/list?province_id=' + state_code;
        $.ajax({
            type: 'GET',
            url: list_url,
            data: '',
            dataType: 'json',
            async: false,
            success: function(i) {
                schools = i.reduce((obj, item) => {
                    return {
                        ...obj,
                        [item['key']]: item['name']
                    }
                }, {})
                renderSchool(schools)
            }
        });
    }

    function renderSchool(data, level = 2) {
        var select = $('.schoolID').empty();
        for (const [key, value] of Object.entries(data)) {
            if ((level == 1) || (level == 2 && (value.indexOf('THCS') >= 0 || value.indexOf('thcs') >= 0 || value.indexOf('cơ sở') >= 0)) ||
                (level == 3 && (value.indexOf('THPT') >= 0 || value.indexOf('thpt') >= 0 || value.indexOf('hổ thông')) >= 0))
                select.append("<option value='" + key + "'>" + value + "</option>");
        }
    }
</script>