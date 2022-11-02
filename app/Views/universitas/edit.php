<head>
    <title>Form Edit <?php $title ?></title>
</head>

<body>
    <h3><?php $title ?></h3>
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

    <form action="/universitas/update/<?= $data['id']; ?>" method="post">

        <div class="form-group">
            <label for="nama_universitas">Nama Universitas</label>
            <input type="text" class="form-control" id="nama_universitas" name="nama_universitas" value="<?= $data['nama_universitas']; ?>">
        </div>

        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
</body>