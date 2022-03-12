@extends('layouts.main')

@section('content')

<div class="row">
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="col-xl-3 col-lg-6">
        <div class="card card-stats mb-4 ">
            <div class="card-body">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                      <a class="nav-link active" id="nav-data" data-toggle="collapse" href="#dataLaundry" role="button" aria-expanded="false" aria-controls="collapseExample">Data Laundry</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="nav-form" data-toggle="collapse" href="#formTransaksi" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="ni ni-fat-add text-primary"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

@if (session()->has('success'))
    <div class="alert alert-success col-lg-12 text-center" id="succes-alert" role="alert">
        {{ session('success') }}
    </div>
@endif

<div class="row">
    <div class="col">
      <div class="card shadow">
        <div class="card-header border-0">
        <form method="POST" action="{{ url(request()->segment(1).'/transaksi') }}">
            @csrf
            @include('transaksi.form')
            <input type="hidden" name="id_member" id="id_member">
        </form>
            @include('transaksi.data')
        </div>
      </div>
    </div>
</div>

@push('script')
<script>
//script untuk #menu data dan form transaksi
    $('#dataLaundry').collapse('show')

    $('#dataLaundry').on('show.bs.collapse', function(){
        $('#formTransaksi').collapse('hide');
        $('#nav-form').removeClass('active');
        $('#nav-data').addClass('active');
    })
    $('#formTransaksi').on('show.bs.collapse', function(){
        $('#dataLaundry').collapse('hide');
        $('#nav-data').removeClass('active');
        $('#nav-form').addClass('active');
    })
//end #menu

//initilize
let subtotal = total = 0;
//end of initialize

//actions
    //pemilihan member
        $('#tb-member').on('click','.pilihMemberBtn', function(){
            pilihMember(this)
            $('#tbMemberModal').modal('hide')
        })

    //pemilihan paket
        $('#tb-paket').on('click','.pilihPaketBtn', function(){
            pilihPaket(this)
            $('#tbPaketModal').modal('hide')
        })
//

//function pilih member
    function pilihMember(x){
        const tr = $(x).closest('tr')
        const namaJK = tr.find('td:eq(1)').text()+"/"+tr.find('td:eq(3)').text()
        const biodata = tr.find('td:eq(2)').text()+"/"+tr.find('td:eq(4)').text()
        const idMember = tr.find('.idMember').val()
        $('#nama-pelanggan').text(namaJK)
        $('#biodata-pelanggan').text(biodata)
        $('#id_member').val(idMember)
    }
//

//function pilih paket
function pilihPaket(x){
    const tr = $(x).closest('tr')
    const namaPaket = tr.find('td:eq(1)').text()
    const harga = tr.find('td:eq(2)').text()
    const idPaket = tr.find('.idPaket').val()

    let data = ''
    let tbody = $('#tblTransaksi tbody tr td').text()
    data += '<tr>'
    data += `<td> ${namaPaket} </td>`
    data += `<td> ${harga} </td>`;
    data += `<input type="hidden" name="id_paket[]" value="${idPaket}">`
    data += `<td><input type="number" value="1" min="1" class="qty" name="qty[]" size="2" style="width:40px"></td>`;
    data += `<td><label name="sub_total[]" class="subTotal">${harga}</label></td>`;
    data += `<td><button type="button" class="btnRemovePaket badge badge-danger border-0">Hapus</button></td>`;
    data += '<tr>';
    if(tbody == 'Belum ada data') $('#tblTransaksi tbody tr').remove();
    $('#tblTransaksi tbody').append(data);
    subtotal += Number(harga)
    total = subtotal - Number($('#diskon').val()) + Number($('#pajak-persen').val())
    $('#subtotal').text(subtotal)
    $('#total').text(total)

  }
//

//function hitung total
function hitungTotalAkhir(a){
  let qty = Number($(a).closest('tr').find('.qty').val());
  let harga = Number($(a).closest('tr').find('td:eq(1)').text());
  let subTotalAwal = Number($(a).closest('tr').find('.subTotal').text());
  let count = qty * harga;
  subtotal = subtotal - subTotalAwal + count
  let pajak = Number($('#pajak-persen').val())/100*subtotal
  total = subtotal - Number($('#diskon').val()) + Number($('#biaya_tambahan').val()) + pajak;
  $(a).closest('tr').find('.subTotal').text(count)
//   $('#pajak-harga').text(pajak)
  $('#subtotal').text(subtotal)
  $('#total').text(total)
}
//

//onchange qty
$('#tblTransaksi').on('change','.qty', function(){
    hitungTotalAkhir(this);
})
//

//remove paket
$('#formTransaksi').on('click','.btnRemovePaket', function(){
        let subTotalAwal = parseFloat($(this).closest('tr').find('.subTotal').text());
        subtotal -= subTotalAwal;
        total -= subTotalAwal;

        $currentRow = $(this).closest('tr').remove();
        $('#subtotal').text(subtotal);
        $('#total').text(total)
    });
//
</script>
<script>
    $(function(){
        $('#tb-member').DataTable();
    });

    $(function(){
        $('#tb-paket').DataTable();
    });
</script>
@endpush

@endsection
