<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

  <link rel="stylesheet" type="text/css" href="/css/style.css">
  <script src="/js/myjs.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@700&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/ee36d99e68.js" crossorigin="anonymous"></script>

  @yield('google-api')

  <title>touring-by</title>
</head>

<body>
  <div class="container-fluid zeroing-padding-margin bg-my-grey hw-100 main-wrapper  d-flex flex-column">
    <div class="nav-wrapper bg-header-blue d-flex justify-content-center">
      <nav class="navbar navbar-expand-md navbar-light w-100 bg-header-blue nav-half-space" style="max-width: 1300px;">
        <a class="navbar-brand d-flex" href="/admin/dashboard">
          <img src="https://plchldr.co/i/500x250" width="95" height="95" class="d-inline-block align-top nav-img" alt=""
            loading="lazy">
          <div class="d-inline-flex flex-column justify-content-center flex-grow-1 nav-title">
            <span class="title">Touring-by</span>
            <span class="">Administration</span>
          </div>
        </a>
        @auth
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
          aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse navbar-center" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-link" href="/admin/places">Places</a>
            <a class="nav-link" href="/admin/points">Points</a>
            <a class="nav-link" href="#">Tags</a>
          </div>
        </div>
        @endauth
      </nav>
    </div>

    <div class="container-xl zeroing-padding-margin bg-my-grey flex-grow-1">
      <div class="dashboard-wrapper">
        @yield('content')
      </div>
    </div>
  </div>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
  </script>
</body>

</html>