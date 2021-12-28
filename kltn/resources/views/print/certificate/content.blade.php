<html lang="{{ app()->getLocale() }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Certificate</title>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <link href="{{ asset('css/app.min.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <style>
        * {
            margin: 0;
        }


        @page {
            size: A4 landscape;
            /* size: 2480px 3508px landscape; */
            margin: 0px;
        }

        @media print {

            footer,
            .one-page {
                page-break-after: always;
            }
        }

        body {
            font-family: "Times New Roman", Times, serif;
            margin: 0px;
            /* font-size: 3.1em; */
            font-size: 1.2em;
        }

        .wrapper {
            height: 100%;
            width: 100%;
            background-size: cover;
            text-align: center;
            page-break-inside: avoid;
            position: relative;
        }

        k {
            position: absolute;
            display: block;
            text-align: left;
            /* border: 1px solid; */
            font-size: 1em;
            font-weight: 500;
        }

        .nameE-v {
            width: 39%;
            top: 27.8%;
            left: 6.5%;
        }

        .nameE {
            width: 39%;
            top: 32.9%;
            left: 6.5%;
            text-transform: uppercase;
            text-align: center;
            font-weight: 600;
            font-size: 1.2em;
        }

        .nameV {
            width: 38%;
            top: 32.9%;
            left: 57%;
            text-transform: uppercase;
            text-align: center;
            font-weight: 600;
            font-size: 1.2em;
        }

        .dateE {
            width: 28%;
            top: 38.6%;
            left: 6.5%;
        }

        .dateV {
            width: 38%;
            top: 38.6%;
            left: 57%;
        }

        .schoolE {
            width: 39%;
            top: 43.5%;
            left: 6.5%;
            text-transform: capitalize;
        }

        .schoolV {
            width: 38%;
            left: 57%;
            top: 43.5%;
        }


        .pE {
            width: 29%;
            top: 49.2%;
            left: 6.5%;
        }

        .pV {
            width: 38%;
            left: 57%;
            top: 49.2%;
        }


        .mE {
            width: 39%;
            left: 6.5%;
            top: 54.5%;
            text-align: justify;
            line-height: 1.5em;
        }

        .mV {
            width: 38%;
            left: 57%;
            top: 55.2%;
        }

        .fE {
            width: 41%;
            top: 69.3%;
            left: 6.5%;
            text-align: center;
        }

        .fV {
            width: 38%;
            left: 57%;
            top: 67.2%;
        }

        .tV {
            width: 30%;
            left: 61%;
            top: 59%;
            /* border: 1px solid; */
            text-align: center;
        }

        .no {
            width: 41%;
            top: 88.2%;
            left: 6.5%;
        }
    </style>
</head>
@php
function convert_name($str) {
$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
$str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
$str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
$str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
$str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
$str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
$str = preg_replace("/(đ)/", 'd', $str);
$str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
$str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
$str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
$str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
$str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
$str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
$str = preg_replace("/(Đ)/", 'D', $str);
return $str;
}
@endphp


<body>
    @php
    $i=1;
    @endphp
    @foreach ($researchs as $research)
    @php
    $research['student_1'] = explode(',', $research['student_1']);
    $research['student_2'] = explode(',', $research['student_2']);
    @endphp
    <div class="wrapper one-page">
        @php $d = explode('-', $research['student_1'][1]??"xxxx-xx-xx"); @endphp
        <k class="nameE-v">It is hereby certified that</k>
        <k class="nameE">{{convert_name($research['student_1'][0])}}</k>
        <k class="dateE">Date of birth: <b>{{($d[1]??"--")."/".($d[2]??"--")."/".($d[0]??"--")}}</b></k>
        <k class="schoolE">School: <b>{{strtolower($research->school->nameEn)}}</b></k>
        <k class="pE">Province/City: <b>{{convert_name($research->province->name??'')}}</b></k>

        <k class="mE">has successfully participated in the Viet Nam National Secondary Student Science and Engineering Fair 2020-2021 and won the <b>{{$research->medal->nameEn??''}}</b> prize in the field of <br><b>{{$research->field->nameEn??''}}</b></k>

        <k class="nameV">{{$research['student_1'][0]}}</k>
        <k class="dateV">Ngày sinh: <b>{{($d[2]??"--")."/".($d[1]??"--")."/".($d[0]??"--")}}</b></k>
        <k class="schoolV">Trường: <b>{{$research->school->name}}</b></k>
        <k class="pV">Tỉnh/Thành phố: <b>{{$research->province->name??''}}</b></k>
        <k class="mV">Có đề tài tham dự và đạt giải: <b>{{$research->medal->name??''}}</b></k>
        <k class="fV">Lĩnh vực: <b>{{$research->field->name??''}}</b></k>
        <k class="tV"><b>Cuộc thi khoa học kỹ thuật cấp quốc gia học sinh trung học năm học 2020 - 2021</b></k>
        <k class="no">Số đăng kí/Registration N<u>o</u>: <b>21-{{$research->medal_id}}-{{$research->province_id}}-{{$i < 10?('0'.$i):$i}}</b></k>
    </div>
    @php $i++; @endphp
    @if($research['student_2'][0])
    <div class="wrapper one-page">
        @php $d = explode('-', $research['student_2'][1]??"xxxx-xx-xx"); @endphp
        <k class="nameE-v">It is hereby certified that</k>
        <k class="nameE">{{convert_name($research['student_2'][0])}}</k>
        <k class="dateE">Date of birth: <b>{{($d[1]??"--")."/".($d[2]??"--")."/".($d[0]??"--")}}</b></k>
        <k class="schoolE">School: <b>{{strtolower($research->school->nameEn)}}</b></k>
        <k class="pE">Province/City: <b>{{convert_name($research->province->name??'')}}</b></k>

        <k class="mE">has successfully participated in the Viet Nam National Secondary Student Science and Engineering Fair 2020-2021 and won the <b>{{$research->medal->nameEn??''}}</b> prize in the field of <br><b>{{$research->field->nameEn??''}}</b></k>

        <k class="nameV">{{$research['student_2'][0]}}</k>
        <k class="dateV">Ngày sinh: <b>{{($d[2]??"--")."/".($d[1]??"--")."/".($d[0]??"--")}}</b></k>
        <k class="schoolV">Trường: <b>{{$research->school->name}}</b></k>
        <k class="pV">Tỉnh/Thành phố: <b>{{$research->province->name??''}}</b></k>
        <k class="mV">Có đề tài tham dự và đạt giải: <b>{{$research->medal->name??''}}</b></k>
        <k class="fV">Lĩnh vực: <b>{{$research->field->name??''}}</b></k>
        <k class="tV"><b>Cuộc thi khoa học kỹ thuật cấp quốc gia học sinh trung học năm học 2020 - 2021</b></k>
        <k class="no">Số đăng kí/Registration N<u>o</u>: <b>21-{{$research->medal_id}}-{{$research->province_id}}-{{$i < 10?('0'.$i):$i}}</b></k>
    </div>
    @php $i++; @endphp
    @endif
    @endforeach

    <script>
        $(document).ready(function() {
            window.print();
            window.onafterprint = function() {
                $('.printpage', window.parent.document).hide();
            }
        });
    </script>
</body>

</html>