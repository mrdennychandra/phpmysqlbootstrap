<?php
include '../konfigurasi/config.php';
include '../fragment/header.php';
include '../konfigurasi/function.php';
cek_session();
?>
<?php include '../fragment/menu.php' ?>
<h2>Daftar Divisi</h2>

<?php
if (is_admin()) {
    ?>
    <h3><a class="btn btn-success" style="float: right;margin-bottom: 20px" href="tambah.php">tambah</a></h3>

    <?php
}
?>
<main>
    <table class="table table-hover">
        <tr>
            <th>Kode Divisi</th>
            <th>Nama Divisi</th>
            <th>Aksi</th>
        </tr>
        <?php
        $con = connect_db();
        $limit = 2;
        if (isset($_GET["page"])) {
            $page = $_GET["page"];
        } else {
            $page = 1;
        };
        $start_from = ($page - 1) * $limit;

        $query = "SELECT * FROM divisi LIMIT $start_from, $limit";
        $result = execute_query($con, $query);
        while ($data = mysqli_fetch_array($result)) {
            ?>
            <tr>
                <td><?= $data['kode'] ?></td>
                <td><?= $data['nama'] ?></td>
                <!-- file : divisi/index.php -->
                <td><a class="btn btn-sm btn-default" href="detail.php?divisiid=<?= $data['divisiid'] ?>">
                        Detail</a>
                    <?php
                    if (is_admin()) {
                        ?>
                        <a class="btn btn-sm btn-warning" href="edit.php?divisiid=<?= $data['divisiid'] ?>">
                            Edit</a>
                        <a class="btn btn-sm btn-danger" onclick="return confirm('akan menghapus data?')" 
                           href="hapus.php?divisiid=<?= $data['divisiid'] ?>">
                            Hapus</a>
                        <?php
                    }
                    ?>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <nav aria-label="Page navigation" style="float: right">
        <ul class="pagination">
            <?php
            $query = "SELECT COUNT(divisiid) FROM divisi";
            $result = execute_query($con, $query);
            $row = mysqli_fetch_row($result);
            $total_records = $row[0];
            $total_pages = ceil($total_records / $limit);
            $link = "";
            for ($i = 1; $i <= $total_pages; $i++) {
                $link .= "<li><a href='index.php?page=" . $i . "'>" . $i . "</a></li>";
            };
            echo $link;
            ?>
        </ul>
    </nav>
</main>
<?php include '../fragment/footer.php'; ?>