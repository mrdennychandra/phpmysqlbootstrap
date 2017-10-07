<?php
include '../konfigurasi/config.php';
include '../fragment/header.php';
include '../konfigurasi/function.php';
?>
<body>
    <header>
        <h1>Daftar User</h1>
    </header>
    <nav>
        <?php include '../fragment/menu.php' ?>
    </nav>
    <main>
        <h3><a href="tambah.php">tambah</a></h3>
        <table>
            <tr>
                <th>Username</th>
                <th>Nama</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
            <?php
            $con = connect_db();
            $query = "SELECT u.username,u.gambar,u.role,k.nama,u.userid "
                    . "FROM users u LEFT JOIN karyawan k ON "
                    . "u.karyawanid=k.karyawanid";
            $result = execute_query($con, $query);
            while ($data = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <td><?= $data['username'] ?></td>
                    <td><?= $data['nama'] ?></td>
                    <td><?= $data['role'] ?></td>
                    <td><a href="detail.php?userid=<?= $data['userid'] ?>">
                            Detail</a></td>
                    <td><a href="edit.php?userid=<?= $data['userid'] ?>">
                            Edit</a></td>
                    <td><a onclick="return confirm('akan menghapus data?')" 
                           href="hapus.php?userid=<?= $data['userid'] ?>">
                            Hapus</a></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </main>
    <?php include '../fragment/footer.php'; ?>