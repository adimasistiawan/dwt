<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LAPORAN PERKIRAAN PENDAPATAN</title>

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
            <span style="font-size:20px; font-family: 'CustomFontBold';">LAPORAN PERKIRAAN PENDAPATAN UNIT DESA WISATA TARO</span><br>
        </u>
    </div>
    <br>
    
    <span style="font-size:15px;">DARI TANGGAL : {{$dari}}</span><br>
    <span style="font-size:15px;">SAMPAI TANGGAL : {{$sampai}}</span><br>
    <table class="table" style="width: 100%; max-width: 100%; border:1px solid #000000;">
        <thead>
            <tr class="tr">
                <td class="td" style="text-align: center; font-family: 'CustomFontBold'; width: 5%;">No</td>
                <td class="td" style="text-align: center; font-family: 'CustomFontBold'; width: 15%;">Rekanan Usaha</td>
                <td class="td" style="text-align: center; font-family: 'CustomFontBold'; width: 15%;">Jumlah Pengunjung</td>
                <td class="td" style="text-align: center; font-family: 'CustomFontBold'; width: 15%;">Pendapatan Objek Wisata</td>
                <td class="td" style="text-align: center; font-family: 'CustomFontBold'; width: 15%;">Pendapatan Unit Desa Wisata</td>
                <td class="td" style="text-align: center; font-family: 'CustomFontBold'; width: 15%;">Keterangan</td>
            </tr>
        </thead>
        <tbody>
            @php
                $total = 0;
                $no = 1;
            @endphp
            @foreach ($penjualan as $item)
                <tr>
                    <td style="text-align: center; border: 1px solid #000;">{{ $no }}</td>
                    <td style="text-align: left; border: 1px solid #000;">{{ $item->nama }}</td>
                    <td style="text-align: right; border: 1px solid #000;">{{ number_format($item->jumlah_penjualan , 0, ',', '.') }}</td>
                    <td style="text-align: right; border: 1px solid #000;">{{ number_format($item->pendapatan_objek_wisata , 0, ',', '.') }}</td>
                    <td style="text-align: right; border: 1px solid #000;">{{ number_format($item->pendapatan_desa_wisata , 0, ',', '.') }}</td>
                    <td style="text-align: right; border: 1px solid #000;"></td>
                </tr>
            @php
                $total+=$item->pendapatan_desa_wisata;
                $no++;
            @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr class="tr">
                <td class="td" colspan="4" style="text-align: right; font-family: 'CustomFontBold';">Total</td>
                <td class="td" style="text-align: right; font-family: 'CustomFontBold';">{{number_format($total , 0, ',', '.')}}</td>
                <td></td>
            </tr>
        </tfoot>
    </table>
    <br>
    <br>
    <div style="width: 100%;">
        <table style="width:100%;">
            <tr>
                <td width="35%">
                    <div>
                        <span>Disiapkan Oleh:</span><br>
                        <span>Manajer Unit Desa Wisata Taro</span>
                        <br>
                        <br>
                        <br>
                        <br>
                        {{getSettings('manager')}}
                    </div>
                </td>
                <td width="35%">
                    <div>
                        <span>Diperiksa Oleh:</span><br>
                        <span>Sekretaris BUMDes Sarwada Amerta Taro</span>
                        <br>
                        <br>
                        <br>
                        <br>
                        {{getSettings('sekretaris')}}
                    </div>
                </td>
                <td width="35%">
                    <div>
                        <span>Diketahui Oleh:</span><br>
                        <span>Ketua Pokdarwis Desa Wisata Taro</span>
                        <br>
                        <br>
                        <br>
                        <br>
                        {{getSettings('ketua_pokdarwis')}}
                    </div>
                </td>
            </tr>
        </table>
      
       
        {{-- <table style="float:right; padding-right:50px">
           
            <tr>
                <td>Diperiksa Oleh: <br>Sekretaris BUMDes Sarwada Amerta Taro</td>
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
                <td colspan="3">I Made Rediana</td>
            </tr>
        </table> --}}
    </div>
</body>

</html>