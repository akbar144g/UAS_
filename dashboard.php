<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barang dan Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('back.jpg') center/cover no-repeat fixed;
            font-family: 'Arial', sans-serif;
        }
        .container {
            margin-top: 40px;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        h1, h2 {
            color: #007BFF;
        }
        .table {
            border-radius: 8px;
            overflow: hidden;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Barang dan Kategori</h1>
        
        <!-- Form Tambah Kategori -->
        <div class="mb-4">
            <h2>Tambah Kategori</h2>
            <form action="add_kategori.php" method="POST" class="card p-4">
                <div class="mb-3">
                    <input type="text" name="nama_kategori" placeholder="Nama Kategori" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Tambah Kategori</button>
            </form>
        </div>

        <!-- Form Tambah Barang -->
        <div class="mb-4">
            <h2>Tambah Barang</h2>
            <form action="add_barang.php" method="POST" class="card p-4">
                <div class="mb-3">
                    <input type="text" name="nama_barang" placeholder="Nama Barang" class="form-control" required>
                </div>
                <div class="mb-3">
                    <input type="number" name="harga" placeholder="Harga Barang" class="form-control" required>
                </div>
                <div class="mb-3">
                    <select name="kategori_id" class="form-select" required>
                        <option value="">Pilih Kategori</option>
                        <?php
                        include "connection.php";
                        try {
                            $stmt = $dbh->query("SELECT * FROM kategori");
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='{$row['id']}'>{$row['nama_kategori']}</option>";
                            }
                        } catch (PDOException $e) {
                            echo "<option value=''>Error: {$e->getMessage()}</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Tambah Barang</button>
            </form>
        </div>

        <!-- Tabel Kategori -->
        <h2>Daftar Kategori</h2>
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                try {
                    $stmt = $dbh->query("SELECT * FROM kategori");
                    $no = 1;
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr><td>{$no}</td><td>{$row['nama_kategori']}</td>
                        <td><a href='delete_kategori.php?id={$row['id']}' class='btn btn-danger btn-sm'>Hapus</a></td></tr>";
                        $no++;
                    }
                } catch (PDOException $e) {
                    echo "<tr><td colspan='3'>Error: {$e->getMessage()}</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Tabel Barang -->
        <h2>Daftar Barang</h2>
        <table class="table table-striped">
            <thead class="table-success">
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                try {
                    $stmt = $dbh->query("
                        SELECT barang.id, barang.nama_barang, barang.harga, kategori.nama_kategori 
                        FROM barang 
                        JOIN kategori ON barang.kategori_id = kategori.id
                    ");
                    $no = 1;
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr><td>{$no}</td><td>{$row['nama_barang']}</td><td>{$row['harga']}</td><td>{$row['nama_kategori']}</td>
                        <td><a href='delete_barang.php?id={$row['id']}' class='btn btn-danger btn-sm'>Hapus</a></td></tr>";
                        $no++;
                    }
                } catch (PDOException $e) {
                    echo "<tr><td colspan='5'>Error: {$e->getMessage()}</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
