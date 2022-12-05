<div class="container-fluid">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-0">
                    <h3>Edit Universitas</h3>
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
                    <form action="/universitas/update/<?= $data['id']; ?>" method="post">

        <div class="form-group">
            <label for="nama_universitas">Nama Universitas</label>
            <input type="text" class="form-control" id="nama_universitas" name="nama_universitas" value="<?= $data['nama_universitas']; ?>">
        </div>

        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
            </div>
        </div>
</div>
