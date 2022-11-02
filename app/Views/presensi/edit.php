<style>
    .form-group{
      
    }
</style>


<div class="container-fluid">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-0">
                    <h3>Edit presensi</h3>
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
                <form action="/presensi/update/<?= $data['id']; ?>" method="post">
                
                    <div class="form-group">
                        <label for="nim">Nama</label>
                        <select class="form-control" id="nim" name="nim">
                            <option value="<?= $data['nim'] ?>"><?= $data['nama'] ?></option>
                        </select>
                    </div>
                
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $data['tanggal'] ?>">
                    </div>
                
                    <div class="form-group">
                        <label for="id_kehadiran">Kehadiran</label>
                        <select class="form-control" id="id_kehadiran" name="id_kehadiran">
                            <option value="<?= $data['id_kehadiran'] ?>"><?= $data['nama_kehadiran'] ?></option>
                            <?php foreach ($kehadiran as $row) : ?>
                                <option value="<?= $row['id']; ?>"><?= $row['nama_kehadiran']; ?></option>
                            <?php endforeach; ?>
                        </select>
                            </div>
                
                        <div class="form-group">
                            <label for="jam_masuk">Jam Masuk</label>
                            <input type="time" class="form-control" id="jam_masuk" name="jam_masuk" value="<?= $data['jam_masuk'] ?>">
                        </div>
                
                        <div class="form-group">
                            <label for="jam_keluar">Jam Keluar</label>
                            <input type="time" class="form-control" id="jam_keluar" name="jam_keluar" value="<?= $data['jam_keluar'] ?>">
                        </div>
                
                        <div class="form-group">
                            <label for="id_status">Status</label>
                            <select class="form-control" id="id_status" name="id_status">
                                <option placeholder="">Pilih Status</option>
                                <?php foreach ($status as $row) : ?>
                                    <option value="<?= $row['id']; ?>"><?= $row['nama_status']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan keterangan">
                        </div>
                
                        <button type="submit" class="btn btn-primary mb-4">Tambah</button>
                </form>
            </div>
        </div>
</div>

