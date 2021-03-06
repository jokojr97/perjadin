<div class="form-group">
    <label for="tujuan">Kode Trx</label>
    <div class="input-group">
        <div class="input-group-addon"><i class="ti-user"></i></div>
        <input type="text" class="form-control" id="kode_trx" name="kode_trx" readonly> </div>
</div>
<div class="form-group">
        <label for="tujuan">Tujuan</label>
        <div class="input-group">
            <div class="input-group-addon"><i class="ti-user"></i></div>
            <input type="text" class="form-control" id="tujuan" name="tujuan" readonly> </div>

</div>
<div class="form-group">
        <label for="tujuan">Durasi</label>
        <div class="input-group">
            <div class="input-group-addon"><i class="ti-user"></i></div>
            <input type="text" class="form-control" id="durasi" name="durasi" readonly> </div>

</div>
<div class="form-group">
    <label for="biaya">Biaya</label>
    <div class="input-group">
        <div class="input-group-addon"><i class="ti-user"></i></div>
        <input type="text" class="form-control" id="biaya" name="biaya" readonly> </div>

</div>
<div class="form-group">
    <label for="biaya">Subject Matter</label>
    <div class="input-group">
        <div class="input-group-addon"><i class="ti-user"></i></div>
        <input type="text" class="form-control" id="sm" name="sm" disabled> </div>

</div>
<div class="form-group">
        <label for="tugas">Tugas</label>
        <div class="input-group">
            <div class="input-group-addon"><i class="ti-lock"></i></div>
            <input type="text" class="form-control" id="tugas" name="tugas" placeholder="Tugas Perjalanan" required="">
        </div>
</div>
<div class="form-group">
    <label for="tglbrkt">Tanggal Berangkat</label>
    <div class="input-group">
        <div class="input-group-addon"><i class="ti-lock"></i></div>
        <input type="text" class="form-control tglbrkt" id="tglberangkat" name="tglberangkat" placeholder="Tanggal Berangkat Perjalanan" required="" autocomplete="off">
    </div>
    <span id="infotgl"></span>
</div>
<div class="form-group">
        <label for="flag">Pegawai</label>
        <div class="input-group">
            <div class="input-group-addon"><i class="ti-medall-alt"></i></div>
            <select class="form-control select2" name="peg_nip" id="peg_nip" required="">
                <option value="">Select</option>
                @foreach ($DataBidang as $bid)
                <optgroup label="{{$bid->nama}}">
                    @foreach ($DataPegawai as $item)
                        @if ($item->Unitkerja->bidang == $bid->bidang)
                            <option value="{{$item->nip_baru}}">{{$item->nama}}</option>
                        @endif
                    @endforeach
                </optgroup>
                @endforeach
            </select>
        </div>
</div>
<div class="form-group">
        <label class="control-label">Diajukan</label>
        <div class="radio-list">
            <label class="radio-inline p-0">
                <div class="radio radio-info">
                    <input type="radio" name="diajukan" id="diajukan1" value="0" checked>
                    <label for="diajukan1" class="text-info">Tidak, save draft</label>
                </div>
            </label>
            <label class="radio-inline">
                <div class="radio radio-danger">
                    <input type="radio" name="diajukan" id="diajukan2" value="1">
                    <label for="diajukan2" class="text-danger">Ajukan saja </label>
                </div>
            </label>
        </div>
        <span class="pull-left"><i><b>Catatan : Perjadin yang sudah diajukan tidak bisa ditarik kembali</b></i></span>
        
    </div>
