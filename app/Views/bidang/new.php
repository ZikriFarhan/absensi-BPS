<div class="container-fluid">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-0">
                    <h3>Tambah Bidang</h3>
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
                <form action="/bidang/create" method="post">

                    <div class="form-group">
                        <label for="nama_bidang">Nama Bidang</label>
                        <input type="text" class="form-control" id="nama_bidang" name="nama_bidang" placeholder="Masukkan Bidang">
                    </div>

                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>
    </div>


