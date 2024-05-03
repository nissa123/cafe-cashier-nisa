<div class="mt-4">
    <table class="table table-striped rounded overflow-hidden" id="myTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Menu ID</th>
                <th>Jumlah</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stok as $index => $j)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $j->menu->nama_menu }}</td>
                <td>{{ $j->jumlah }}</td>
                <td>
                    <button type="button" class="btn btn-success btn-size" data-bs-toggle="modal" data-bs-target="#modalEdit" data-mode="edit" data-id="{{ $j->id }}" data-menu_id="{{ $j->menu_id }}" data-jumlah="{{ $j->jumlah}}">
                        <i class="fas fa-edit"></i>
                    </button>
                    <form action="{{ route('stok.destroy', $j->id) }}" method="post" class="d-inline">
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