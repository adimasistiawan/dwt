<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KUITANSI</title>

    <!-- Select2 -->
    {{-- <script src="{{asset('dashboard/plugins/jquery/jquery.min.js')}}"></script> --}}
    <style>
        @font-face {
            font-family: 'CustomFont';
            src: url('{{asset("Calibri Regular.ttf")}}') format('truetype')
        }

        @font-face {
            font-family: 'CustomFontBold';
            src: url('{{asset("Calibri Bold.ttf")}}') format('truetype')
        }

        * {
            font-size: 16px;
            font-family: 'CustomFont';
            line-height: 16px;
        }

        .select2-container--default .select2-selection--single {
            width: 244.167px;
        }

        .thead-dark {
            background-color: #b2bec3;
            color: black;
        }

        .table, .table2 {
            border-collapse: collapse;
        }

        .table2{
            font-size: 14px !important;
        }

        .table,
        .th,
        .td {
            border: 1px solid black;
            font-size: 16px;
            
        }

        td{
            padding: 0 3px !important;
        }

        .tr {
            border: 1px solid #000000;
        }
        .logo{
            position: absolute;
            top: 0;
            left: 20px;
            height: 100px;
            width: 100px;
        }
    </style>
</head>

<body>
    @php
        $logo = getSettings('logo');
    @endphp
    <img src="{{asset($logo)}}" class="logo">
    <div style="text-align: center; margin-top: 40px; margin-bottom: 40px;">
        <u>
            <span style="font-size:20px; font-family: 'CustomFontBold';">KUITANSI</span><br>
        </u>
        <span style="font-size:15px;">NO : {{$no}}</span><br>
    </div>
    <div style="position:absolute; top: 40px; left: 550px; width:100%">
        <span style="font-size:15px;">{{date('d-m-Y', strtotime($tanggal))}}</span><br>
    </div>
    
    <br>
    <br>
    <table style="margin-left:50px;">
      
        <tbody class="table">
            <tr >
                <td style="font-family: 'CustomFontBold'; width: 150px;">Telah Diterima Dari</td>
                <td style="width: 10px;">:</td>
                <td style="width: 400px;">{{$tempat_wisata}}</td>
            </tr>
            <tr >
                <td style="font-family: 'CustomFontBold'; width: 150px;">Sejumlah Uang</td>
                <td style="width: 10px;">:</td>
                <td style="width: 40px;">{{number_format($total , 0, ',', '.')}}</td>
            </tr>
            <tr >
                <td style="font-family: 'CustomFontBold'; width: 150px;">Terbilang</td>
                <td style="width: 10px;">:</td>
                <td style="width: 40px;"><i>{{$terbilang}}</i></td>
            </tr>
            <tr >
                <td style="font-family: 'CustomFontBold'; width: 150px;">Untuk Pembayaran</td>
                <td style="width: 10px;">:</td>
                <td style="width: 40px;">{{$no_invoice}}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <br>
    <br>
    <br>
    <table style="float:left;">
       
        <tr>
            <td>Diterima Oleh: <br>Manajer Unit Desa Wisata Taro</td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3">{{getSettings('manager')}}</td>
        </tr>
    </table>
    <table style="float:right; padding-right:100px">
       
        <tr>
            <td>Disetor Oleh: <br>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3">________________________</td>
        </tr>
    </table>
</body>

</html>