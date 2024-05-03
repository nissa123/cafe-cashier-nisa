<div class="mt-4">
    <table class="table table-striped rounded overflow-hidden" id="myTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Nip</th>
                <th>Nik</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Telepon</th>
                <th>Agama</th>
                <th>Status Nikah</th>
                <th>Alamat</th>
                <th>Foto</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($karyawan as $index => $s)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $s->nip }}</td>
                <td>{{ $s->nik }}</td>
                <td>{{ $s->nama}}</td>
                <td>{{ $s->jenis_kelamin}}</td>
                <td>{{ $s->tempat_lahir }}</td>
                <td>{{ $s->tanggal_lahir }}</td>
                <td>{{ $s->telepon }}</td>
                <td>{{ $s->agama }}</td>
                <td>{{ $s->status_nikah }}</td>
                <td>{{ $s->alamat }}</td>
                <td>{{ $s->foto }}</td>
                <td>
                    <button type="button" class="btn btn-success btn-size" data-bs-toggle="modal" data-bs-target="#modalEdit" data-mode="edit" data-id="{{ $s->id }}" data-nip="{{ $s->nip }}" data-nik="{{ $s->nik }}" data-nama="{{ $s->nama }}" data-jenis_kelamin="{{ $s->jenis_kelamin}}" data-tempat_lahir="{{ $s->tempat_lahir }}" data-tanggal_lahir="{{ $s->tanggal_lahir }}" data-telepon="{{ $s->telepon }}" data-agama="{{ $s->agama }}" data-status_nikah="{{ $s->status_nikah }}" data-alamat="{{ $s->alamat }}" data-foto="{{ $s->foto }}">
                        <i class="fas fa-edit"></i>
                    </button>
                    <form action="{{ route('karyawan.destroy', $s->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger delete-data btn-size" data-id="{{ $s->id }}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>