function searchMovies(keyword) {
  $('#movie-list').html('');

  if (keyword === '') {
    $('#recommended-container').show();
    $('#movie-list').hide();
    loadRecommendedMovies();
    return;
  }

  $('#recommended-container').hide();
  $('#movie-list').show();

  $.ajax({
    url: 'https://www.omdbapi.com',
    type: 'get',
    dataType: 'json',
    data: {
      apikey: '73c64296',
      s: keyword
    },
    success: function (response) {
      if (response.Response === "True") {
        const movies = response.Search;
        $('#movie-list').html('');
        movies.forEach(movie => {
          $('#movie-list').append(`
            <div class="col-md-3 mb-3">
              <div class="card">
                <img src="${movie.Poster !== "N/A" ? movie.Poster : 'https://via.placeholder.com/300x450?text=No+Image'}" class="card-img-top" alt="${movie.Title}">
                <div class="card-body">
                  <h5 class="card-title">${movie.Title}</h5>
                  <h6 class="card-subtitle mb-2 text-muted">${movie.Year}</h6>
                  <a href="#" class="see-detail text-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="${movie.imdbID}">See Detail</a>
                </div>
              </div>
            </div>
          `);
        });
      } else {
        $('#movie-list').html(`<p class="text-center">Movie not found!</p>`);
        $('#recommended-container').show();
      }
    },
    error: function () {
      $('#movie-list').html(`<p class="text-center text-danger">Failed to fetch data!</p>`);
      $('#recommended-container').show();
    }
  });
}

// ✅ Event handler tombol "See Detail"
$(document).on('click', '.see-detail', function () {
  const imdbID = $(this).data('id');

  // 🔒 Cegah request kalau imdbID kosong/null/undefined
if (!imdbID || typeof imdbID !== 'string' || imdbID.trim() === '') {
  console.warn('IMDb ID kosong, permintaan dibatalkan.');
  return;
}

$.ajax({
  url: 'https://www.omdbapi.com',
  type: 'get',
  dataType: 'json',
  data: {
    apikey: '73c64296',
    i: imdbID
  },
  success: function (movie) {
    if (movie.Response === "True") {
      $('.modal-body').html(`
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-4">
              <img src="${movie.Poster !== "N/A" ? movie.Poster : 'https://via.placeholder.com/300x450?text=No+Image'}" class="img-fluid" alt="${movie.Title}">
            </div>
            <div class="col-md-8">
              <ul class="list-group">
                <li class="list-group-item"><h4>${movie.Title}</h4></li>
                <li class="list-group-item">Released: ${movie.Released}</li>
                <li class="list-group-item">Genre: ${movie.Genre}</li>
                <li class="list-group-item">Director: ${movie.Director}</li>
                <li class="list-group-item">Actors: ${movie.Actors}</li>
              </ul>
            </div>
          </div>
        </div>
      `);
    } else {
      $('#movie-list').html(`
        <div class="col-12">
          <p class="text-center text-danger fw-bold my-4">Movie not found!</p>
        </div>
      `);
      // Jangan tampilkan rekomendasi ulang saat tidak ditemukan hasil
    }
  },
 error: function() {
  $('.modal-body').html(`<p class="text-danger">Gagal mengambil data detail movie.</p>`);
}
}
});