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
            /* background-image: url("{{ storage_path('img/GCN-GV.jpg') }}"); */
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
            font-size: 1.1em;
            font-weight: 500;
        }

        .name {
            top: 30%;
            left: 19.5%;
            width: 61%;
            text-align: center;
            font-size: 1.3em;
            /* font-weight: 600;
            text-transform: uppercase; */
        }

        .province {
            top: 37%;
            left: 19.5%;
            width: 61%;
        }

        .student-1 {
            top: 44%;
            left: 19.5%;
            width: 61%;
        }

        .student-2 {
            top: 50%;
            left: 38%;
            width: 42.5%;
        }

        .medal {
            top: 56%;
            left: 19.5%;
            width: 61%;
        }

        .field {
            top: 56%;
            left: 40.5%;
            width: 40%;
        }

        .no {
            width: 41%;
            top: 84.5%;
            left: 13%;
        }
    </style>
</head>

<body>
    @php
    $i=1;
    @endphp
    @foreach ($researchs as $research)
    @php
    $research['teacher'] = explode(',', $research['teacher']);
    $research['student_1'] = explode(',', $research['student_1']);
    $research['student_2'] = explode(',', $research['student_2']);
    @endphp
    <div class="wrapper">
        <k class="name">Ông/Bà: <b style="text-transform: uppercase;">{{$research['teacher'][0]}}</b></k>
        <k class="province">Tỉnh/Thành phố: <b>{{$research->province->name}}</b></k>
        <k class="student-1">Đã hướng dẫn học sinh: <b>{{$research['student_1'][0]}}</b></k>
        <k class="student-2"><b>{{$research['student_2'][0]??''}}</b></k>

        <k class="medal">Đạt giải: <b>{{$research->medal->name}}</b></k>
        <k class="field">Lĩnh vực: <b>{{$research->field->name}}</b></k>
        @php $id = $research->user->no>9?$research->user->no: ('0'.$research->user->no); @endphp
        <k class="no">
            <l style="font-weight: 400;">Số đăng kí:</l> <b>21-GV-{{$id}}-{{$i < 10?('0'.$i):$i}}</b>
        </k>
    </div>
    @php $i++; @endphp
    @endforeach
</body>

</html>