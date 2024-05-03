<div class="mt-4">
    <table class="table table-striped rounded overflow-hidden" id="myTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Nama Supplier</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Stok</th>
                <th>Keterangan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produktitipan as $index => $j)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $j->nama_produk }}</td>
                <td>{{ $j->nama_supplier }}</td>
                <td>{{ $j->harga_beli }}</td>
                <td>{{ $j->harga_jual }}</td>
                <td>{{ $j->stok }}</td>
                <td>{{ $j->keterangan }}</td>
                <td>
                    <button type="button" class="btn btn-success btn-size" data-bs-toggle="modal" data-bs-target="#modalEdit" data-mode="edit" data-id="{{ $j->id }}" data-nama_produk="{{ $j->nama_produk }}" data-nama_supplier="{{ $j->nama_supplier }}"  data-harga_beli="{{ $j->harga_beli }}"  data-harga_jual="{{ $j->harga_jual }}"  data-stok="{{ $j->stok }}" data-keterangan="{{ $j->keterangan }}"> 
                        <i class="fas fa-edit"></i>
                    </button>
                    <form action="{{ route('produktitipan.destroy', $j->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger delete-data btn-size" data-id="{{ $j->id }}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>