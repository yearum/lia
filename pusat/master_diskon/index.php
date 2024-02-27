<?php
require 'function.php';
?>

<div class="card mt-5">
    <div class="card-header">
        <h2>Tabel Master Diskon</h2>
        <a class="btn btn-primary mb-2" href="index.php?page=master_diskon/insert"><i class="bi bi-plus-square"></i>
            Tambah Diskon</a>
    </div>

    <div class="card-body">
        <table class="table table-hover table-dark" id="example">
            <thead>
                <tr>
                    <th scope="col">ID Diskon</th>
                    <th scope="col">ID Barang</th>
                    <th scope="col">Nama Diskon</th>
                    <th scope="col">Besar Diskon</th>
                    <th scope="col">Tanggal Mulai</th>
                    <th scope="col">Tanggal Akhir</th>
                    <th scope="col">Produk Diskon Target</th>
                    <th scope="col">Diskon</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $sql = "SELECT * FROM master_diskon";
                $result = $conn->query($sql);
                ?>
                <?php if ($result) { ?>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>

                            <td>
                                <?= $row['id_diskon'] ?>
                            </td>
                            <td>
                                <?= $row['id_barang'] ?>
                            </td>
                            <td>
                                <?= $row['nama_diskon'] ?>
                            </td>
                            <td>
                                <?= $row['besar_diskon'] ?>
                            </td>
                            <td>
                                <?= $row['tgl_mulai'] ?>
                            </td>
                            <td>
                                <?= $row['tgl_akhir'] ?>
                            </td>
                            <td>
                                <?= $row['produk_diskon_target'] ?>
                            </td>
                            <td>
                                <?= $row['diskon'] ?>
                            </td>
                            <td>
                                <a href="index.php?page=master_diskon/edit&id_diskon=<?= $row['id_diskon'] ?>">Edit</a> | <a
                                    href="index.php?page=master_diskon/delete&id_diskon=<?= $row['id_diskon'] ?>"
                                    onclick="javascript:return confirm('Hapus Data Diskon ?');">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
