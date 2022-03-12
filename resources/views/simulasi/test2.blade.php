@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-4 col-xl-3 col-lg-6 ">
            <div class="card card-stats mb-4 ">
                <div class="card-body">
                    <div class="row">
                        <div class="col col-md-12 mb-md-0 mb-4 d-flex justify-content-center">
                            Simulasi Data Buku
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Form --}}
    <form id="formBuku">
        <div class="row">
            <div class="col mb-3">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <h3>Form</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="id_buku" class="col-sm-2 col-form-label">ID Buku</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="id_buku" id="id_buku" placeholder="ID"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="judul_buku" class="col-sm-2 col-form-label">Judul Buku</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="judul_buku" id="judul_buku"
                                    placeholder="judul buku" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pengarang" class="col-sm-2 col-form-label">Pengarang</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="pengarang" id="pengarang"
                                    placeholder="pengarang" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tahun_terbit" class="col-sm-2 col-form-label">Tahun Terbit</label>
                            <div class="col-sm-4">
                                <select type="number" class="form-control" name="tahun_terbit" id="tahun_terbit">
                                    @for ($i = date('Y'); $i > 1900; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" name="harga" id="harga" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="qty" class="col-sm-2 col-form-label">Qty</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" name="qty" id="qty" min="0" value="0" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="submit" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <button class="btn btn-primary" id="btnSimpan" type="submit">Simpan</button>
                                <button class="btn btn-default" id="btnReset" type="reset">Reset</button>
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
                            <div class="col-md-4 col-sm-4">
                                <button class="btn btn-success" type="button" id="sorting">Sorting</button>
                            </div>
                            <div class="col-md-6 col-sm-4">
                                <input type="search" class="form-control" name="search" id="search">
                            </div>
                            <div class="col-md-2 col-sm-4">
                                <button class="btn btn-dark" type="button" id="btnSearch">Cari</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-compact table-stripped table-borderless" id="tblBuku">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Judul Buku</th>
                                <th>Pengarang</th>
                                <th>Tahun Terbit</th>
                                <th>Harga</th>
                                <th>Qty</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6" align="center">Belum ada data</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- end data --}}
@endsection

@push('script')
    <script>
        //methhods
        function insert() {
            const data = $('#formBuku').serializeArray()
            let dataBuku = JSON.parse(localStorage.getItem('dataBuku')) || []
            let newData = {}
            data.forEach(function(item, index) {
                let name = item['name']
                let value = (name === 'id_buku' ||
                    name === 'qty' ||
                    name === 'harga' ?
                    Number(item['value']) : item['value'])
                newData[name] = value
            })
            //console.log(newData)

            localStorage.setItem('dataBuku', JSON.stringify([...dataBuku, newData]))
            return newData
        }

        function showData(dataBuku) {
            let row = ''
            //let arr = JSON.parse(localStorage.getItem('dataBuku')) || []
            if (dataBuku.length == 0) {
                return row = `<tr><td colspan="6" align="center">Belum ada data</td></tr>`
            }
            dataBuku.forEach(function(item, index) {
                row += `<tr>`
                row += `<td>${item['id_buku']}</td>`
                row += `<td>${item['judul_buku']}</td>`
                row += `<td>${item['pengarang']}</td>`
                row += `<td>${item['tahun_terbit']}</td>`
                row += `<td>${item['harga']}</td>`
                row += `<td>${item['qty']}</td>`
                row += `</tr>`
            })
            return row
        }

        function insertionSort(arr, key, type)
        {
            let i, j, id, value;
            type = type === 'asc'?'>':'<'

            if(arr[0].constructor !== Object || !key) return false
            for (i = 1; i < arr.length; i++)
            {
                value = arr[i];
                id = arr[i][key]
                j = i - 1;

                while (j >= 0  && eval(arr[j][key] + type + id))
                {
                    arr[j + 1] = arr[j];
                    j--;
                }
                arr[j + 1] = value;
            }
            return arr
        }

        function searching(arr, key, teks){
            for(let i = 0; i < arr.length; i++){
                if(arr[i][key] == teks)
                    return i
                }
            return 'gagal'
        }

        //after load
        $(function() {
            //initialize
            let dataBuku = JSON.parse(localStorage.getItem('dataBuku')) || []
            // console.log(dataBuku)
            $('#tblBuku tbody').html(showData(dataBuku))


            //events
            $('#formBuku').on('submit', function(e) {
                // console.log(e)
                e.preventDefault();
                insert()
                dataBuku = JSON.parse(localStorage.getItem('dataBuku')) || []
                $('#tblBuku tbody').html(showData(dataBuku))
            })

            //sorting
            $('#sorting').on('click', function(){
                data = insertionSort(dataBuku, 'id_buku', 'asc')
                //console.log(data)
                data && $('#tblBuku tbody').html(showData(dataBuku))
            })

            //searching
            $('#btnSearch').on('click', function(e){
                let teksSearch = $('#search').val()
                let id = searching(dataBuku, 'id_buku', teksSearch)
                let data = []
                if(id >= 0)
                    data.push(dataBuku[id])
                console.log(id)
                console.log(data)
                $('#tblBuku tbody').html(showData(data))
            })
        })

    </script>
@endpush
