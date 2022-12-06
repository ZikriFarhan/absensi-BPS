<div class="container-fluid">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-0">
                <h3>Export PDF</h3>
                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            <?php foreach (session()->getFlashdata('error') as $error) : ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <form action="/presensi/export_excel" method="post">
                <div class="form-group" style="max-width:50% ;">
                    <label for="Export">Export Excel</label>
                    <select name="getByName" id="getByName" class="form-control selectpicker" data-style="border" title="Pilih Data Rekap">
                        <option value="0" selected>Rekap Semua Data</option>
                        <option value="1">Rekap Berdasarkan Nama</option>
                    </select>
                </div>

                <div class="form-group ByName" style="max-width:50% ;">
                    <label for="id">Nama</label>
                    <select class="form-control selectpicker" data-live-search="true" data-style="border" id="nim" name="nim" title="Pilih Nama">
                        <?php foreach ($peserta as $row) : ?>
                            <option value="<?= $row['nim']; ?>" <?= old('nim') == $row['nim'] ? "selected" : ""; ?>><?= $row['nama']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.1.js"></script>

<script>
    $(document).ready(function() {
        $('.ByName').hide();
        $('#getByName').change(function() {
            if ($(this).val() == 1) {
                $('.ByName').show();
            } else {
                $('.ByName').hide();
            }
        });
    });
</script>