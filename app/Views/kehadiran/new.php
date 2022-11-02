<head>
    <title>Form Tambah <?php $title ?></title>
</head>

<body>
    <h3><?php $title ?></h3>
    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger" role="alert">
            <ul>
                <?php foreach (session()->getFlashdata('error') as $error) : ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="/kehadiran/create" method="post">

        <div class="form-group">
            <label for="nama_kehadiran">Nama Kehadiran</label>
            <input type="text" class="form-control" id="nama_kehadiran" name="nama_kehadiran" placeholder="Masukkan Kehadiran">
        </div>

        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
</body>