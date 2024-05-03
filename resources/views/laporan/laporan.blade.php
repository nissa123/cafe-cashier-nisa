@extends('templates.layout')
@push('style')

@endpush
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kehadiran Pegawai</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            text-align: center;
        }
        form {
            margin-bottom: 20px;
            text-align: center;
        }
        label {
            font-weight: bold;
        }
        input[type="date"] {
            padding: 8px;
            font-size: 16px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .print-button {
            text-align: center;
        }
        .print-button button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .print-button button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Laporan Kehadiran Karyawan</h1>
        <form id="date-form">
            <label for="end-text">Nama:</label>
            <input type="text" id="end-text" name="end-text" required>
            <label for="start-date">Tanggal Mulai:</label>
            <input type="date" id="start-date" name="start-date" required>
            <label for="end-date">Tanggal Akhir:</label>
            <input type="date" id="end-date" name="end-date" required>
            <button type="submit">Tampilkan</button>
        </form>
        <div id="report"></div>
        <div class="print-button">
            <button onclick="printReport()">Cetak Laporan</button>
        </div>
    </div>

    <script>
        document.getElementById("date-form").addEventListener("submit", function(event) {
            event.preventDefault(); // Menghentikan pengiriman formulir default
            var startDate = document.getElementById("start-date").value;
            var endDate = document.getElementById("end-date").value;
            // Di sini Anda bisa mengirim permintaan AJAX ke backend untuk mendapatkan data kehadiran pegawai
            // Misalnya:
            // fetch("get_attendance_data.php?start_date=" + startDate + "&end_date=" + endDate)
            //     .then(response => response.json())
            //     .then(data => displayReport(data))
            //     .catch(error => console.error("Error:", error));
            // Untuk saat ini, saya akan menampilkan contoh data
            var sampleData = [
                { name: "John Doe", date: "2024-04-01", status: "Hadir" },
                { name: "Jane Smith", date: "2024-04-01", status: "Cuti" },
                { name: "John Doe", date: "2024-04-02", status: "Hadir" },
                { name: "Jane Smith", date: "2024-04-02", status: "Hadir" },
            ];
            displayReport(sampleData);
        });

        function displayReport(data) {
            var reportDiv = document.getElementById("report");
            reportDiv.innerHTML = ""; // Bersihkan konten sebelumnya
            if (data.length === 0) {
                reportDiv.innerHTML = "<p>Tidak ada data kehadiran untuk periode ini.</p>";
                return;
            }
            var table = document.createElement("table");
            var headerRow = table.insertRow();
            var headers = ["Nama Karyawan", "Tanggal", "Status"];
            headers.forEach(headerText => {
                var th = document.createElement("th");
                th.textContent = headerText;
                headerRow.appendChild(th);
            });
            data.forEach(rowData => {
                var row = table.insertRow();
                Object.values(rowData).forEach(text => {
                    var cell = row.insertCell();
                    cell.textContent = text;
                });
            });
            reportDiv.appendChild(table);
        }

        function printReport() {
            window.print();
        }
    </script>
</body>
</html>

@endsection
@push('script')
    <script>

    </script>
@endpush