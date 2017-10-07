<?php
include '../konfigurasi/config.php';
include '../fragment/header.php';
include '../konfigurasi/function.php';
?>
<body>
    <header>
        <h1>Daftar Divisi</h1>
    </header>
    <nav>
        <?php include '../fragment/menu.php' ?>
    </nav>
    <main>
        <h3></h3>
        <?php
        if (isset($_GET['divisiid'])) {
            $divisiid = $_GET['divisiid'];
            $query = "DELETE FROM divisi WHERE divisiid='$divisiid'";
            $con = connect_db();
            execute_query($con, $query);
            if(mysqli_affected_rows($con) != 0){
                echo "Data berhasiil dihapus";
            }else{
                echo "data tidak berhasil dihapus";
            }
        }
        ?>
    </main>
    <?php include '../fragment/footer.php'; ?>