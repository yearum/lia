<?php
require 'function.php';
?>

<div class="card mt-5">
    <div class="card-header">
        <h2>Tabel Data Member</h2>
        <a class="btn btn-primary mb-2" href="index.php?page=data_member/insert"><i class="bi bi-plus-square"></i>
            Tambah Member</a>
    </div>

    <div class="card-body">
        <table class="table table-hover table-dark" id="example">
            <thead>
                <tr>
                    <th scope="col">Nama Member</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telepon</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $sql = "SELECT * FROM data_member";
                $result = $conn->query($sql);
                ?>
                <?php if ($result->num_rows > 0) { ?>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?= $row['nama_member'] ?></td>
                            <td><?= $row['alamat'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['telepon'] ?></td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="5">Tidak ada data member.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
