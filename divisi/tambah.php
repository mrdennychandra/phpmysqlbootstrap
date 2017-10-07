<?php
include '../konfigurasi/config.php';
include '../fragment/header.php';
include '../konfigurasi/function.php';
?>

<?php include '../fragment/menu.php' ?>
<h1>Tambah Divisi</h1>
<h3></h3><main>
    <?php
    if (isset($_POST['submit'])) {
        $kode = $_POST['kode'];
        $nama = $_POST['nama'];
        if (empty($kode)) {
            echo "kode divisi harus diisi";
        } elseif (empty($nama)) {
            echo "nama divisi harus diisi";
        } else {
            $con = connect_db();
            //cek apakah kode sudah ada,karena kode adalah unik
            $query = "SELECT divisiid FROM divisi WHERE kode='$kode'";
            $result = execute_query($con, $query);
            if (mysqli_num_rows($result) != 0) {
                //kode sudah ada
                echo "<div>Kode $kode sudah terdaftar</div>";
            } else {
                $query = "INSERT INTO divisi (kode,nama) "
                        . "VALUES ('$kode','$nama')";
                $result = execute_query($con, $query);
                if (mysqli_affected_rows($con) != 0) {
                    header("location:index.php");
                }
            }
        }
    }
    ?>
    <div class="row col-sm-10">
        <form class="form-horizontal"
              name="formtambah" 
              method="post" 
              id="formtambah">
            <div class="form-group">
                <label class="control-label col-sm-4" for="nama">Kode Divisi:</label>
                <div class="col-sm-6">
                    <input type="text" name="kode" id="kode" class="form-control col-sm-10" 
                           size="3" required="required">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4" for="telpon">Nama Divisi:</label> 
                <div class="col-sm-6">
                    <input type="text" name="nama" id="nama" class="form-control col-sm-10" 
                           required="required" size="30">
                </div>
            </div>
            <div class="form-group">
                
                <div class="col-sm-3" style="float: right">
                    <input class="btn btn-primary" type="submit" value="Simpan" id="submit" name="submit">
                </div>
            </div>
            
            </div>
        </form>
    </div>
</main>