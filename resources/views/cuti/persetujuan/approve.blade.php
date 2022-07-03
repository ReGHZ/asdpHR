<!--Approve Cuti Modal -->
<div class="modal fade text-left" id="approveCuti" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title white" id="myModalLabel120">Setujui Pengajuan Cuti
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pengajuan-cuti.approve') }}" method="post">
                    @csrf
                    <p class="text-center">Apakah pengajuan cuti disetujui?</p>
                    <input type="hidden" name="pengajuan_id" id="pengajuan_id">
                    <div class="form-group">
                        <label class="form-control-label">Tembusan</label>
                        <select name="tembusan[]" class="form-control selectpicker" multiple>
                            @foreach ($user as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('alasan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Alasan</label>
                        <textarea name="alasan" type="text" class="form-control @error('alasan') is-invalid @enderror"
                            placeholder="Alasan Menyetujui cuti" />{{ old('alasan') }}</textarea>
                        @error('alasan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <button type="button" class="btn btn-light-secondary rounded-pill" data-bs-dismiss="modal"
                                style="min-width:200px; padding:10px 20px">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Close</span>
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-success ml-1 rounded-pill" data-bs-dismiss="modal"
                                style="min-width:200px; padding:10px 20px">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Setujui</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
