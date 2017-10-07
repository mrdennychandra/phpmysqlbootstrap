<?php
include '../konfigurasi/config.php';
include '../fragment/header.php';
include '../konfigurasi/function.php';
?>
<body>
    <header>
        <h1>Sistem Informasi Manajemen Karyawan</h1>
    </header>
    <nav>
        <?php include '../fragment/menu.php' ?>
    </nav>
    <main>
        <h2>Daftar Divisi</h2>
        <table>
            <tr>
                <th>Kode Divisi</th>
                <th>Nama Divisi</th>
                <th>Aksi</th>
            </tr>
            <?php
            $con = connect_db();
            $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
            if ($page <= 0) {
                $page = 1;
            }
            $per_page = 2; // Set how many records do you want to display per page.
            $startpoint = ($page * $per_page) - $per_page;
            $statement = "`divisi` ORDER BY `divisiid` ASC";
            $query = "SELECT * FROM $statement LIMIT $startpoint , $per_page";
            $result = execute_query($con, $query) or die(mysqli_error($con));
            if (mysqli_num_rows($result) != 0) {
                while ($data = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td><?= $data['kode'] ?></td>
                        <td><?= $data['nama'] ?></td>
                        <td><a href="detail.php?divisiid=<?= $data['divisiid'] ?>">Detail</a></td>
                        <td><a href="edit.php?divisiid=<?= $data['divisiid'] ?>">Edit</a></td>
                        <td><a href="hapus.php?divisiid=<?= $data['divisiid'] ?>">Hapus</a></td>
                    </tr>
                    <?php
                }
            }else{
                echo "Tidak ada data";
            }
            ?>
        </table>
        <?= pagination($con,$statement,$per_page,$page,$url='?') ?>
    </main>
    <?php include '../fragment/footer.php'; ?>