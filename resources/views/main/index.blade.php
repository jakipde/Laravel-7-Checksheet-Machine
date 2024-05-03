@extends('layout')

@section('content')
<div class="container">
    <div class="row">
            <h3>LEMBAR KONTROL RETRY MESIN
                <a href="{{ route('main.create') }}" class="btn btn-primary mb-3">Tambah</a>
                <button id="export-filtered" class="btn btn-xs btn-success float-right add" style="margin-right : 50px;">Excel</button>
                <input type="text" id="date-range-picker" placeholder="Tanggal">
            </h3>
            <hr>

            <table id="products-table" class="table table-bordered table-condensed table-striped">
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
                        <form action="{{ route('main.destroy', $main->date) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirmAction('menghapus')">Delete</button>
                        </form>                                                                  
                    </td>
                </tr>
            @endforeach
            </table>
        </div>
    </div>
</div>
@endsection