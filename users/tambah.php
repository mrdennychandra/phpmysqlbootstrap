<?php
include '../konfigurasi/config.php';
include '../fragment/header.php';
include '../konfigurasi/function.php';
?>
<script type="text/javascript">
    $(function () {
        $('input.datepicker').each(function () {
            var datepicker = $(this);
            datepicker.bootstrapDatePicker(datepicker.data());
        });
    });

</script>
<header>
    <h1>Tambah User</h1>
</header>
<nav>
    <?php include '../fragment/menu.php' ?>
</nav>
<main>
    <h3></h3>
    <?php
    $con = connect_db();
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $tgllahir = $_POST['tgllahir'];
        $password = md5($_POST['password']);
        $role = $_POST['role'];
        $karyawanid = $_POST['karyawanid'];
        $file_name = "";
        if (empty($username)) {
            echo "username harus diisi";
        } elseif (empty($password)) {
            $password = md5("abcdef");
        } else {
            //cek apakah username sudah ada,karena username adalah unik
            $query = "SELECT username FROM users WHERE username='$username'";
            $result = execute_query($con, $query);
            if (mysqli_num_rows($result) != 0) {
                //kode sudah ada
                echo "<div>Username $username sudah terdaftar</div>";
            } else {
                if (isset($_FILES['gambar'])) {
                    $errors = array();
                    $file_name = trim($_FILES['gambar']['name']);
                    $file_size = $_FILES['gambar']['size'];
                    $file_tmp = $_FILES['gambar']['tmp_name'];
                    $file_type = $_FILES['gambar']['type'];
                    $file_ext = strtolower(end(explode('.', $_FILES['gambar']['name'])));
                    $expensions = array("jpeg", "jpg", "png");
                    if (in_array($file_ext, $expensions) === false) {
                        echo "file harus berupa JPEG or PNG file.";
                    } else if ($file_size > 2097152) {
                        echo 'ukuran file max 2 MB';
                    } else {
                        move_uploaded_file($file_tmp, "../image/" . $file_name);
                    }
                }
                $query = "INSERT INTO users (username,password,gambar,role,karyawanid,tgllahir) "
                        . "VALUES ('$username','$password','$file_name','$role','$karyawanid','$tgllahir')";
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
              enctype="multipart/form-data"
              id="formtambah">
            <div class="form-group">
                <label class="control-label col-sm-4"  for="username">Username:</label>
                <div class="col-sm-6">
                    <input type="text" name="username" id="username"
                           size="30" required="required">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4" for="tgllahir">Tangal Lahir:</label>
                <div class="col-sm-6">
                    <input type="text" name="tgllahir" id="tgllahir" 
                           class="form-control datepicker" 
                           value="2014-01-01"
                           data-default-today="true" data-date-format="DD-MM-YYYY"
                           required="required"></div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4" for="password">Password</label> 
                <div class="col-sm-6">
                    <input type="text" name="password" id="password" size="30">
                </div> 
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4" for="gambar">Foto</label>
                <div class="col-sm-6">
                    <input type="file" name="gambar" id="gambar">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4" for="role">Role:</label> 
                <div class="col-sm-6">
                    <select name="role" id="role">
                        <?php
                        foreach ($role as $key => $value) {
                            ?>
                            <option value="<?= $key ?>"><?= $value ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4" for="karyawanid">Nama Karyawan:</label> 
                <div class="col-sm-6">
                    <select name="karyawanid" id="karyawanid">
                        <?php
                        $query = "SELECT * FROM karyawan";
                        $result = execute_query($con, $query);
                        while ($karyawan = mysqli_fetch_array($result)) {
                            ?>
                            <option value="<?= $karyawan['karyawanid'] ?>">
                                <?= $karyawan['nama'] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group pull-right">
                <div class="col-sm-6">
                    <input type="submit" class="btn btn-primary" value="Simpan" id="submit" name="submit">
                </div
            </div>
        </form>
    </div>
</main>
<?php
include '../fragment/footer.php';
?>