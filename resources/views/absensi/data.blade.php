<div class="mt-4">
    <table class="table table-striped rounded overflow-hidden" id="myTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Karyawan</th>
                <th>Tanggal Masuk</th>
                <th>Waktu Masuk</th>
                <th>Status</th>
                <th>Waktu Selesai Kerja</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($absensi as $index => $j)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $j->nama_karyawan }}</td>
                <td>{{ $j->tanggal_masuk }}</td>
                <td>{{ $j->waktu_masuk }}</td>
                <td>{{ $j->status }}</td>
                <td>{{ $j->waktu_selesai_kerja }}</td>
                <td>
                    <button type="button" class="btn btn-success btn-size" data-bs-toggle="modal" data-bs-target="#modalEdit" data-mode="edit" data-id="{{ $j->id }}" data-nama_karyawan="{{ $j->nama_karyawan}}" data-tanggal_masuk="{{ $j->tanggal_masuk}}" data-waktu_masuk="{{ $j->waktu_masuk}}" data-status="{{ $j->status}}" data-waktu_selesai_kerja="{{ $j->waktu_selesai_kerja}}">
                        <i class="fas fa-edit"></i>
                    </button>
                    <form action="{{ route('absensi.destroy', $j->id) }}" method="post" class="d-inline">
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