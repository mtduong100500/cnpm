<html lang="{{ app()->getLocale() }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Danh sách thẻ dự thi</title>
    <style>
        @page {
            size: 36.78cm 27.01cm landscape;
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

        body {
            font-family: 'DOMPDF';
            margin: 0px;
            font-weight: 600;
        }

        .wrapper {
            /* position: relative; */
            /* background-image: url("{{ public_path('uploads/Scan 3 5.jpeg') }}"); */
            background-image: url("{{ public_path('uploads/BG.jpg') }}");
            width: 1020px;
            height: 1389px;
            background-size: cover;
            text-align: center;
            page-break-inside: avoid;
            /* border: 1px solid; */
        }

        .wrapper img {
            padding-top: 16.5em;
            width: 480px;
            height: 720px;
        }

        .wrapper img.img-error {
            padding-top: 24em;
            width: 480px;
            height: 600px;
        }

        .wrapper>div {
            font-size: 24;
        }

        .name {
            padding-top: 30px;
            color: red;
        }

        .nameT {
            /* color: red; */
            text-transform: uppercase;
            font-size: 40;
        }

        .dvdt {
            padding-top: 15px;
            color: blue;
            text-transform: uppercase;
        }

        .dvdt * {
            font-size: 36;
        }
    </style>
</head>

<body>
    @foreach ($researchs as $research)
    @php
    $research['student_1'] = explode(',', $research['student_1']);
    $research['student_2'] = explode(',', $research['student_2']);
    $research['teacher'] = explode(',', $research['teacher']);
    $files = $research->file()->where('type', 0)->get();
    $i=1;
    @endphp
    <div class="wrapper">
        <!-- <img src="{{public_path('uploads') . '/' . $files[0]->filename}}" alt=""><br> -->
        @if(count($files)>=1)
        <img src="{{public_path('uploads') . '/' . $files[0]->filename}}" alt=""><br>
        @else
        <img src="{{public_path('uploads') . '/user.jfif' }}" alt="" class="img-error"><br>
        @endif
        <div class="name">
            <k class="nameT">{{$research['student_1'][0]}}</k>
        </div>
        @php $d = explode('-', $research['student_1'][1]??"xxxx-xx-xx"); @endphp
        <div class="">Ngày sinh: <k>{{($d[2]??"--")."/".($d[1]??"--")."/".($d[0]??"--")}}</k>
        </div>
        <div class="">Trường: <k>{{$research->school->name}}</k>
        </div>
        <div class="">Đơn vị: <k>{{$research->user->name}}</k>
        </div>
    </div>
    @if($research['student_2'][0])
    @php $i=2; @endphp
    <div class="wrapper">
        <img src="{{public_path('uploads') . (count($files)>=2?('/' . $files[1]->filename):('/user.jfif') ) }}" alt=""><br>
        <!-- <div class="name">{{$research['student_2'][0]}}</div> -->

        <div class="name">
            <k class="nameT">{{$research['student_2'][0]}}</k>
        </div>
        @php $d = explode('-', $research['student_2'][1]??"xxxx-xx-xx"); @endphp
        <div class="">Ngày sinh: <k>{{($d[2]??"--")."/".($d[1]??"--")."/".$d[0]??"--"}}</k>
        </div>
        <div class="">Trường: <k>{{$research->school2->name}}</k>
        </div>
        <div class="">Đơn vị: <k>{{$research->user->name}}</k>
        </div>
    </div>
    @endif
    <div class="wrapper">
        @if(count($files)>$i)
        <img src="{{public_path('uploads') . '/' . $files[$i]->filename}}" alt=""><br>
        @else
        <img src="{{public_path('uploads') . '/user.jfif' }}" alt="" class="img-error"><br>
        @endif
        <div class="name">
            <k class="nameT">{{$research['teacher'][0]}}</k>
        </div>
        <div class="nameT">{{$research['teacher'][1]}}</div>
        <div class="">Đơn vị: <k>{{$research->user->name}}</k>
        </div>
        <div class="dvdt">
            <k>GIÁO VIÊN HƯỚNG DẪN</k>
        </div>
    </div>
    @endforeach
</body>

</html>