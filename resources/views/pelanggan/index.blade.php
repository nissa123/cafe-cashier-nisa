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

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalFormPelanggan">
                <i class="fas fa-plus"></i> Tambah Pelanggan
            </button>
            <a href="{{ route('export-pelanggan') }}" class="btn btn-success">
            <i class="fa fa-file-excel"></i> Export
            </a>
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#formImport">
            <i class="fa fa-file-excel"></i> Import
            </button>
            <a href="{{ route('aku') }}" class="btn btn-danger">
                        <i class="fas fa-file-pdf"></i> Export PDF
                    </a>
            @include('pelanggan.data')
        </div>
    </div>
</section>
@endsection

@include('pelanggan.form')
@include('pelanggan.edit')

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
            let nama = $(button).data('nama')
            let email = $(button).data('email')
            let nomor_telepon = $(button).data('nomor_telepon')
            let alamat = $(button).data('alamat')

            $(this).find('#nama').val(nama)
            $(this).find('#email').val(email)
            $(this).find('#nomor_telepon').val(nomor_telepon)
            $(this).find('#alamat').val(alamat)

            $('.form-edit').attr('action', `/pelanggan/${id}`)
        })
    })
</script>
@endpush