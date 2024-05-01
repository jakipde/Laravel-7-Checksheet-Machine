@extends('layout')

@section('content')
<div class="container">
    <center>
        <h1>Histori Transaksi</h1>
    </center>
    <div class="row">
        <div class="col-md-6">
            <button id="export-filtered" class="btn btn-success mb-3">Excel</button>
        </div>
        <div class="col-md-6">
                <input type="text" id="date-range-picker" placeholder="Select Date Range">
        </div>
        <br></br>
    </div>
    <table class="table" id="products-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Part Model</th>
                <th>Customer</th>
                <th>Shift</th>
                <th>In (pcs)</th>
                <th>Out (pcs)</th>
                <th>Sisa</th>
                <th>PIC</th>
                <th>Keterangan</th>
                <th>Dibuat Pada</th>
                <th>Diubah Pada</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mains as $main)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $main->part->name }}</td>
                    <td>{{ $main->customer->name }}</td>
                    <td>{{ $main->shift }}</td>
                    <td>{{ $main->in }}</td>
                    <td>{{ $main->out }}</td>
                    <td>{{ $main->sisa }}</td>
                    <td>
                        @php
                            $picName = $main->pic_name;
                            $formattedPicName = Str::contains($picName, 'Nama') ? Str::after($picName, 'Nama ') : $picName;
                            $formattedPic = $formattedPicName . ($main->pic === 'MFG' ? ' (MFG)' : ' (QC)');
                        @endphp
                        {{ $formattedPic }}
                    </td>
                    <td>{{ $main->keterangan }}</td>
                    <td>{{ $main->created_at->timezone('Asia/Jakarta')->format('Y/m/d') }}</td>
                    <td>{{ $main->updated_at->timezone('Asia/Jakarta')->format('Y/m/d') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
