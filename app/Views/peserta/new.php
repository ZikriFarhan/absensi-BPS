<head>
    <title>Form Tambah <?php $title ?></title>
</head>

<body>
    <div class="box box-success ml-3 mt-3">
                <div class='box-header with-border'>
                    <h3 class='box-title'>Tambah Peserta</h3>
                </div>
    <?php if (session()->getFlashdata('validation')) {
    ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session()->getFlashdata('validation') as $error) : ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php } ?>

    <form action="/pesertamagang/create" method="post">

        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama">
        </div>

        <div class="form-group">
            <label for="nim">NIM</label>
            <input type="text" class="form-control" id="nim" name="nim" placeholder="Masukkan NIM">
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
</body>