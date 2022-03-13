<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>INVOICE</title>

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
            height: 120px;
            width: 100px;
        }
    </style>
</head>

<body>
    <img src="{{asset('logo.png')}}" class="logo">
    <div style="text-align: center; margin-top: 40px; margin-bottom: 40px;">
        <u>
            <span style="font-size:20px; font-family: 'CustomFontBold';">INVOICE</span><br>
        </u>
        <span style="font-size:15px;">NO : {{$no_invoice}}</span><br>
    </div>
    <div style="position:absolute; top: 0; left: 900px; width:100%">
        <span style="font-size:15px;">Tgl : {{date('d-m-Y', strtotime(\Carbon\Carbon::now()))}}</span><br>
    </div>
    <span>Kepada Yth. Pengurus {{$tempat_wisata}}</span><br>
    <span>Berikut ini kami sampaikan tagihan Anda kepada Unit Desa Wisata Taro untuk Bulan {{$bulan}} tahun {{$tahun}} dengan rincian sebagai berikut:</span>
    <br>
    <br>
    <table class="table" style="width: 100%; max-width: 100%; border:1px solid #000000;">
        <thead>
            <tr class="tr">
                <td class="td" style="text-align: center; font-family: 'CustomFontBold'; width: 15%;">Keterangan</td>
                <td class="td" style="text-align: center; font-family: 'CustomFontBold'; width: 15%;">Harga</td>
                <td class="td" style="text-align: center; font-family: 'CustomFontBold'; width: 15%;">Jumlah Penjualan</td>
                <td class="td" style="text-align: center; font-family: 'CustomFontBold'; width: 15%;">Total Pendapatan</td>
                <td class="td" style="text-align: center; font-family: 'CustomFontBold'; width: 15%;">Pendapatan Objek Wisata</td>
                <td class="td" style="text-align: center; font-family: 'CustomFontBold'; width: 15%;">Pendapatan Desa Wisata</td>
            </tr>
        </thead>
        <tbody>
            @php
                $total = 0;
            @endphp
            @foreach ($penjualan as $item)
                <tr>
                    <td style="text-align: left; border: 1px solid #000;">{{ $item->nama }}</td>
                    <td style="text-align: right; border: 1px solid #000;">{{ number_format($item->harga , 0, ',', '.') }}</td>
                    <td style="text-align: right; border: 1px solid #000;">{{ number_format($item->jumlah_penjualan , 0, ',', '.') }}</td>
                    <td style="text-align: right; border: 1px solid #000;">{{ number_format($item->total_pendapatan , 0, ',', '.') }}</td>
                    <td style="text-align: right; border: 1px solid #000;">{{ number_format($item->pendapatan_objek_wisata , 0, ',', '.') }}</td>
                    <td style="text-align: right; border: 1px solid #000;">{{ number_format($item->pendapatan_desa_wisata , 0, ',', '.') }}</td>
                </tr>
            @php
                $total+=$item->pendapatan_desa_wisata;
            @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr class="tr">
                <td class="td" colspan="5" style="text-align: right; font-family: 'CustomFontBold';">Total Tagihan</td>
                <td class="td" style="text-align: right; font-family: 'CustomFontBold';">{{number_format($total , 0, ',', '.')}}</td>
            </tr>
        </tfoot>
    </table>
    <br>
    <span>Mohon melakukan penyetoran uang retribusi segera ke bagian Unit Desa Wisata Taro.</span><br>
    <span>Atas perhatian dan kerja samanya, kami mengucapkan terima kasih. </span>
    <br>
    <br>
    <table style="float:left;">
       
        <tr>
            <td>Disiapkan Oleh: <br>Bendahara Unit Desa Wisata Taro</td>
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
            <td colspan="3">{{getSettings('bendahara')}}</td>
        </tr>
    </table>
    <table style="float:right; padding-right:100px">
       
        <tr>
            <td>Diketahui Oleh: <br>Kepala Unit Desa Wisata Taro</td>
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
            <td colspan="3">{{getSettings('kepala')}}</td>
        </tr>
    </table>
</body>

</html>