@extends('template')
@section('title')
    Penjualan
@endsection
@section('css')
    
@endsection
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <div class="page-title">
                        <h4 class="mb-0 font-size-18">Penjualan</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item "><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item">Penjualan</li>
                            <li class="breadcrumb-item active">Posting</li>
                        </ol>
                    </div>
                    <div class="state-informatio d-sm-block">
                    
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <!-- Start Page-content-Wrapper -->
        <div class="page-content-wrapper">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Posting Penjualan</h4>
                            <form method="post" action="{{route('penjualan.store')}}">
                                @csrf
                                <div class="row mt-4">

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">Tanggal</label>
                                            <input type="date" class="form-control mb-3"  name="tanggal" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="validationTooltipUsername">Pajak</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" min="0.1"  step="any" id="pajak" name="pajak">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"
                                                        id="validationTooltipUsernamePrepend">%</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Keterangan</label>
                                            <textarea name="keterangan" class="form-control mb-3" id="" cols="30" rows="5"></textarea>
                                        </div>
                                      
                                    </div>
                                    <div class="col-md-9">
                                        <div class="table-responsive">
                                            <table class="table" style="width: 100%">
                                              <thead>
                                                <th width="25%">Produk</th>
                                                <th width="25%">Harga</th>
                                                <th width="25%">Kuantitas</th>
                                                <th width="25%">Sub Total</th>
                                                <th width="10%"></th>
                                              </thead>
                                              <tbody id="tbody">
                                                
                                                  <tr class="tr">
                                                    <td>
                                                        <select name="product_id[]" id="" class="form-control produk select2">
                                                            <option value=""></option>
                                                            @foreach ($produk as $item)
                                                            <option value="{{$item->id}}" data-harga="{{$item->harga}}">{{$item->nama}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control harga"  name="harga[]" readonly required>
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control qty" name="qty[]" required>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control sub_total" readonly  name="sub_total[]" required>
                                                    </td>
                                                    <td>
                                                        
                                                    </td>
                                                  </tr>
                                              </tbody>
                                              <tfoot>
                                                <tr>
                                                  <td colspan="2">
                                                    <div class="btn btn-success tambah-item"><i class="fa fa-plus"></i></div>
                                                  </td>
                                                  <td align="right">
                                                      <b>Total</b>
                                                  </td>
                                                  <td align="right">
                                                    <b id="total">0</b>
                                                  </td>
                                                </tr>
                                                <tr id="row-pajak" hidden>
                                                    <td colspan="2">
                                                    </td>
                                                    <td align="right">
                                                        <b>Pajak <span class="pajak"></span></b>
                                                    </td>
                                                    <td align="right">
                                                      <b id="grand-total">0</b>
                                                    </td>
                                                </tr>
                                              </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </form>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

        </div>
        <!-- End Page-content -->
    </div>
   
@endsection

@section('js')
    <script>
        
        $(function(){
            function numberWithCommas(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
            
            $(document).on('change', '.produk', function(){
                var row = $(this).closest('.tr')
                var harga_input = $(row).find('.harga')
                var harga = $('option:selected', this).attr('data-harga');
                $(harga_input).val(numberWithCommas(harga))

                var qty_input = $(row).find('.qty')
                if($(qty_input).val() != ''){
                    var sub_total_input = $(row).find('.sub_total')
                    var sub_total = parseInt(harga) * parseInt($(qty_input).val())
                    $(sub_total_input).val(numberWithCommas(sub_total)).trigger('change')
                }
                getPajak()
            })

            function getSubTotal(row){
                var qty_input = $(row).find('.qty')
                var harga_input = $(row).find('.harga')
                if($(qty_input).val() != '' && $(harga_input).val() != ''){
                    var sub_total_input = $(row).find('.sub_total')
                    var harga = $(harga_input).val();
                    harga = harga.split('.').join("");
                    var sub_total = parseInt(harga) * parseInt($(qty_input).val())
                    $(sub_total_input).val(numberWithCommas(sub_total)).trigger('change')
                }else{
                    var sub_total_input = $(row).find('.sub_total')
                    $(sub_total_input).val('').trigger('change')
                }
            }

            $(document).on('keyup', '.qty', function(){
                var row = $(this).closest('.tr')
                getSubTotal(row)
                getPajak()
            })

            $(document).on('change', '.sub_total', function(){
                var total = 0
                $.each($('.sub_total'), function(k,val){
                    if($(val).val() != ''){
                        total += parseInt($(val).val().split('.').join(""))
                    }
                })
                $('#total').text(numberWithCommas(total))
            })

            $('.tambah-item').click(function(){
            $('#tbody').append(`
                  <tr class="tr baris">
                    <td>
                        <select name="product_id[]" id="" class="form-control produk select2">
                            <option value=""></option>
                            @foreach ($produk as $item)
                            <option value="{{$item->id}}" data-harga="{{$item->harga}}">{{$item->nama}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="text" class="form-control harga"  name="harga[]" readonly required>
                    </td>
                    <td>
                        <input type="number" class="form-control qty" min="1" name="qty[]" required>
                    </td>
                    <td>
                        <input type="text" class="form-control sub_total" readonly  name="sub_total[]" required>
                    </td>
                    <td>
                        <div class="btn btn-danger hapus"><i class="fa fa-trash delete"></i></div>
                    </td>
                </tr>
            `)
            $('.select2').select2({
              placeholder: "Pilih"
            })
          })

          $(document).on('click', '.hapus', function() {
            $(this).closest('.tr').remove();
          })

          function getPajak(){
            if($('#total').text() != "0" && $('#pajak').val() != ""){
                $('#row-pajak').prop('hidden', false)
                $('.pajak').text($("#pajak").val()+"%")
                var total = $('#total').text()
                total = total.split('.').join("");
                var pajak = parseInt(total) * parseFloat($('#pajak').val()) / 100
                pajak = pajak + parseInt(total)
                pajak = numberWithCommas(pajak)
                $('#grand-total').text(pajak)
              }else{
                $('#row-pajak').prop('hidden', true)
              }
          }
          $('#pajak').keyup(function(){
            getPajak()
          })

            
        })
    </script>
@endsection