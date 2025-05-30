<?php
// Ambil data dari file JSON
$data = file_get_contents(__DIR__ . '/data/pizza.json');

// Cek apakah data berhasil diambil dan valid
if (!$data) {
  die('Gagal membaca file JSON.');
}

$menu = json_decode($data, true);

// Cek apakah decoding berhasil dan key 'menu' ada
if (!isset($menu['menu'])) {
  die('Format JSON tidak sesuai.');
}

$menu = $menu['menu'];

// Ambil kategori dari URL, default all
$kategori = isset($_GET['kategori']) ? $_GET['kategori'] : 'all';

// Filter menu jika kategori selain 'all'
if ($kategori !== 'all') {
    $menu = array_filter($menu, function($item) use ($kategori) {
        // Pastikan ada key 'kategori' di JSON dan cocok dengan filter
        return isset($item['kategori']) && strtolower($item['kategori']) === strtolower($kategori);
    });
}

// Untuk judul halaman berdasarkan kategori
function kategoriJudul($kategori) {
    $map = [
        'all' => 'All Menu',
        'pizza' => 'Pizza',
        'pasta' => 'Pasta',
        'nasi' => 'Nasi',
        'minuman' => 'Minuman',
    ];
    return $map[$kategori] ?? 'Menu';
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" crossorigin="anonymous">
  <title>Atil HUT</title>
</head>

<body>
 <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container d-flex align-items-center">
    <!-- Panah kiri -->
    <a href="../../portofolio_atil/index.php" style="color: white; text-decoration: none; font-size: 30px; font-weight: 900; margin-right: 15px; user-select: none; line-height: 1;">
      ⇐
    </a>

    <!-- Logo dan Judul -->
    <a class="navbar-brand d-flex align-items-center fw-bold mb-0" href="#" style="font-size: 22px;">
      <img src="img/logo.png" width="120" alt="Logo" class="mr-2" style="margin-right: 10px;">
      <?= kategoriJudul($kategori); ?>
    </a>

    <!-- Hamburger (untuk mobile) -->
    <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" 
      aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu navigasi -->
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav ml-auto">
        <a class="nav-item nav-link <?= ($kategori === 'all') ? 'active' : '' ?>" href="?kategori=all">All Menu</a>
        <a class="nav-item nav-link <?= ($kategori === 'pizza') ? 'active' : '' ?>" href="?kategori=pizza">Pizza</a>
        <a class="nav-item nav-link <?= ($kategori === 'pasta') ? 'active' : '' ?>" href="?kategori=pasta">Pasta</a>
        <a class="nav-item nav-link <?= ($kategori === 'nasi') ? 'active' : '' ?>" href="?kategori=nasi">Nasi</a>
        <a class="nav-item nav-link <?= ($kategori === 'minuman') ? 'active' : '' ?>" href="?kategori=minuman">Minuman</a>
      </div>
    </div>
  </div>
</nav>

  <!-- Konten -->
  <div class="container mt-3">
    <div class="row">
      <div class="col">
        <h1><?= kategoriJudul($kategori); ?></h1>
      </div>
    </div>

    <div class="row">
      <?php if (count($menu) > 0): ?>
        <?php foreach ($menu as $row) : ?>
          <div class="col-md-4">
            <div class="card mb-3">
              <img src="img/pizza/<?= htmlspecialchars($row["gambar"]); ?>" class="card-img-top" alt="<?= htmlspecialchars($row["nama"]); ?>">
              <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($row["nama"]); ?></h5>
                <p class="card-text"><?= htmlspecialchars($row["deskripsi"]); ?></p>
                <h5 class="card-title"><?= htmlspecialchars($row["harga"]); ?></h5>
                <a href="#" class="btn btn-primary">Pesan Sekarang</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col">
          <p class="text-muted">Menu untuk kategori "<?= htmlspecialchars($kategori); ?>" tidak ditemukan.</p>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <!-- Script -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>

</html>
