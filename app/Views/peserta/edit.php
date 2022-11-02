<div class="container-fluid">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-0">
                    <h3>Edit Peserta</h3>
                    <?php if (session()->getFlashdata('error')) {
                    ?>
                        <div class="alert alert-danger ml-auto">
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
                <form action="/pesertamagang/update/<?= $peserta['id']; ?>" method="post">

        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= $peserta['nama']; ?>">
        </div>

        <div class="form-group">
            <label for="nim">NIM</label>
            <input type="text" class="form-control" id="nim" name="nim" value="<?= $peserta['nim']; ?>">
        </div>

        <div class="form-group">
            <label for="id_universitas">Universitas</label>
            <select class="form-control" id="id_universitas" name="id_universitas">
                <option placeholder="">Pilih Universitas</option>
                <?php foreach ($univ as $row) : ?>
                    <option value="<?= $row['id']; ?>"><?= $row['nama_universitas']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="id_bidang">Bidang</label>
            <select class="form-control" id="id_bidang" name="id_bidang">
                <option placeholder="">Pilih Bidang</option>
                <?php foreach ($bidang as $row) : ?>
                    <option value="<?= $row['id']; ?>"><?= $row['nama_bidang']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
            </div>
        </div>
</div>
