<div class="mt-4">
    <table class="table table-striped rounded overflow-hidden" id="myTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Nomor Telepon</th>
                <th>Alamat</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pelanggan as $index => $j)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $j->nama }}</td>
                <td>{{ $j->email }}</td>
                <td>{{ $j->nomor_telepon }}</td>
                <td>{{ $j->alamat }}</td>
                <td>
                    <button type="button" class="btn btn-success btn-size" data-bs-toggle="modal" data-bs-target="#modalEdit" data-mode="edit" data-id="{{ $j->id }}" data-nama="{{ $j->nama }}" data-email="{{ $j->email }}" data-nomor_telepon="{{ $j->nomor_telepon }}" data-alamat="{{ $j->alamat }}">
                        <i class="fas fa-edit"></i>
                    </button>
                    <form action="{{ route('pelanggan.destroy', $j->id) }}" method="post" class="d-inline">
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