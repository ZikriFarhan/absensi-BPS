<div class="container-fluid">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-0">
                <h3 class='box-title'>Tambah Peserta</h3>
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
            <form action="/pesertamagang/create" method="post">

                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama" value="<?= old('nama') ?>">
                </div>

                <div class="form-group">
                    <label for="nim">NIM</label>
                    <input type="text" class="form-control" id="nim" name="nim" placeholder="Masukkan NIM" value="<?= old('nim') ?>">
                </div>

                <div class="form-group">
                    <label for="id_universitas">Universitas</label>
                    <select class="form-control selectpicker" data-live-search="true" id="id_universitas" name="id_universitas" title="Pilih Universitas">
                        <?php foreach ($univ as $row) : ?>
                            <option value="<?= $row['id']; ?>" <?= (old('id_universitas') == $row['id']) ? "selected" : ""; ?>><?= $row['nama_universitas']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="id_bidang">Bidang</label>
                    <select class="form-control select_bidang" id="id_bidang" name="id_bidang" title="Pilih Bidang">
                        <?php foreach ($bidang as $row) : ?>
                            <option value="<?= $row['id']; ?>" <?= (old('id_bidang') == $row['id']) ? "selected" : ""; ?>><?= $row['nama_bidang']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
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