<div class="modal fade" id="modalFormPemesanan" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalFormPemesanan" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalFormPemesanan">Tambah Pemesanan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
            </div>
            <div class="modal-body">

            <form method="post" action="pemesanan" enctype="multipart/form.data">
                @csrf
                <div class="form-group row">
                <label for="meja_id" class="col-sm-4 col-form-label">Meja Id</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="meja_id" name='meja_id'>
                    </div>
                <label for="tanggal_pemesanan" class="col-sm-4 col-form-label">Tanggal_pemesanan</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="tanggal_pemesanan" name='tanggal_pemesanan'>
                    </div>
                <label for="jam_mulai" class="col-sm-4 col-form-label">Jam Mulai</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="jam_mulai" name='jam_mulai'>
                    </div>
                <label for="jam_selesai" class="col-sm-4 col-form-label">Jam Selesai</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="jam_selesai" name='jam_selesai'>
                    </div>
                <label for="nama_pemesan" class="col-sm-4 col-form-label">Nama Pemesan</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nama_pemesan" name='nama_pemesan'>
                    </div>
                <label for="jumlah_pelanggan" class="col-sm-4 col-form-label">Jumlah_pelanggan</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="jumlah_pelanggan" name='jumlah_pelanggan'>
                    </div>


                </div>

           </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Tambahkan</button>
            </div>
       </div>
   </div>
</div>



<div class="modal fade" id="formImport" tabindex="-1" aria-labelledby="examplemodalLabel" aria-hidden="true">
    <div class="modal=dailog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="examplemodalLabel">Import Data Pengajuan Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
           </div>
           <div class="modal-body">

            <form method="POST" action="{{url ('pengajuan/import')}}" enctype="multipart/form.data">
                @scrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="jenis">File Excel</label>
                        <input type="file" name="import" id="import">
                    </div>
                </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
            <button type="submit" class="btn btn-primary">Upload</button>

          </div>
       </div>
   </div>
</div>
</form>