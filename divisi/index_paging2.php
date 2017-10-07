<?php
include '../konfigurasi/config.php';
include '../fragment/header.php';
include '../konfigurasi/function.php';
cek_session();
?>
<body>
    <header>
        <h1>Daftar Divisi</h1>
    </header>
    <nav>
        <?php include '../fragment/menu.php' ?>
    </nav>
    <main>
        <?php
        if (is_admin()) {
            ?>
            <h3><a href="tambah.php">tambah</a></h3>
            <?php
        }
        ?>
        <table>
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
                    <td><a href="detail.php?divisiid=<?= $data['divisiid'] ?>">
                            Detail</a></td>
                    <?php
                    if (is_admin()) {
                        ?>
                        <td><a href="edit.php?divisiid=<?= $data['divisiid'] ?>">
                                Edit</a></td>
                        <td><a onclick="return confirm('akan menghapus data?')" 
                               href="hapus.php?divisiid=<?= $data['divisiid'] ?>">
                                Hapus</a></td>
                        <?php
                    }
                    ?>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
        $query = "SELECT COUNT(divisiid) FROM divisi";
        $result = execute_query($con, $query);
        $row = mysqli_fetch_row($result);
        $total_records = $row[0];
        $total_pages = ceil($total_records / $limit);
        //$pagLink = "<div class='pagination'>";
        $link = "";
        for ($i = 1; $i <= $total_pages; $i++) {
            $link .= "<a href='index_paging2.php?page=" . $i . "'>" . $i . "</a>";
        };
        //echo $pagLink . "</div>";
        echo $link;
        ?>
    </main>
    <?php include '../fragment/footer.php'; ?>