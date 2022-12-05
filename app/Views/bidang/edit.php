<div class="container-fluid">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-0">
                <h3>Edit Bidang</h3>
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
            <form action="/bidang/update/<?= $data['id']; ?>" method="post">

                <div class="form-group">
                    <label for="nama_bidang">Nama</label>
                    <input type="text" class="form-control" id="nama_bidang" name="nama_bidang" value="<?= $data['nama_bidang']; ?>">
                </div>

                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
        </div>
    </div>
</div>