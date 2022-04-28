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
    <link href="<?= base_url() ?>/user/dist/css/product.css" rel="stylesheet">
    <link href="<?= base_url() ?>/user/css/home.css" rel="stylesheet">
    <style>

    </style>
</head>

<body>

    <header class="site-header sticky-top py-1 bg-success bg-opacity-50">
        <nav class="container d-flex flex-column flex-md-row justify-content-between">
            <a class="py-2" href="#" aria-label="Product">
                <!-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="d-block mx-auto" role="img" viewBox="0 0 24 24">
                    <title>Product</title>
                    <circle cx="12" cy="12" r="10" />
                    <path d="M14.31 8l5.74 9.94M9.69 8h11.48M7.38 12l5.74-9.94M9.69 16L3.95 6.06M14.31 16H2.83m13.79-4l-5.74 9.94" />
                </svg> -->
                <img src="<?= base_url() ?>/img/bmot.png" width="50">
            </a>
            <a class="py-2 d-none d-md-inline-block underline text-dark" href="#">Home</a>
            <a class="py-2 d-none d-md-inline-block underline text-dark" href="#">Booking</a>
            <a class="py-2 d-none d-md-inline-block underline text-dark" href="#">About Us</a>
            <a class="py-2 d-none d-md-inline-block underline text-dark" href="#">Contact</a>
            <a class="py-2 d-none d-md-inline-block underline text-dark" href="#">Login</a>
        </nav>
    </header>

    <main>

        <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center">
            <div class="col-md-5 p-lg-5 mx-auto my-5">
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

                    <?php foreach ($detailKapal as $key) : ?>
                        <div class="col">
                            <div class="card shadow-sm">
                                <!-- <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                                <title>Placeholder</title>
                                <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
                            </svg> -->
                                <img src="<?= base_url('kapal/detail/' . $key['dk_gambar']) ?>" width="100%" height="225">
                                <div class="card-body">
                                    <h2 class="text-center"><?= $key['dk_nama'] ?></h2>
                                    <table class="table table-striped table-md">
                                        <tbody>
                                            <tr>
                                                <td>Kapasitas</td>
                                                <td>:</td>
                                                <td><?= $key['dk_kapasitas'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Mesin</td>
                                                <td>:</td>
                                                <td class="text-right" style="font-size: 10pt;"><?= $key['dk_mesin'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Weekday</td>
                                                <td>:</td>
                                                <td><?= "Rp. " . number_format($key['dk_day']) ?></td>
                                            </tr>
                                            <tr>
                                                <td>Weekend</td>
                                                <td>:</td>
                                                <td><?= "Rp. " . number_format($key['dk_end']) ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted"></small>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-success">Pesan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>

    </main>

    <footer class="text-muted py-5 bg-success bg-opacity-50">
        <div class="container">
            <p class="float-end mb-1">
                <a href="#">Back to top</a>
            </p>
            <p class="mb-1">Album example is &copy; Bootstrap, but please download and customize it for yourself!</p>
            <p class="mb-0">New to Bootstrap? <a href="/">Visit the homepage</a> or read our <a href="/docs/5.1/getting-started/introduction/">getting started guide</a>.</p>
        </div>
    </footer>


    <script src="<?= base_url() ?>/user/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


</body>

</html>