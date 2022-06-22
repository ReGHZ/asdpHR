<!--penugasan perjalanan dinas Modal -->
<div class="modal fade text-left" id="createperdinas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title white" id="myModalLabel160">Penugasan Perjalanan Dinas
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-3">
                            <div class="form-group">
                                <h1 class="h4 text-gray-900 mb-4">Apakah anda ingin menugaskan pegawai ini ?</h1>
                            </div>
                            <div class="form-group">
                                <a onclick="pengikut()">Apakah ada pengikut?<span class="text-primary">click</span></a>
                                <form action="{{ route('perjalanan-dinas.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="user_id" id="penugasan_id">
                            </div>
                            <div class="form-group" style="display: none" id="show">
                                <label class="form-control-label">Nama Pengikut</label>
                                <select class="form-control" name="pengikut">
                                    <option selected disabled>Pilih Pengikut</option>
                                    @foreach ($pegawai as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('pengikut')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Tidak</span>
                </button>
                <button type="submit" class="btn btn-success ml-1" data-bs-dismiss="modal">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Iya</span>
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
