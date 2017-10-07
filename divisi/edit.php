<?php
include '../konfigurasi/config.php';
include '../fragment/header.php';
include '../konfigurasi/function.php';
?>
<body>
    <header>
        <h1>Edit Divisi</h1>
    </header>
    <nav>
        <?php include '../fragment/menu.php' ?>
    </nav>
    <main>
        <h3></h3>
        <?php
        if (isset($_POST['submit'])) {
            $divisiid = $_POST['divisiid'];
            $kode = $_POST['kode'];
            $nama = $_POST['nama'];
            if (empty($kode)) {
                echo "kode divisi harus diisi";
            } elseif (empty($nama)) {
                echo "nama divisi harus diisi";
            } else {
                $con = connect_db();
                //cek jika kode divisi sudah digunakan pada row yang lain
                $query = "SELECT divisiid FROM divisi WHERE "
                        . "kode='$kode' AND divisiid <> '$divisiid'";
                $result = execute_query($con, $query);
                if (mysqli_num_rows($result) != 0) {
                    //kode sudah ada
                    echo "<div>Kode $kode sudah terdaftar untuk $nama</div>";
                } else {
                    $query = "UPDATE divisi SET kode='$kode',"
                            . "nama='$nama' WHERE divisiid='$divisiid'";
                    execute_query($con, $query);
                    header("location:index.php");
                }
            }
        } else if (isset($_GET['divisiid'])) {
            //tampilkan data di form
            $con = connect_db();
            $divisiid = $_GET['divisiid'];
            $query = "SELECT * FROM divisi WHERE divisiid='$divisiid'";
            $result = execute_query($con, $query);
            $data = mysqli_fetch_array($result);
        } else {
            header("location:index.php");
        }
        ?>
        <form 
            name="formedit" 
            method="post" 
            id="formedit">
            <input type="hidden" name="divisiid" id="divisiid" 
                   value="<?= $divisiid ?>">
            <div>
                <label for="nama">Kode Divisi:</label>
                <input type="text" name="kode" id="kode" 
                       value="<?= $data['kode'] ?>"
                       size="3" required="required"> 
            </div>
            <div>
                <label for="telpon">Nama Divisi:</label> 
                <input type="text" name="nama" id="nama" 
                       value="<?= $data['nama'] ?>"required="required" size="30">
            </div>
            <div>
                <input type="submit" value="Simpan" id="submit" name="submit">
            </div>
        </form>
    </main>
    <?php include '../fragment/footer.php'; ?>