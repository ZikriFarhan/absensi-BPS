<div class="container-fluid">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-0">
                <h3>Tambah presensi</h3>
                <?php if (session()->getFlashdata('error')) {
                ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach (session()->getFlashdata('error') as $error) : ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <form action="/presensi/create" method="post">
                <div class="form-group">
                    <label for="nim">Nama</label>
                    <select class="form-control selectpicker" data-live-search="true" id="nim" name="nim" title="Pilih Nama">
                        <?php foreach ($peserta as $row) : ?>
                            <option value="<?= $row['nim']; ?>" <?= old('nim') == $row['nim'] ? "selected" : ""; ?>><?= $row['nama']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Masukkan tanggal" value="<?= old('tanggal') ?>">
                </div>

                <div class="form-group">
                    <label for="id_kehadiran">Kehadiran</label>
                    <select class="form-control" id="id_kehadiran" name="id_kehadiran" title="Pilih Kehadiran">
                        <?php foreach ($kehadiran as $row) : ?>
                            <option value="<?= $row['id']; ?>" <?= old('id_kehadiran') == $row['id'] ? "selected" : ""; ?>><?= $row['nama_kehadiran']; ?></option>
                        <?php endforeach; ?>
                    </select>

                    <div class="form-group">
                        <label for="jam_masuk">Jam Masuk</label>
                        <input type="time" class="form-control" id="jam_masuk" name="jam_masuk" placeholder="Masukkan jam masuk" value="<?= old('jam_masuk') ?>">
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan keterangan" value="<?= old('keterangan') ?>">
                    </div>

                    <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </div>
</div>
</div>

<link defer rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<script defer src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

<script>
    $(document).ready(function() {
        $('select').selectpicker({
            liveSearch: true,
            liveSearchPlaceholder: 'Search',
            size: 5,
            style: 'border'
        });
    });
</script>