<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>STRUK PENJUALAN</title>

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
    <div style="text-align: center; margin-top: 40px; margin-bottom: 40px;">
        <u>
            <span style="font-size:20px; font-family: 'CustomFontBold';">{{$penjualan->place->nama}}</span><br>
        </u>
    </div>
    <span>Tanggal : {{date('d-m-Y', strtotime($penjualan->tanggal))}}</span>
    <br>
    <span>Kode Penjualan : {{$penjualan->kode}}</span>
    <table class="table" style="width: 100%; max-width: 100%; border:1px solid #000000;">
        <thead>
            <tr class="tr">
                <td class="td" style="text-align: center; font-family: 'CustomFontBold'; width: 15%;">Produk</td>
                <td class="td" style="text-align: center; font-family: 'CustomFontBold'; width: 15%;">Harga</td>
                <td class="td" style="text-align: center; font-family: 'CustomFontBold'; width: 15%;">Kuantitas</td>
                <td class="td" style="text-align: center; font-family: 'CustomFontBold'; width: 15%;">Sub Total</td>
            </tr>
        </thead>
        <tbody>
            @php
                $total = 0;
            @endphp
            @foreach ($penjualan->penjualan_detail as $item)
                <tr>
                    <td style="text-align: left; border: 1px solid #000;">{{ $item->product->nama }}</td>
                    <td style="text-align: right; border: 1px solid #000;">{{ number_format($item->harga , 0, ',', '.') }}</td>
                    <td style="text-align: right; border: 1px solid #000;">{{ number_format($item->qty , 0, ',', '.') }}</td>
                    <td style="text-align: right; border: 1px solid #000;">{{ number_format($item->sub_total , 0, ',', '.') }}</td>
                </tr>
            @php
                $total+=$item->sub_total;
            @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr class="tr">
                <td class="td" colspan="3" style="text-align: right; font-family: 'CustomFontBold';">Total</td>
                <td class="td" style="text-align: right; font-family: 'CustomFontBold';">{{number_format($total , 0, ',', '.')}}</td>
            </tr>
        </tfoot>
    </table>
    <br>
    <br>
    <br>
    <br>
    <div style="width: 30%; text-align: center">   
        <span style="text-align: center">Website Desa Wisata Taro</span>
        <img src="{{asset('qrcode.png')}}" alt="" style="width: 100px; height:100px; margin-top:10px;">
    </div>
    <br>
    <br>
    <div style="width: 100%; text-align: center">   
        <span style="text-align: center; font-family: 'CustomFontBold';">Terima Kasih Telah Berkunjung</span>
    </div>
</body>

</html>