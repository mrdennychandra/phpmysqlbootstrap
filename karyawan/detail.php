<?php
include '../konfigurasi/config.php';
include '../fragment/header.php';
include '../konfigurasi/function.php';
?>
<body>
    <header>
        <h1>Detail Karyawan</h1>
    </header>
    <nav>
        <?php include '../fragment/menu.php' ?>
    </nav>
    <main>
        <h3></h3>
        <?php
        if (isset($_GET['karyawanid'])) {
            $con = connect_db();
            $karyawanid = $_GET['karyawanid'];
            $query = "SELECT k.*,d.nama as namadivisi FROM karyawan k "
                    . "INNER JOIN divisi d ON d.divisiid = k.divisiid WHERE "
                    . "karyawanid='$karyawanid'";
            $result = execute_query($con, $query);
            $data = mysqli_fetch_array($result);
            ?>
            <table>
                <tr>
                    <th>Nama</th>
                    <td><?= $data['nama'] ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?= $data['email'] ?></td>
                </tr>
                <tr>
                    <th>Telpon</th>
                    <td><?= $data['telpon'] ?></td>
                </tr>
                <tr>
                    <th>Jabatan</th>
                    <td><?= $data['jabatan'] ?></td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td><?php
                        if ($data['jeniskelamin'] == 'L') {
                            echo "Laki-laki";
                        } else {
                             echo "Perempuan";
                        }
                        ?></td>
                </tr>
                <tr>
                    <th>Divisi</th>
                    <td><?= $data['namadivisi'] ?></td>
                </tr>
            </table>
            <?php
        } else {
            header("location:index.php");
        }
        ?>
    </main>
<?php include '../fragment/footer.php'; ?>