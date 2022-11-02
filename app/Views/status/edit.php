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

    <form action="/status/update/<?= $data['id']; ?>" method="post">

        <div class="form-group">
            <label for="nama_status">Status</label>
            <input type="text" class="form-control" id="nama_status" name="nama_status" value="<?= $data['nama_status']; ?>">
        </div>

        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
</body>