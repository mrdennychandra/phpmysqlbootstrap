<?php
include '../konfigurasi/config.php';
include '../fragment/header.php';
include '../konfigurasi/function.php';
?>
<body>
    <header>
        <h1>Daftar Karyawan</h1>
    </header>
    <nav>
        <?php include '../fragment/menu.php' ?>
    </nav>
    <main>
        <h3><a href="tambah.php">tambah</a></h3>
        <table>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Telpon</th>
                <th>Jabatan</th>
                <th>Jenis Kelamin</th>
                <th>Divisi</th>
            </tr>
            <?php
            $con = connect_db();
            $query = "SELECT k.*,d.nama as namadivisi FROM karyawan k "
                    . "INNER JOIN divisi d ON d.divisiid = k.divisiid";
            $result = execute_query($con, $query);
            while ($data = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <td><?= $data['nama'] ?></td>
                    <td><?= $data['email'] ?></td>
                    <td><?= $data['telpon'] ?></td>
                    <td><?= $data['jabatan'] ?></td>
                    <td><?= $data['jeniskelamin'] ?></td>
                    <td><?= $data['namadivisi'] ?></td>
                    <td><a href="detail.php?karyawanid=<?= $data['karyawanid'] ?>">Detail</a></td>
                    <td><a href="edit.php?karyawanid=<?= $data['karyawanid'] ?>">Edit</a></td>
                    <td><a onclick="return confirm('akan menghapus data?')" 
                           href="hapus.php?karyawanid=<?= $data['karyawanid'] ?>">Hapus</a></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </main>
    <?php include '../fragment/footer.php'; ?>