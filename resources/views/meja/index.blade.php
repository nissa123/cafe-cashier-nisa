@extends('templates.layout')

@section('content')
<section class="section dashboard">
    <div class="row">
        <div class="card-body">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalFormMeja">
                <i class="fas fa-plus"></i> Tambah Meja
            </button>
            <a href="{{ route('export-meja') }}" class="btn btn-success">
            <i class="fa fa-file-excel"></i> Export
            </a>
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#formImport">
            <i class="fa fa-file-excel"></i> Import
            </button>
            <a href="{{ route('meja-pdf') }}" class="btn btn-danger">
                        <i class="fas fa-file-pdf"></i> Export PDF
                    </a>
            @include('meja.data')
        </div>
    </div>
    <div class="modal fade" id="formImport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Data Meja</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('import-meja') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                             <label for="jenis" class="form-label">File Excel</label>
                             <input type="file" class="form-control" name="file">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btn-submit">Upload</button>
                </div>
            </div>
        </div>
    </form>
</div>
</section>
@endsection

@include('meja.form')
@include('meja.edit')

@push('script')
<script>
    $('.alert-success').fadeTo(2000, 500).slideUp(500, function() {
        $('.alert-success').slideUp(500)
    })

    $('.alert-danger').fadeTo(2000, 500).slideUp(500, function() {
        $('.alert-danger').slideUp(500)
    })

    $(function() {
        // dialog hapus data
        $('.delete-data').on('click', function(e) {
            const nama = $(this).closest('tr').find('td:eq(1)').text();
            // console.log('nama')
            Swal.fire({
                icon: 'error',
                title: 'Hapus Data',
                html: `Apakah data <b>${nama}</b> akan di hapus?`,
                confirmButtonText: 'Ya',
                denyButtonText: 'Tidak',
                'showDenyButton': true,
                focusConfirm: false
            }).then((result) => {
                if (result.isConfirmed)
                    $(e.target).closest('form').submit()
                else swal.close()
            })
        })

        $('#modalEdit').on('show.bs.modal', function(e) {
            let button = $(e.relatedTarget)
            let id = $(button).data('id')
            let nomor_meja = $(button).data('nomor_meja')
            let kapasitas = $(button).data('kapasitas')
            let status = $(button).data('status')

            $(this).find('#nomor_meja').val(nomor_meja)
            $(this).find('#kapasitas').val(kapasitas)
            $(this).find('#status').val(status)

            $('.form-edit').attr('action', `/meja/${id}`)
        })
    })
</script>
@endpush