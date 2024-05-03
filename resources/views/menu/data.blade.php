<div class="mt-4">
    <table class="table table-striped rounded overflow-hidden" id="myTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Menu</th>
                <th>Harga</th>
                <th>Image</th>
                <th>Deskripsi</th>
                <th>Jenis ID</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($menu as $index => $j)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $j->nama_menu }}</td>
                <td>{{ $j->harga }}</td>
                <td><img src="{{ asset('storage/' . $j->image) }}" class="" alt="menu image" style="width: 60px; height: 60px;"></td>
                <td>{{ $j->deskripsi }}</td>
                <td>{{ $j->jenis_id }}</td>
                <td>
                <button type="button" class="btn btn-success btn-size" data-bs-toggle="modal" data-bs-target="#modalEdit" data-mode="edit" data-id="{{ $j->id }}" data-nama_menu="{{ $j->nama_menu }}" data-harga="{{ $j->harga }}" data-image="{{ $j->image }}" data-deskripsi="{{ $j->deskripsi }}" data-jenis_id="{{ $j->jenis_id }}">
                        <i class="fas fa-edit"></i>
                    </button>
                    <form action="{{ route('menu.destroy', $j->id) }}" method="post" class="d-inline">
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