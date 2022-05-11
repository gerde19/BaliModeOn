<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- General CSS Files -->
    <link href="<?= base_url() ?>/user/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="shortcut icon" href="<?= base_url() ?>/img/bmo.png" />
    <link href="<?= base_url() ?>/user/dist/css/headers.css" rel="stylesheet">
    <link href="<?= base_url() ?>/user/css/home.css" rel="stylesheet">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .active {
            text-decoration: underline solid rgb(255, 255, 255) 25%;
        }
    </style>
</head>

<body>

    <div class="border-bottom fixed-top bg-secondary">
        <header class="container d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-2 mb-1">
            <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
                <!-- <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                    <use xlink:href="#bootstrap" />
                </svg> -->
                <img class="img" src="<?= base_url() ?>/img/bmotw.png" width="70">
            </a>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="<?= site_url() ?>" class="nav-link px-2 link-light">Home</a></li>
                <li><a href="<?= site_url('booking') ?>" class="nav-link px-2 link-light active">Booking</a></li>
                <li><a href="#" class="nav-link px-2 link-light">About</a></li>
                <li><a href="#" class="nav-link px-2 link-light">Contact</a></li>
            </ul>

            <div class="col-md-3 text-end">
                <button type="button" class="btn btn-outline-light me-2">Login</button>
                <button type="button" class="btn btn-outline-light">Sign-up</button>
            </div>
        </header>
    </div>


    <main>
        <div class="position-relative overflow-hidden p-1 p-md-5 m-md-3 text-center">
            <div class="col-md-5 p-lg-2 mx-auto my-2">
                <img src="<?= base_url() ?>/img/bmo.png" width="150">
                <h1 class="display-4 fw-normal">BALI MODE ON</h1>
                <p class="lead fw-normal">Memberikan pengalaman yang sangat menyenangkan dan tentunya menghibur untuk liburan anda dan keluarga anda.</p>
                <a class="btn btn-outline-success" href="#">Pesan Sekarang</a>
            </div>
            <div class="product-device d-none d-md-block"></div>
            <div class="product-device product-device-2 d-none d-md-block"></div>
        </div>

        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">


                </div>
            </div>
        </div>

    </main>

    <footer class="text-muted py-5 bg-light">
        <div class="container">
            <p class="float-end mb-1">
                <a href="#">Back to top</a>
            </p>
            <p class="mb-1">Bali Mode On &copy; 2022</p>
        </div>
    </footer>

    <script src="<?= base_url() ?>/user/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


</body>

</html>