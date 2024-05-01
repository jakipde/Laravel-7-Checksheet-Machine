@extends('layout')

@section('content')
    <div class="container">
        <h1>Edit Data</h1>
        <form action="{{ route('main.update', $main->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="part_id">Part Model:</label>
                <select name="part_id" id="part_id" class="form-control">
                    @foreach ($parts as $part)
                        <option value="{{ $part->id }}" {{ $part->id == $main->part_id ? 'selected' : '' }}>{{ $part->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="customer_id">Customer:</label>
                <select name="customer_id" id="customer_id" class="form-control">
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}" {{ $customer->id == $main->customer_id ? 'selected' : '' }}>{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="rak_id">Rak:</label>
                <select name="rak_id" id="rak_id" class="form-control">
                    @foreach ($raks as $rak)
                        <option value="{{ $rak->id }}" {{ $rak->id == $main->rak_id ? 'selected' : '' }}>{{ $rak->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="shift">Shift:</label>
                <select name="shift" id="shift" class="form-control">
                    <option value="A" {{ $main->shift === 'A' ? 'selected' : '' }}>A</option>
                    <option value="B" {{ $main->shift === 'B' ? 'selected' : '' }}>B</option>
                    <option value="C" {{ $main->shift === 'C' ? 'selected' : '' }}>C</option>
                </select>
            </div>
            <div class="form-group">
                <label for="in">In (pcs):</label>
                <input type="number" class="form-control" id="in" name="in" value="{{ $main->in }}">
            </div>
            <div class="form-group">
                <label for="out">Out (pcs):</label>
                <input type="number" class="form-control" id="out" name="out" value="{{ $main->out }}">
            </div>
            <div class="form-group">
                <label for="sisa">Sisa:</label>
                <input type="number" class="form-control" id="sisa" name="sisa" value="{{ $main->sisa }}">
            </div>
            <div class="form-group">
                <label for="pic">PIC:</label>
                <select name="pic" id="pic" class="form-control" onchange="showNamaInput()">
                    <option value=""></option>
                    <option value="MFG" {{ $main->pic === 'MFG' ? 'selected' : '' }}>MFG</option>
                    <option value="QC" {{ $main->pic === 'QC' ? 'selected' : '' }}>QC</option>
                </select>
            </div>
            <div class="form-group" id="nameInput" style="display: {{ ($main->pic === 'MFG' || $main->pic === 'QC') ? 'block' : 'none' }};">
                <label for="pic_name">Name:</label>
                <input type="text" class="form-control" id="pic_name" name="pic_name" value="{{ $main->pic_name }}">
            </div>            
            <div class="form-group">
                <label for="keterangan">Keterangan:</label>
                <textarea class="form-control" id="keterangan" name="keterangan">{{ $main->keterangan }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary" onclick="return confirmAction('mengedit')">Submit</button>
        </form>
        <br>
        <script>
            function confirmAction(action) {
                return confirm(`Apakah anda yakin ingin ${action} data?`);
            }
        
            function showNamaInput() {
                var pic = document.getElementById("pic").value;
                var namaInput = document.getElementById("nameInput");
                if (pic === "MFG" || pic === "QC") {
                    namaInput.style.display = "block";
                } else {
                    namaInput.style.display = "none";
                }
            }
        </script>
    </div>
@endsection
