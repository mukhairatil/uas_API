<?php

function get_CURL($url)
{
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
  $result = curl_exec ($curl);
  curl_close($curl);
  
  return json_decode ($result, true);
  
  
}

$result = get_CURL ('https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=UC_qiXx-3t4Ev2EinteL3OAw&key=AIzaSyAoCv-dBIjagpMtmG0p7K8-DOWa4kLIDsY');


$youtubeProfilePic = $result ['items'][0]['snippet']['thumbnails']['medium']['url'];
$channelName =  $result ['items'][0]['snippet']['title'];
$subscriber = $result ['items'][0]['statistics']['subscriberCount'];

//vid terakhir
$urlLatestVideo = ('https://www.googleapis.com/youtube/v3/search?key=AIzaSyAoCv-dBIjagpMtmG0p7K8-DOWa4kLIDsY&channelId=UC_qiXx-3t4Ev2EinteL3OAw&maxResults=1&order=date&part=snippet');
$result = get_CURL($urlLatestVideo);
//var_dump($result);
$latestVideoId = $result['items'][0]['id']['videoId'];

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <!-- My CSS -->
    <link rel="stylesheet" href="style.css">

    <title>My Portfolio</title>
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background: linear-gradient(to right, #4facfe, #00f2fe);">
      <div class="container">
        <a class="navbar-brand" href="#home">Mukhairatil Afkar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="#home">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#about">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#portfolio">Portfolio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../wpu_movie/index.html">Film</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>


    <section class="hero text-white d-flex align-items-center" style="height: 100vh; background: linear-gradient(to right, #4facfe, #00f2fe);">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6 text-center text-md-left">
        <h1 class="display-4 font-weight-bold">I am Mukhairatil Afkar</h1>
        <h2 class="h4 mb-4">Mahasiswi Sistem Informasi</h2>
        <p class="mb-4">Saya suka mengeksplorasi teknologi baru dan belajar dari pengalaman. Mari kita terhubung!</p>
        <a href="#portfolio" class="btn btn-outline-light btn-lg rounded-pill">View Portfolio</a>
      </div>
      <div class="col-md-6 text-center">
       <img src="img/profile.jpg" alt="Afkar" class="rounded-circle img-thumbnail" style="max-height: 400px;">
      </div>
    </div>
  </div>
</section>


    <!-- About -->
    <section class="about py-5" id="about">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6 text-center">
        <img src="img/about.jpeg" class="img-fluid" alt="About Image" style="max-width: 80%;">
      </div>
      <div class="col-md-6">
        <h2 class="display-4 font-weight-bold">ABOUT ME</h2>
        <p>Halo! Saya Mukhairatil Afkar, seorang mahasiswi yang sedang menempuh studi di jurusan Sistem Informasi. Saya orang yang suka mencoba hal-hal baru dan semangat dalam menghadapi tantangan. Di kampus, saya belajar banyak hal, termasuk bagaimana bekerja dalam tim dan berkomunikasi dengan baik.</p>
        <p>Di luar kuliah, saya suka mendengarkan musik, nonton film, dan explore teknologi baru. Saya percaya bahwa belajar tidak hanya di kelas, tapi juga lewat pengalaman dan interaksi sehari-hari. Harapan saya ke depannya, saya bisa menjadi pribadi yang lebih percaya diri dan bermanfaat bagi orang lain.</p>
      </div>
    </div>
  </div>
</section>

    <!-- you tube dan ig -->
     <section class="social" style="background: linear-gradient(to right, #4facfe, #00f2fe);" id="social">
      <div class="container">
        <div class = "row pt-4 mb-4">
          <div class = "col text-center">
            <h2 style="color: white;">Social Media</h2>
          </div>
        </div>

        <div class="row justify-content-center g-4">
          <div class = "col-md-5">
          <div class="row">
            <div class="col-md-4">
              <img src = "<?= $youtubeProfilePic; ?>" width="200" class = "rounded-circle img-thumbnail">
            </div>
            <div class="col-md-8">
              <h5 style="color: white;"><?= $channelName; ?></h5>
              <ps tyle="color: white;"><?= $subscriber; ?> Subscriber</p>
              <div class="g-ytsubscribe" data-channelid="UC_qiXx-3t4Ev2EinteL3OAw" data-layout="default" data-count="hidden"></div>
          </div>
        </div>
        <div class = "row mt-3 pb-3">
          <div class = "col">
        <div class="embed-responsive embed-responsive-16by9">
          <iframe class="embed-responsive-item"
            src="https://www.youtube.com/embed/<?= $latestVideoId ?>?rel=0"
            title="YouTube video" allowfullscreen></iframe>
        </div>
      </div>
      </div>
      </div>      
         <div class="col-md-5">
  <div class="row">
    <div class="col-md-4">
      <img src="img/profile1.png" class="rounded-circle img-thumbnail" width="200">
    </div>
    <div class="col-md-8">
      <h5 style="color: white;">@atil</h5>
      <p style="color: white;">70000 Followers</p>
    </div>
  </div>

  <!-- Tambahkan tulisan di sini -->
  <h6 style="color: white;" class="mt-3">Instagram Feed</h6>

  <!-- Galeri Instagram -->
  <div class="row mt-1">
    <div class="col-4 p-1">
      <img src="img/thumbs/1.png" class="img-fluid rounded" alt="IG1">
    </div>
    <div class="col-4 p-1">
      <img src="img/thumbs/2.png" class="img-fluid rounded" alt="IG2">
    </div>
    <div class="col-4 p-1">
      <img src="img/thumbs/3.png" class="img-fluid rounded" alt="IG3">
    </div>
  </div>
</div>

  </div>
</div>

                        </div>
                      </div>
                    </div>
                  </div>
              </div>
            </section>


    <!-- Portfolio -->
    <section class="portfolio" id="portfolio">
      <div class="container">
        <div class="row pt-4 mb-4">
          <div class="col text-center">
            <h2>Portfolio</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md mb-4">
            <div class="card">
              <img class="card-img-top" src="img/thumbs/1.png" alt="Card image cap">
              <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div>

          <div class="col-md mb-4">
            <div class="card">
              <img class="card-img-top" src="img/thumbs/2.png" alt="Card image cap">
              <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div>

          <div class="col-md mb-4">
            <div class="card">
              <img class="card-img-top" src="img/thumbs/3.png" alt="Card image cap">
              <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div>   
        </div>

        <div class="row">
          <div class="col-md mb-4">
            <div class="card">
              <img class="card-img-top" src="img/thumbs/4.png" alt="Card image cap">
              <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div> 
          <div class="col-md mb-4">
            <div class="card">
              <img class="card-img-top" src="img/thumbs/5.png" alt="Card image cap">
              <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.
                </p>
              </div>
            </div>
          </div>

          <div class="col-md mb-4">
            <div class="card">
              <img class="card-img-top" src="img/thumbs/6.png" alt="Card image cap">
              <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


    <!-- Contact -->
    <section class="contact bg-light" id="contact">
      <div class="container">
        <div class="row pt-4 mb-4">
          <div class="col text-center">
            <h2>Contact</h2>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-4">
            <div class="card bg-primary text-white mb-4 text-center">
              <div class="card-body">
                <h5 class="card-title">Contact Me</h5>
                <p class="card-text">0882-7186-6892</p>
              </div>
            </div>
            
            <ul class="list-group mb-4">
              <li class="list-group-item"><h3>Location</h3></li>
              <li class="list-group-item">UIN IMAM BONJOL PADANG</li>
              <li class="list-group-item">Sungai Bangek</li>
              <li class="list-group-item">West Sumatra, Indonesia</li>
            </ul>
          </div>

          <div class="col-lg-6">
            
            <form id="contact-form">
              <div class="modal fade" id="thankYouModal" tabindex="-1" role="dialog" aria-labelledby="thankYouModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content text-center">
      <div class="modal-header">
        <h5 class="modal-title w-100" id="thankYouModalLabel">Pesan Terkirim</h5>
      </div>
      <div class="modal-body">
        Terima kasih atas pesan Anda!
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
              <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama">
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email">
              </div>
              <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" class="form-control" id="phone">
              </div>
              <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" id="message" rows="3"></textarea>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary">Send Message</button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </section>


    <!-- footer -->
    <footer class="text-white mt-5" style="background: linear-gradient(to right, #4facfe, #00f2fe);">
      <div class="container">
        <div class="row">
          <div class="col text-center">
            <p>Copyright &copy; 2025.</p>
          </div>
        </div>
      </div>
    </footer>







    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script src="https://apis.google.com/js/platform.js"></script>

    <script>
  $(document).ready(function () {
    $('#contact-form').on('submit', function (e) {
      e.preventDefault();
      $('#thankYouModal').modal('show'); // Tampilkan modal Bootstrap
      this.reset(); // Reset form
    });
  });
</script>

</body>
</html>


  </body>
</html>