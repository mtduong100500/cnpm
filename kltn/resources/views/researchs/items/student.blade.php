<div class="card text-dark bg-light border-primary p-3 mb-3 student" id="student_{!!$No!!}">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group required">
                <strong>Học sinh {!!$No!!}: </strong><span id="student{!!$No!!}_NAME"></span>
                {!! Form::text('student'.$No, $student[0]??'', array('required', 'placeholder' => 'Tên học sinh '.$No,'class' => 'form-control', 'id' => 'student'.$No.'_name')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group required">
                <strong>Ngày sinh:</strong>
                {!! Form::date('dob'.$No, $student[1]??'', array('onkeydown'=>"return false", 'required', 'placeholder' => 'Ngày sinh','class' => 'form-control', 'data-date-format'=>"dd-mm-yyyy")) !!}
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-2">
            <div class="form-group required">
                <strong>Giới tính:</strong>
                {!! Form::select('gender'.$No, ['Nam', 'Nữ', 'Khác'],$student[2]??'', array('required', 'placeholder' => 'Chọn giới tính','class' => 'form-control')) !!}
            </div>
        </div>
        @include('researchs.items.school', compact('school_id', 'No'))

        <div class="col-xs-6 col-sm-6 col-md-3">
            <div class="form-group required">
                <strong>Dân tộc:</strong>
                {!! Form::select('nation'.$No, ['Kinh','Tày','Thái','Mường','Khmer','Hoa','Nùng','H\'Mông','Dao','Gia Rai','Ê Đê','Ba Na','Sán Chay','Chăm','Cơ Ho','Xơ Đăng','Sán Dìu','Hrê','Ra Glai','Mnông','Thổ','Stiêng','Khơ mú','Bru - Vân Kiều','Cơ Tu','Giáy','Tà Ôi','Mạ','Giẻ-Triêng','Co','Chơ Ro','Xinh Mun','Hà Nhì','Chu Ru','Lào','La Chí','Kháng','Phù Lá','La Hủ','La Ha','Pà Thẻn','Lự','Ngái','Chứt','Lô Lô','Mảng','Cơ Lao','Bố Y','Cống','Si La','Pu Péo','Rơ Măm','Brâu','Ơ Đu'], $student[4]??'', array('required', 'placeholder' => 'Chọn dân tộc học sinh '.$No,'class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-3">
            <div class="form-group required">
                <strong>Lớp:</strong>
                {!! Form::select('grade'.$No, ['6'=>6,'7'=>7,'8'=>8,'9'=>9,'10'=>10,'11'=>11,'12'=>12],$student[3]??'', array('required', 'placeholder' => 'Chọn lớp','class' => 'grade-select form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-3">
            <div class="form-group required">
                <strong>Học lực:</strong>
                {!! Form::select('HL'.$No, ['Giỏi', 'Khá', 'Trung bình', 'Yếu', 'Kém'],$student[5]??'', array('required', 'placeholder' => 'Chọn học lực học sinh','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-3">
            <div class="form-group required">
                <strong>Hạnh kiểm:</strong>
                {!! Form::select('HK'.$No, ['Tốt', 'Khá', 'Trung bình', 'Yếu'],$student[6]??'', array('required', 'placeholder' => 'Chọn hạnh kiểm học sinh','class' => 'form-control')) !!}
            </div>
        </div>
    </div>
</div>
<style>
    input[type="date"]::-webkit-calendar-picker-indicator {
        background: transparent;
        bottom: 0;
        color: transparent;
        cursor: pointer;
        height: auto;
        left: 0;
        position: absolute;
        right: 0;
        top: 0;
        width: auto;
    }
</style>