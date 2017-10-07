<?php
include '../konfigurasi/config.php';
include '../fragment/header.php';
include '../konfigurasi/function.php';
?>
<body>
    <header>
        <h1>Detail Divisi</h1>
    </header>
    <nav>
        <?php include '../fragment/menu.php' ?>
    </nav>
    <main>
        <h3></h3>
        <?php
        if (isset($_GET['divisiid'])) {
            $con = connect_db();
            $divisiid = $_GET['divisiid'];
            $query = "SELECT * FROM divisi WHERE divisiid='$divisiid'";
            $result = execute_query($con, $query);
            $data = mysqli_fetch_array($result);
            ?>
        <table>
            <tr>
                <th>Kode Divisi</th>
                <td><?= $data['kode'] ?></td>
            </tr>
             <tr>
                <th>Nama Divisi</th>
                <td><?= $data['nama'] ?></td>
            </tr>
        </table>
        <?php
        }else{
            header("location:index.php");
        }
        ?>
    </main>
    <?php include '../fragment/footer.php'; ?>