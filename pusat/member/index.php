<div class="card mt-5">
    <div class="card-header">
        <h2>Tabel Member</h2>
        <a class="btn btn-primary mb-2" href="index.php?page=member/insert"><i class="bi bi-plus-square"></i>
            Tambah Member</a>
    </div>

    <div class="card-body">
        <table class="table table-hover table-dark" id="example">
            <thead>
                <tr>
                    <th scope="col">ID Member</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Nomor Handphone</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $sql = "SELECT * FROM member";
                $result = $conn->query($sql);
                ?>
                <?php if ($result) { ?>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>

                            <td>
                                <?= $row['id_member'] ?>
                            </td>
                            <td>
                                <?= $row['nama'] ?>
                            </td>
                            <td>
                                <?= $row['alamat'] ?>
                            </td>
                            <td>
                                <?= $row['nomor_handphone'] ?>
                            </td>
                            <td>
                                <a href="index.php?page=member/edit&id_member=<?= $row['id_member'] ?>">Edit</a> | <a
                                    href="index.php?page=member/delete&id_member=<?= $row['id_member'] ?>"
                                    onclick="javascript:return confirm('Hapus Data Member ?');">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
