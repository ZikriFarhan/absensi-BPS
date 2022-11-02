<div class="container-fluid">

    <a href="/status/new" class="btn btn-primary">Tambah</a>

    <table id="tabel-peserta" border="1">

        <h1> <?php $title ?> </h1>
        <thead>
            <tr>
                <th>No</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($status as $row) : ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $row['nama_status']; ?></td>
                    <td>
                        <a href="/status/show/<?= $row['id']; ?>" class="btn btn-primary">Detail</a>
                        <a href="/status/edit/<?= $row['id']; ?>" class="btn btn-warning">Edit</a>
                        <form action="/status/delete/<?= $row['id']; ?>" method="post" class="d-inline">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?');">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        </h1>
    </table>
</div>