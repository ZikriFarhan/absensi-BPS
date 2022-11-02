<div class="container-fluid">

    <a href="/bidang/new" class="btn btn-primary">Tambah</a>

    <table id="tabel-peserta" border="1">

        <h1> <?php $title ?> </h1>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Bidang</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($data as $row) : ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $row['nama_bidang']; ?>
                    <a href="/bidang/show/<?= $row['id']; ?>" class="btn btn-primary">Detail</a>
                        <a href="/bidang/edit/<?= $row['id']; ?>" class="btn btn-warning">Edit</a>
                        <form action="/bidang/delete/<?= $row['id']; ?>" method="post" class="d-inline">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?');">Delete</button>
                        </form>
                    </td>
                    <td>
                        
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        </h1>
    </table>
</div>

<?php

echo view('/layout_admin/head.php');
echo view('/layout_admin/navbar.php');
echo view('/layout_admin/sidebar_left.php');
echo view('bidang/data_bidang.php');
echo view('/layout_admin/footer.php');
// echo view('layout/sidebar_right.php');
// echo view('layout/example.php');
?>

