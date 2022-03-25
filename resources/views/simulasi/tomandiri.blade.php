@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-4 col-xl-3 col-lg-6 ">
            <div class="card card-stats mb-4 ">
                <div class="card-body">
                    <div class="row">
                        <div class="col col-md-12 mb-md-0 mb-4 d-flex justify-content-center">
                            <b style="text-align: center">Simulasi Transaksi Barang</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Form --}}
    <form id="formSimulasi">
        <div class="row">
            <div class="col mb-3">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <h3>Form</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="id_karyawan" class="col-sm-2 col-form-label">ID Karyawan</label>
                            <div class="col-sm-1">
                                <input type="number" class="form-control" name="id_karyawan" id="id_karyawan" min="0"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama_barang" class="col-sm-2 col-form-label nama">Nama Barang</label>
                            <div class="col-sm-3">
                                <select class="form-control" name="nama_barang" id="nama_barang">
                                    <option selected>Pilih Barang</option>
                                    <option name="nama_barang" value="Detergen">Detergen</option>
                                    <option name="nama_barang"  value="Pewangi">Pewangi</option>
                                    <option name="nama_barang"  value="Detergent Sepatu">Detergent Sepatu</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jml_barang" class="col-sm-2 col-form-label">Jumlah Barang</label>
                            <div class="col-sm-1">
                                <input type="number" class="form-control" name="jml_barang" id="jml_barang" min="0" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tgl" class="col-sm-2 col-form-label">Tanggal Beli</label>
                            <div class="col-sm-3">
                                <input type="date" class="form-control" name="tgl" id="tgl"
                                    value="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                            <div class="col-sm-3">
                                <input type="number" class="form-control" name="harga" id="harga" placeholder="0"
                                    required readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jp" class="col-sm-2 col-form-label">Jenis Pembayaran</label>
                            <div class="form-check col-sm-2">
                                <input type="radio" class="form-check-input" name="jp" id="jp" value="Cash">
                                <label class="form-check-label">Cash</label>
                            </div>
                            <div class="form-check col-sm-2">
                                <input type="radio" class="form-check-input" name="jp" id="jp" value="e-money">
                                <label class="form-check-label">e-money/transfer</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="submit" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <button class="btn btn-primary" id="btnSimpan" type="submit">Input</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    {{-- end form --}}

    {{-- Data --}}
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <h3>Data</h3>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="row">
                            <div class="col-md-2 col-sm-4">
                                <button class="btn btn-success" type="button" id="sorting">Sorting</button>
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" id="cCash" value="Cash" checked>
                                <label class="form-check-label">Cash</label>
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" id="cEmoney" value="e-money" checked>
                                <label class="form-check-label">e-money</label>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <input type="search" class="form-control" name="search" id="search">
                            </div>
                            <div class="col-md-2 col-sm-4">
                                <button class="btn btn-dark" type="button" id="btnSearch">Cari</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-compact table-stripped table-borderless" id="tblSimulasi">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tanggal Beli</th>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Diskon</th>
                                <th>Total Harga</th>
                                <th>Jenis Bayar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="8" align="center">Belum ada data</td>
                            </tr>
                        </tbody>
                        {{-- <tfoot>
                            <tr style="background:RoyalBlue;color:whitesmoke;font-weight:bold;font-size:1em">
                                <td colspan="4" style="text-align: center">TOTAL</td>
                                <td id="total1"></td>
                                <td id="total2"></td>
                                <td id="total3"></td>
                                <td id="total4"></td>
                            </tr>
                        </tfoot> --}}
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- end data --}}
@endsection

@push('script')
    <script>
        //method
        function insert() {
            const data = $('#formSimulasi').serializeArray()
            let dataSimulasi = JSON.parse(localStorage.getItem('dataSimulasi')) || []
            let newData = {}
            data.forEach(function(item, index) {
                let name = item['name']
                let value = (name === 'id_karyawan' ||
                    name === 'jml_barang' ?
                    Number(item['value']) : item['value'])
                newData[name] = value
            })
            //console.log(newData)

            localStorage.setItem('dataSimulasi', JSON.stringify([...dataSimulasi, newData]))
            return newData
        }

        const hD = 15000
        const hP = 10000
        const hDS = 25000

        $('#nama_barang').on('change', function() {
            let value = $('#nama_barang').val()
            console.log(value)
             if (value === 'Detergen') {
                $('#harga').val(hD)
                $('#harga').attr('readonly', true)
            } else if (value === 'Pewangi'){
                $('#harga').val(hP)
                $('#harga').attr('readonly', true)
            } else if (value === 'Detergent Sepatu'){
                $('#harga').val(hDS)
                $('#harga').attr('readonly', true)
            }

        })

        function showData(dataSimulasi) {

            let row = ''
            const dc = 0.15
            var diskon = 0
            var jumlah = 0

            //var untuk total
            var total1 = 0
            var total2 = 0
            var total3 = 0
            var total4 = 0
            //let arr = JSON.parse(localStorage.getItem('dataSimulasi')) || []
            if (dataSimulasi.length == 0) {
                return row = `<tr><td colspan="8" align="center">Belum ada data</td></tr>`
            }
            dataSimulasi.forEach(function(item, index) {

                jumlah = (item['harga'] * item['jml_barang'])
                if (jumlah > 50000) {
                    diskon = jumlah * dc
                    jumlah = jumlah - diskon
                }

                total1 += Number(item['harga'])
                total2 += Number(item['jml_barang'])
                total3 += diskon
                total4 += jumlah

                row += `<tr>`
                row += `<td>${item['id_karyawan']}</td>`
                row += `<td>${item['tgl']}</td>`
                row += `<td>${item['nama_barang']}</td>`
                row += `<td>${item['harga']}</td>`
                row += `<td>${item['jml_barang']}</td>`
                row += `<td>${diskon}</td>`
                row += `<td>${jumlah}</td>`
                row += `<td>${item['jp']}</td>`
                row += `</tr>`
            })
                row += `<tr style="background:RoyalBlue;color:whitesmoke;font-weight:bold;font-size:1em">`
                row += `<td colspan="3" align="center" >Total</td>`
                row += `<td>${total1}</td>`
                row += `<td>${total2}</td>`
                row += `<td>${total3}</td>`
                row += `<td colspan="2">${total4}</td>`
                row += `</tr>`

            return row
        }

        function insertionSort(arr, key, type) {
            let i, j, id, value;
            type = type === 'asc' ? '>' : '<'

            if (arr[0].constructor !== Object || !key) return false
            for (i = 1; i < arr.length; i++) {
                value = arr[i];
                id = arr[i][key]
                j = i - 1;

                while (j >= 0 && eval(arr[j][key] + type + id)) {
                    arr[j + 1] = arr[j];
                    j--;
                }
                arr[j + 1] = value;
            }
            return arr
        }

        function searching(arr, key, teks) {
            for (let i = 0; i < arr.length; i++) {
                if (arr[i][key] == teks)
                    return i
            }
            return 'gagal'
        }

        //after load
        $(function(){
             //initialize
             let dataSimulasi = JSON.parse(localStorage.getItem('dataSimulasi')) || []
            // console.log(dataSimulasi)
            $('#tblSimulasi tbody').html(showData(dataSimulasi))
            // total()


            //events
            $('#formSimulasi').on('submit', function(e) {
                // console.log(e)
                e.preventDefault();
                insert()
                dataSimulasi = JSON.parse(localStorage.getItem('dataSimulasi')) || []
                $('#tblSimulasi tbody').html(showData(dataSimulasi))
                // total()
            })

             //sorting
             $('#sorting').on('click', function() {
                data = insertionSort(dataSimulasi, 'id_karyawan', 'asc')
                //console.log(data)
                data && $('#tblSimulasi tbody').html(showData(dataSimulasi))
            })

            //searching
            $('#btnSearch').on('click', function(e) {
                let teksSearch = $('#search').val()
                let id = searching(dataSimulasi, 'id_karyawan', teksSearch)
                let data = []
                if (id >= 0)
                    data.push(dataSimulasi[id])
                console.log(id)
                console.log(data)
                $('#tblSimulasi tbody').html(showData(data))
            })

            $('#cCash').on('click', function(){
                let filter = $('cCash').val()
                let id = searching(dataSimulasi, 'jenis', filter)
                let data = []
                if (id >= 0)
                    data.push(dataSimulasi[id])

                $('#tblSimulasi tbody').html(showData(data))
                //console.log(dataSimulasi)
            })

            $('#cEmoney').on('click', function(){
                let filter = $('cEmoney').val()
                let id = searching(dataSimulasi, 'jenis', filter)
                let data = []
                if (id >= 0)
                    data.push(dataSimulasi[id])

                $('#tblSimulasi tbody').html(showData(data))
                //console.log(dataSimulasi)
            })

        })
    </script>
@endpush
