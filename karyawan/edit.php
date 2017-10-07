<?php
include '../konfigurasi/config.php';
include '../fragment/header.php';
include '../konfigurasi/function.php';
?>
<body>
    <header>
        <h1>Edit Karyawan</h1>
    </header>
    <nav>
        <?php include '../fragment/menu.php' ?>
    </nav>
    <main>
        <h3></h3>
        <?php
        $con = connect_db();
        if (isset($_POST['submit'])) {
            $karyawanid = $_POST['karyawanid'];
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
                $query = "UPDATE karyawan SET nama='$nama',email='$email',telpon='$telpon',"
                        . "jabatan='$jabatan',jeniskelamin='$jeniskelamin',divisiid='$divisiid' "
                        . "WHERE karyawanid='$karyawanid'";
                execute_query($con, $query);
                header("location:index.php");
            }
        } else if (isset($_GET['karyawanid'])) {
            $karyawanid = $_GET['karyawanid'];
            $query = "SELECT * FROM karyawan k WHERE karyawanid='$karyawanid'";
            $result = execute_query($con, $query);
            $data = mysqli_fetch_array($result);
            ?>
            <form 
                name="formedit" 
                method="post" 
                id="formedit">
                <input type="hidden" name="karyawanid" id="karyawanid" 
                       value="<?= $karyawanid ?>">
                <div>
                    <label for="nama">Nama:</label>
                    <input type="text" name="nama" id="nama" value="<?= $data['nama'] ?>"
                           size="30" required="required">
                </div>
                <div>
                    <label for="email">Email:</label> 
                    <input type="text" name="email" id="email" value="<?= $data['email'] ?>"
                           required="required" size="30">
                </div>
                <div>
                    <label for="telpon">Telpon:</label> 
                    <input type="text" name="telpon" id="telpon" value="<?= $data['telpon'] ?>"
                           required="required" size="15">
                </div>
                <div>
                    <label for="telpon">Jabatan:</label>
                    <select name="jabatan" id="jabatan">
                        <?php
                        foreach ($jabatan as $key => $value) {
                            $selected = "";
                            if ($key == $data['jabatan']) {
                                $selected = "selected";
                            }
                            ?>
                            <option value="<?= $key ?>" <?= $selected ?>><?= $value ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <?php
                    $checked_l = "";
                    $checked_p = "";
                    if ($data['jeniskelamin'] == 'L') {
                        $checked_l = "checked";
                    } else {
                        $checked_p = "checked";
                    }
                    ?>
                    <label for="jeniskelamin">Jenis Kelamin:</label> 
                    <input type="radio" name="jeniskelamin" id="L" 
                           value="L" checked="checked" <?= $checked_l ?>>Laki-laki
                    <input type="radio" name="jeniskelamin" id="P" 
                           value="P"  <?= $checked_p ?>>Perempuan
                </div>
                <div>
                    <label for="divisiid">Divisi:</label> 
                    <select name="divisiid" id="divisiid">
                        <?php
                        $query = "SELECT * FROM divisi";
                        $result = execute_query($con, $query);
                        while ($karyawan = mysqli_fetch_array($result)) {
                            $selected = "";
                            if ($karyawan['divisiid'] == $data['divisiid']) {
                                $selected = "selected";
                            }
                            ?>
                            <option value="<?= $karyawan['divisiid'] ?>" <?= $selected ?>>
                                    <?= $karyawan['nama'] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <input type="submit" value="Simpan" id="submit" name="submit">
                </div>
            </form>
            <?php
        } else {
            header("location:index.php");
        }
        ?>
    </main>
    <?php include '../fragment/footer.php'; ?>