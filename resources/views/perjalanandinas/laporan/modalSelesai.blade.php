 <!-- perjalanan dinas selesai Modal -->
 <div class="modal fade text-left" id="perdinSelesai" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160"
     aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
         <div class="modal-content">
             <div class="modal-header bg-success">
                 <h5 class="modal-title white" id="myModalLabel120">Tandai Selesai
                 </h5>
                 <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                     <i data-feather="x"></i>
                 </button>
             </div>
             <div class="modal-body">
                 <form action="{{ route('laporan-dinas.tandai-selesai') }}" method="post">
                     @csrf
                     @method('put')
                     <p class="text-center">Apakah Perjalanan Dinas Selesai ?</p>
                     <input type="hidden" name="penugasan_id" id="penugasan_id">
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
                                 <span class="d-none d-sm-block">Selesai</span>
                             </button>
                         </div>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
 {{-- end perjalanan dinas selesai modal --}}
