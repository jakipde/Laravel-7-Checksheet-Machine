@extends('layout')

@section('content')
<div class="container">
    <center>
        <h1>LEMBAR KONTROL RETRY MESIN</h1>
    </center>
    <a href="{{ route('main.create') }}" class="btn btn-primary mb-3">Tambah</a>
    <a href="{{ route('main.refresh') }}" class="btn btn-warning mb-3">Ambil Data</a>
    <button id="export-filtered" class="btn btn-success mb-3">Excel</button>
    <input type="text" id="date-range-picker" placeholder="Select Date Range">
    <br></br>
    <table class="table" id="products-table">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Tanggal</th>
                <th class="text-center">PF_RETRY</th>
                <th class="text-center">PF_NG</th>
                <th class="text-center">ATSU_RETRY</th>
                <th class="text-center">ATSU_NG</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody id="products-tablebody">
            @foreach ($mains as $main)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ date('Y-m-d', strtotime($main->date)) }}</td>
                    <td class="text-center">{{ $main->pf_retry }}</td>
                    <td class="text-center">{{ $main->pf_ng }}</td>
                    <td class="text-center">{{ $main->atsu_retry }}</td>
                    <td class="text-center">{{ $main->atsu_ng }}</td>
                    <td class="text-center">
                        {{-- <a href="{{ route('main.show', $main->id) }}" class="btn btn-info">View</a> --}}
                        {{-- <a href="{{ route('main.edit', $main->id) }}" class="btn btn-primary">Edit</a> --}}
                        {{-- <form action="{{ route('main.destroy', $main->id) }}" method="POST" style="display: inline;"> --}}
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirmAction('menghapus')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/index.js') }}"></script>
<script>
    function confirmAction(action) {
        return confirm(`Apakah anda yakin ingin ${action} data?`);
    }
</script>
<style>
    #products-table th,
    #products-table td {
    border-right: 2px solid black;
    border-left: 2px solid black; /* Add a 2px solid black border to the right of each <th> and <td> element */
    }

    #products-table tbody tr:last-child td {
    border-bottom: none; /* Remove the bottom border from the last row to avoid double borders */
    }

    #products-table tbody tr td {
        border-bottom: 2px solid black; /* Add a 2px solid black border to the bottom of each <td> element */
    }
    </style>
@endsection
