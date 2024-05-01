@extends('layout')

@section('content')
    <div class="container">
        <h1>Data Details</h1>
        <table class="table">
            <tbody>
                <tr>
                    <th scope="row">Part Model</th>
                    <td>{{ $main->part->name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th scope="row">Customer</th>
                    <td>{{ $main->customer->name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th scope="row">Rak</th>
                    <td>{{ $main->rak->name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th scope="row">Shift</th>
                    <td>{{ $main->shift }}</td>
                </tr>
                <tr>
                    <th scope="row">In (pcs)</th>
                    <td>{{ $main->in }}</td>
                </tr>
                <tr>
                    <th scope="row">Out (pcs)</th>
                    <td>{{ $main->out }}</td>
                </tr>
                <tr>
                    <th scope="row">Sisa</th>
                    <td>{{ $main->sisa }}</td>
                </tr>                
                <tr>
                    <th scope="row">PIC</th>
                    <td>
                        @php
                            $picName = $main->pic_name;
                            $formattedPicName = Str::contains($picName, 'Nama') ? Str::after($picName, 'Nama ') : $picName;
                            $formattedPic = $formattedPicName . ($main->pic === 'MFG' ? ' (MFG)' : ' (QC)');
                        @endphp
                        {{ $formattedPic }}
                    </td>
                </tr>
                <tr>
                    <th scope="row">Keterangan</th>
                    <td>{{ $main->keterangan }}</td>
                </tr>
                <tr>
                    <th scope="row">Dibuat Pada</th>
                    <td>{{ \Carbon\Carbon::parse($main->created_at)->timezone('Asia/Jakarta')->format('Y/m/d - H:i') }}</td>
                </tr>
                <tr>
                    <th scope="row">Diubah Pada</th>
                    <td>{{ \Carbon\Carbon::parse($main->updated_at)->timezone('Asia/Jakarta')->format('Y/m/d - H:i') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection