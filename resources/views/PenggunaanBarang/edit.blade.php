<!-- Button trigger modal -->
<button type="button" class="badge bg-success border-0" data-toggle="modal" data-target="#editbarangModal{{ $pg->id }}">
    <i class="ni ni-ruler-pencil"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="editbarangModal{{ $pg->id }}" tabindex="-1" aria-labelledby="editbarangModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editbarangModal">Update Barang</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/{{ request()->segment(1)}}/PenggunaanBarang/{{ $pg->id }}" method="POST" class="mb-5">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label for="nama_barang" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control @error('nama_barang') is-invalid @enderror"
                            id="nama_barang" name="nama_barang" required autofocus value="{{ old('nama_barang', $pg->nama_barang) }}">
                        @error('nama_barang')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="qty" class="form-label">Qty </label>
                        <input type="number" class="form-control @error('qty') is-invalid @enderror" id="qty" min="0"
                            name="qty" required autofocus value="{{ old('qty', $pg->qty) }}">
                        @error('qty')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" min="0"
                            name="harga" required autofocus value="{{ old('harga', $pg->qty) }}">
                        @error('harga')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="waktu_beli" class="form-label">Waktu Beli</label>
                        <input type="datetime-local" class="form-control @error('waktu_beli') is-invalid @enderror" id="waktu_beli"
                            name="waktu_beli" required autofocus>
                        @error('waktu_beli')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="supplier" class="form-label">Supplier</label>
                        <input type="text" class="form-control @error('supplier') is-invalid @enderror"
                            id="supplier" name="supplier" required autofocus value="{{ old('supplier', $pg->supplier) }}">
                        @error('supplier')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select form-select mb-3" aria-label=".form-select example" id="status" name="status" required autofocus value="{{ old('status') }}">
                          <option selected>{{ old('status', $pg->status) }}</option>
                          <option name="status" value="diajukan_beli">Diajukan Beli</option>
                          <option name="status" value="habis">Habis</option>
                          <option name="status" value="tersedia">Tersedia</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
