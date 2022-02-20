<!-- Button trigger modal -->
<button type="button" class="badge bg-warning border-0" data-toggle="modal"
    data-target="#editpaketModal{{ $p->id }}">
    <i class="ni ni-bold-up"></i>
</button>

<!-- Modal Edit -->
<div class="modal fade" id="editpaketModal{{ $p->id }}" tabindex="-1" aria-labelledby="editpaketModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-dark">
                <h5 class="modal-title" id="exampleModalLabel">Edit paket</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/{{ request()->segment(1) }}/paket/{{ $p->id }}" method="POST"
                    class="text-dark">
                    @method('PUT')
                    @csrf
                    <div class="form-group mb-3">
                        <label for="id_outlet" class="form-label">ID Outlet</label>
                        <input type="text" id="id_outlet" name="id_outlet" value="{{ $p->id_outlet }}"
                            class="form-control" placeholder="Nama Paket" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="jenis" class="form-label">Jenis</label>
                        <select class="form-select form-select mb-3" aria-label=".form-select example" id="jenis"
                            name="jenis" required autofocus value="{{ old('jenis', $p->jenis) }}">
                            <option selected>Pilih Jenis Paket</option>
                            <option name="jenis" value="kiloan">Kiloan</option>
                            <option name="jenis" value="selimut">Selimut</option>
                            <option name="jenis" value="bed_cover">Bed Cover</option>
                            <option name="jenis" value="kaos">Kaos</option>
                            <option name="jenis" value="lainnya">lainnya</option>
                        </select>
                        @error('jenis')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nama_paket" class="form-label">Nama Paket</label>
                        <input type="text" class="form-control @error('nama_paket') is-invalid @enderror"
                            id="nama_paket" name="nama_paket" required autofocus
                            value="{{ old('nama_paket', $p->nama_paket) }}">
                        @error('nama_paket')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="text" class="form-control @error('harga') is-invalid @enderror" id="harga"
                            name="harga" required autofocus value="{{ old('harga', $p->harga) }}">
                        @error('harga')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-dark btn-outline-primary border-0">Add</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!--End Modal Edit -->
