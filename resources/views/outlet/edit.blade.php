<!-- Button trigger modal -->
<button type="button" class="badge bg-warning border-0" data-toggle="modal" data-target="#editoutletModal{{ $o->id }}">
    <i class="ni ni-bold-up"></i>
</button>

<!-- Modal Edit -->
<div class="modal fade" id="editoutletModal{{ $o->id }}" tabindex="-1" aria-labelledby="editoutletModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-dark">
             <h5 class="modal-title" id="exampleModalLabel">Edit outlet</h5>
             <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="{{ url('outlet/' .$o->id) }}" method="POST" class="text-dark">
                @method('PUT')
             @csrf
                <div class="mb-3">
                    <label for="nama_outlet" class="form-label">Nama</label>
                    <input type="text" class="form-control @error('nama_outlet') is-invalid @enderror" id="nama_outlet" name="nama_outlet" required autofocus value="{{ old('nama_outlet', $o->nama_outlet) }}">
                    @error('nama_outlet')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" required autofocus value="{{ old('alamat', $o->alamat) }}">
                    @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="telepon" class="form-label">Telepon</label>
                    <input type="text" class="form-control @error('telepon') is-invalid @enderror" id="telepon" name="telepon" required autofocus value="{{ old('telepon', $o->telepon) }}">
                    @error('telepon')
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
