<html lang="{{ app()->getLocale() }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Certificate</title>
    <style>
        @page {
            size: A4 landscape;
            /* size: 2480px 3508px landscape; */
            margin: 0px;
        }

        @font-face {
            font-family: 'DOMPDF';
            src: url("{{storage_path('fonts/times.ttf')}}");
            font-weight: 500;
        }

        @font-face {
            font-family: 'DOMPDF';
            src: url("{{storage_path('fonts/timesi.ttf')}}");
            font-weight: 400;
        }

        @font-face {
            font-family: 'DOMPDF';
            src: url("{{storage_path('fonts/timesbd.ttf')}}");
            font-weight: 600;
        }

        * {
            margin: 0;
        }

        body {
            font-family: 'DOMPDF';
            margin: 0px;
            font-weight: 400;
            /* font-size: 3.1em; */
            font-size: 1.2em;
        }

        .wrapper {
            /* background-image: url("{{ storage_path('img/certificate.jpg') }}"); */
            height: 100%;
            width: 100%;
            background-size: cover;
            text-align: center;
            page-break-inside: avoid;
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
            /* text-transform: uppercase; */
            text-align: center;
            /* font-weight: 600; */
            font-size: 1.2em;
        }

        .nameV {
            width: 38%;
            top: 32.9%;
            left: 57%;
            /* text-transform: uppercase; */
            text-align: center;
            /* font-weight: 600; */
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
            width: 42%;
            top: 43.5%;
            left: 6.5%;
            /* text-transform: capitalize; */
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
            /* line-height: 1.5em; */
        }

        .mE-1 {
            width: 42%;
            left: 6.5%;
            top: 59.5%;
            text-align: justify;
            /* line-height: 1.5em; */
        }

        .mE-2 {
            width: 42%;
            left: 6.5%;
            top: 64.5%;
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
$str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???)/", 'a', $str);
$str = preg_replace("/(??|??|???|???|???|??|???|???|???|???|???)/", 'e', $str);
$str = preg_replace("/(??|??|???|???|??)/", 'i', $str);
$str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???)/", 'o', $str);
$str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???)/", 'u', $str);
$str = preg_replace("/(???|??|???|???|???)/", 'y', $str);
$str = preg_replace("/(??)/", 'd', $str);
$str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???)/", 'A', $str);
$str = preg_replace("/(??|??|???|???|???|??|???|???|???|???|???)/", 'E', $str);
$str = preg_replace("/(??|??|???|???|??)/", 'I', $str);
$str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???)/", 'O', $str);
$str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???)/", 'U', $str);
$str = preg_replace("/(???|??|???|???|???)/", 'Y', $str);
$str = preg_replace("/(??)/", 'D', $str);
return $str;
}

@endphp

<body>
    @php
    $i=1;
    @endphp
    @foreach ($data['researchs'] as $research)
    @php
    $research['student_1'] = explode(',', $research['student_1']);
    $research['student_2'] = explode(',', $research['student_2']);
    @endphp
    <div class="wrapper">
        @php $d = explode('-', $research['student_1'][1]??"xxxx-xx-xx"); @endphp
        <k class="nameE-v">It is hereby certified that</k>
        <k class="nameE"><b style="text-transform: uppercase;">{{convert_name($research['student_1'][0])}}</b></k>
        <k class="dateE">Date of birth: <b>{{($d[1]??"--")."/".($d[2]??"--")."/".($d[0]??"--")}}</b></k>
        <k class="schoolE">School: <b>{{($research->school->nameEn)}}</b></k>
        <k class="pE">Province/City: <b>{{convert_name($research->province->name??'')}}</b></k>

        <k class="mE">has successfully participated in the VietNam National</k>
        <k class="mE-1">Secondary Student Science and Engineering Fair</k>
        <k class="mE-2">2020-2021 and won the <b>{{$research->medal->nameEn??''}}</b> prize in the field of <br><b>{{$research->field->nameEn??''}}</b></k>

        <k class="nameV"><b style="text-transform: uppercase;">{{$research['student_1'][0]}}</b></k>
        <k class="dateV">Ng??y sinh: <b>{{($d[2]??"--")."/".($d[1]??"--")."/".($d[0]??"--")}}</b></k>
        <k class="schoolV">Tr?????ng: <b>{{$research->school->name}}</b></k>
        <k class="pV">T???nh/Th??nh ph???: <b>{{$research->province->name??''}}</b></k>
        <k class="mV">C?? ????? t??i tham d??? v?? ?????t gi???i: <b>{{$research->medal->name??''}}</b></k>
        <k class="fV">L??nh v???c: <b>{{$research->field->name??''}}</b></k>
        <k class="tV"><b>Cu???c thi khoa h???c k??? thu???t c???p qu???c gia h???c sinh trung h???c n??m h???c 2020 - 2021</b></k>
        <k class="no">S??? ????ng k??/Registration N<u>o</u>: <b>21-{{$research->user->no>9?$research->user->no:('0'.$research->user->no)}}-{{$i < 100?($i < 10? ('00'.$i):('0'.$i)):$i}}</b></k>
    </div>
    @php $i++; @endphp
    @if($research['student_2'][0])
    <div class="wrapper">
        @php $d = explode('-', $research['student_2'][1]??"xxxx-xx-xx"); @endphp
        <k class="nameE-v">It is hereby certified that</k>
        <k class="nameE"><b style="text-transform: uppercase;">{{convert_name($research['student_2'][0])}}</b></k>
        <k class="dateE">Date of birth: <b>{{($d[1]??"--")."/".($d[2]??"--")."/".($d[0]??"--")}}</b></k>
        <k class="schoolE">School: <b>{{($research->school2->nameEn)}}</b></k>
        <k class="pE">Province/City: <b>{{convert_name($research->province->name??'')}}</b></k>

        <k class="mE">has successfully participated in the VietNam National</k>
        <k class="mE-1">Secondary Student Science and Engineering Fair</k>
        <k class="mE-2">2020-2021 and won the <b>{{$research->medal->nameEn??''}}</b> prize in the field of <br><b>{{$research->field->nameEn??''}}</b></k>

        <k class="nameV"><b style="text-transform: uppercase;">{{$research['student_2'][0]}}</b></k>
        <k class="dateV">Ng??y sinh: <b>{{($d[2]??"--")."/".($d[1]??"--")."/".($d[0]??"--")}}</b></k>
        <k class="schoolV">Tr?????ng: <b>{{$research->school2->name}}</b></k>
        <k class="pV">T???nh/Th??nh ph???: <b>{{$research->province->name??''}}</b></k>
        <k class="mV">C?? ????? t??i tham d??? v?? ?????t gi???i: <b>{{$research->medal->name??''}}</b></k>
        <k class="fV">L??nh v???c: <b>{{$research->field->name??''}}</b></k>
        <k class="tV"><b>Cu???c thi khoa h???c k??? thu???t c???p qu???c gia h???c sinh trung h???c n??m h???c 2020 - 2021</b></k>
        <k class="no">S??? ????ng k??/Registration N<u>o</u>: <b>21-{{$research->user->no>9?$research->user->no:('0'.$research->user->no)}}-{{$i < 100?($i < 10? ('00'.$i):('0'.$i)):$i}}</b></k>
    </div>
    @php $i++; @endphp
    @endif
    @endforeach
</body>

</html>