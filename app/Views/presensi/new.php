<!--  -->
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
                            <select class="form-control" id="nim" name="nim">
                                <option placeholder="">Pilih Nama</option>
                                <?php foreach ($peserta as $row) : ?>
                                    <option value="<?= $row['nim']; ?>"><?= $row['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control"  id="tanggal" name="tanggal" placeholder="Masukkan tanggal">
                        </div>

                        <div class="form-group">
                            <label for="id_kehadiran">Kehadiran</label>
                            <select class="form-control" id="id_kehadiran" name="id_kehadiran">
                                <option placeholder="">Pilih Kehadiran</option>
                                <?php foreach ($kehadiran as $row) : ?>
                                    <option value="<?= $row['id']; ?>"><?= $row['nama_kehadiran']; ?></option>
                                <?php endforeach; ?>
                            </select>

                            <div class="form-group">
                                <label for="jam_masuk">Jam Masuk</label>
                                <input type="time" class="form-control" id="jam_masuk" name="jam_masuk" placeholder="Masukkan jam masuk">
                            </div>

                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan keterangan">
                            </div>

                            <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>
</div>
</div>
