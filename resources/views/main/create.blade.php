@extends('layout')

@section('content')
    <div class="container">
        <center><h1>Tambah Data</h1></center>
        <form action="{{ route('main.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="shift">Shift :</label>
                <select name="shift" id="shift" class="form-control">
                    <option value="">-- Shift --</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                </select>
            </div>
            <div class="form-group">
                <label for="pf_retry">PF_RETRY :</label>
                <select name="pf_retry" id="pf_retry" class="form-control select2">
                    <option value="">-- PF_RETRY --</option>
                    @for ($i = 1; $i <= 100; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="form-group">
                <label for="pf_ng">PF_NG :</label>
                <select name="pf_ng" id="pf_ng" aclass="form-control select2">
                    <option value="">-- PF_NG --</option>
                    @for ($i = 1; $i <= 100; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="form-group">
                <label for="atsu_retry">ATSU_RETRY :</label>
                <select name="atsu_retry" id="atsu_retry" class="form-control select2">
                    <option value="">-- ATSU_RETRY --</option>
                    @for ($i = 1; $i <= 100; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="form-group">
                <label for="atsu_ng">ATSU_NG :</label>
                <select name="atsu_ng" id="atsu_ng" class="form-control select2">
                    <option value="">-- ATSU_NG --</option>
                    @for ($i = 1; $i <= 100; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
                <button type="submit" class="btn btn-primary" onclick="return confirmAction('menambahkan', $('#parts').val())">Submit</button>
            </form>            
        <br></br>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        function confirmAction(action) {
            var partName = $('#parts option:selected').text();
            return confirm(`Apakah anda yakin ingin ${action} data untuk Part ${partName} ?`);
        }
    </script>
@endsection
