function tampilkanSemuaMenu() {
  $.getJSON("data/pizza.json", function (data) {
    let menu = data.menu;
    $.each(menu, function (i, data) {
      $("#daftar-menu").append(
        '<div class="col-md-4"><div class="card mb-4" style="width: 18rem;"><img src="img/pizza' +
          data.gambar +
          '" class="card-img-top"><div class="card-body"><h5 class="card-title">' +
          data.nama +
          '</h5><p class="card-text">' +
          data.deskripsi +
          '</p><h5 class="card-title">' +
          data.harga +
          '</h5><a href="#" class="btn btn-primary">Pesan Sekarang</a></div></div></div>'
      );
    });
  });
}

tampilkanSemuaMenu();

$(".nav-item").on("click", function () {
  $(".nav-item").removeClass("active");
  $(this).addClass("active");

  let kategori = $(this).html();
  $("h1").html(kategori);

  if (kategori == "All Menu") {
    tampilkanSemuaMenu();
    return;
  }

  $.getJSON("data/pizza.json", function (data) {
    let menu = data.menu;
    let content = "";

    if (kategori == "All Menu") {
    }

    $.each(menu, function (i, data) {
      if (data.kategori == kategori.toLowerCase()) {
        content +=
          '<div class="col-md-4"><div class="card mb-4" style="width: 18rem;"><img src="img/pizza/' +
          data.gambar +
          '" class="card-img-top"><div class="card-body"><h5 class="card-title">' +
          data.nama +
          '</h5><p class="card-text">' +
          data.deskripsi +
          '</p><h5 class="card-title">' +
          data.harga +
          '</h5><a href="#" class="btn btn-primary">Pesan Sekarang</a></div></div></div>';
      }
    });
    $("#daftar-menu").html(content);
  });
});