<?php
include '../konfigurasi/config.php';
include '../fragment/header.php';
include '../konfigurasi/function.php';
?>
<body>
    <header>
        <h1>Tambah Karyawan</h1>
    </header>
    <nav>
        <?php include '../fragment/menu.php' ?>
    </nav>
    <main>
        <h3></h3>
        <?php
        $con = connect_db();
        if (isset($_POST['submit'])) {
            $nama = $_POST['nama'];
            $email = $_POST['email'];
            $telpon = $_POST['telpon'];
            $jabatan = $_POST['jabatan'];
            $jeniskelamin = $_POST['jeniskelamin'];
            $divisiid = $_POST['divisiid'];
            if (empty($nama)) {
                echo "nama harus diisi";
            } elseif (empty($email)) {
                echo "email harus diisi";
            } elseif (empty($telpon)) {
                echo "telpon harus diisi";
            } else {
                $query = "INSERT INTO karyawan (nama,email,telpon,jabatan,jeniskelamin,divisiid) "
                        . "VALUES ('$nama','$email','$telpon','$jabatan','$jeniskelamin','$divisiid')";
                $result = execute_query($con, $query);
                if (mysqli_affected_rows($con) != 0) {
                    header("location:index.php");
                }
            }
        }
        ?>
        <form 
            name="formtambah" 
            method="post" 
            id="formtambah">
            <div>
                <label for="nama">Nama:</label>
                <input type="text" name="nama" id="nama"
                       size="30" required="required">
            </div>
            <div>
                <label for="email">Email:</label> 
                <input type="text" name="email" id="email" 
                       required="required" size="30">
            </div>
            <div>
                <label for="telpon">Telpon:</label> 
                <input type="text" name="telpon" id="telpon" 
                       required="required" size="15">
            </div>
            <div>
                <label for="telpon">Jabatan:</label> 
                <select name="jabatan" id="jabatan">
                    <?php
                    foreach ($jabatan as $key => $value) {
                        ?>
                        <option value="<?= $key ?>"><?= $value ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div>
                <label for="jeniskelamin">Jenis Kelamin:</label> 
                <input type="radio" name="jeniskelamin" id="L" 
                       value="L" checked="checked">Laki-laki
                <input type="radio" name="jeniskelamin" id="P" 
                       value="P">Perempuan
            </div>
            <div>
                <label for="divisiid">Divisi:</label> 
                <select name="divisiid" id="divisiid">
                    <?php
                    $query = "SELECT * FROM divisi";
                    $result = execute_query($con, $query);
                    while ($karyawan = mysqli_fetch_array($result)) {
                        ?>
                        <option value="<?= $karyawan['divisiid'] ?>"><?= $karyawan['nama'] ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div>
                <input type="submit" value="Simpan" id="submit" name="submit">
            </div>
        </form>
    </main>
    <?php
    include '../fragment/footer.php';
    ?>
