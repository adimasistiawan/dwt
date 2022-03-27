<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PRODUK</title>

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
    <div style="text-align: center; margin-top: 50px; margin-bottom: 50px;">
        <span style="font-size:20px; font-family: 'CustomFontBold';">UNIT DESA WISATA TARO</span><br>
        <u>
            <span style="font-size:20px; font-family: 'CustomFontBold';">LAPORAN PENJUALAN PRODUK</span><br>
        </u>
        <span style="font-size:15px;">TEMPAT : {{$tempat_wisata}}</span><br>
        <span style="font-size:15px;">NAMA PRODUK : {{$nama_produk}}</span><br>
       
    </div>
    <span style="font-size:15px;">DARI TANGGAL : {{$dari}}</span><br>
    <span style="font-size:15px;">SAMPAI TANGGAL : {{$sampai}}</span><br>
    <table class="table" style="width: 100%; max-width: 100%; border:1px solid #000000;">
        <thead>
            <tr class="tr">
                <td class="td" style="text-align: center; font-family: 'CustomFontBold'; width: 15%;">Kode Penjualan</td>
                <td class="td" style="text-align: center; font-family: 'CustomFontBold'; width: 15%;">Tanggal</td>
                <td class="td" style="text-align: center; font-family: 'CustomFontBold'; width: 15%;">Harga</td>
                <td class="td" style="text-align: center; font-family: 'CustomFontBold'; width: 15%;">Kuantitas</td>
                <td class="td" style="text-align: center; font-family: 'CustomFontBold'; width: 15%;">Sub total</td>
                <td class="td" style="text-align: center; font-family: 'CustomFontBold'; width: 15%;">Keterangan</td>
            </tr>
        </thead>
        <tbody>
            @php
                $total = 0;
            @endphp
            @foreach ($penjualan as $item)
                <tr>
                    <td style="text-align: left; border: 1px solid #000;">{{ $item->penjualan->kode }}</td>
                    <td style="text-align: center; border: 1px solid #000;">{{ $item->penjualan->tanggal }}</td>
                    <td style="text-align: right; border: 1px solid #000;">{{ number_format($item->harga , 0, ',', '.') }}</td>
                    <td style="text-align: right; border: 1px solid #000;">{{ number_format($item->qty , 0, ',', '.') }}</td>
                    <td style="text-align: right; border: 1px solid #000;">{{ number_format($item->sub_total , 0, ',', '.') }}</td>
                    <td style="text-align: right; border: 1px solid #000;">{{$item->penjualan->keterangan}}</td>
                </tr>
            @php
                $total+=$item->sub_total;
            @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr class="tr">
                <td class="td" colspan="4" style="text-align: right; font-family: 'CustomFontBold';">Total</td>
                <td class="td" style="text-align: right; font-family: 'CustomFontBold';">{{number_format($total , 0, ',', '.')}}</td>
                <td></td>
            </tr>
            <tr class="tr">
                <td class="td" colspan="4" style="text-align: right; font-family: 'CustomFontBold';">Komisi {{$komisi}} %</td>
                <td class="td"  style="text-align: right; font-family: 'CustomFontBold';">{{number_format(($total * $komisi / 100) , 0, ',', '.')}}</td>
                <td></td>
            </tr>
        </tfoot>
    </table>
    <br>
    <br>
</body>

</html>