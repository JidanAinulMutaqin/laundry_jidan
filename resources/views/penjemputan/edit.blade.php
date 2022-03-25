<!-- Button trigger modal -->
<button type="button" class="badge bg-success border-0" data-toggle="modal"
    data-target="#editpenjemputanModal{{ $pe->id }}">
    <i class="ni ni-ruler-pencil"></i>
</button>

<!-- Modal Edit -->
<div class="modal fade" id="editpenjemputanModal{{ $pe->id }}" tabindex="-1"
    aria-labelledby="editpenjemputanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-dark">
                <h5 class="modal-title" id="exampleModalLabel">Edit Penjemputan</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/{{ request()->segment(1) }}/penjemputan/{{ $pe->id }}" method="POST"
                    class="mb-5">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label for="id_member" class="form-label">Nama Pelanggan</label>
                        <select class="form-select form-select mb-3" aria-label=".form-select example" id="pelanggan"
                            name="id_member">
                            <option selected>Pilih Pelanggan</option>
                            @foreach ($member as $m)
                                <option value="{{ $m->id }}">{{ $m->nama }}</option>
                            @endforeach
                        </select>
                        @error('pelanggan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="petugas" class="form-label">Petugas Penjemputan</label>
                        <input type="text" class="form-control @error('petugas') is-invalid @enderror" id="petugas"
                            name="petugas" required autofocus value="{{ old('petugas', $pe->petugas) }}">
                        @error('petugas')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select form-select mb-3" aria-label=".form-select example" id="status"
                            name="status">
                            <option selected>{{ old('status', $pe->status) }}</option>
                            <option name="status" value="Tercatat">Tercatat</option>
                            <option name="status" value="Penjemputan">Penjemputan</option>
                            <option name="status" value="Selesai">Selesai</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-dark btn-outline-primary border-0">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End Modal Edit -->
