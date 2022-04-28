<html>

<head>
    <title>Nota</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">
    <link rel="stylesheet" href="<?= base_url() ?>/template/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="<?= base_url() ?>/img/bmo.png" />
    <style>
        @page {
            size: A4 landscape;
        }
    </style>
</head>
<?php
$tanggal = date('d F Y');
$jam = date('h:i:s');
?>

<body style='font-family:tahoma; font-size:8pt;'>
    <style>
        hr {
            display: block;
            margin-top: 0.5em;
            margin-bottom: 0.5em;
            margin-left: auto;
            margin-right: auto;
            border-style: inset;
            border-width: 1px;
        }
    </style>
    <table style='width:100%; font-size:16pt; font-family:calibri; border-collapse: collapse;' border='0'>
        <tr>
            <td width="7%"><img src="<?= base_url('img/bmo.png') ?>" width="100%"></td>
            <td width='70%' align='LEFT' vertical-align:top'><span style='color:black;'>
                    <b>BALI MODE ON | KAPAL</b></br>JL. Kuta Bali No. 22</span></br>
                <span style='font-size:12pt'>Date. : <?= $tanggal ?>, <?= $jam ?></span></br>
            </td>
        </tr>
        <tr>
            <td colspan='5'>
                <hr>
            </td>
        </tr>
    </table>
    <table class="table table-striped table-lg">
        <tbody>
            <tr>
                <th width="1" class="text-center">NO</th>
                <th width="10" class="text-center">ID CUS</th>
                <th width="10" class="text-center">NAMA</th>
                <th width="10" class="text-center">NAMA KAPAL</th>
                <th width="10" class="text-center">TGL BOOKING</th>
                <th width="10" class="text-center">TGL SELESAI</th>
                <th width="15" class="text-center">HARGA</th>
                <th width="15" class="text-center">PERJAM</th>
                <th width="10" class="text-center">JUMLAH BAYAR</th>
                <th width="10" class="text-center">KODE BANK</th>
                <th width="10" class="text-center">STATUS KAPAL</th>
                <th width="10" class="text-center">STATUS PEMBAYARAN</th>
            </tr>
            <?php $no = 1; ?>
            <?php foreach ($transaksi as $key) : ?>
                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td class="text-center"><?= $key['customer'] ?></td>
                    <td><?= $key['nama'] ?></td>
                    <td><?= $key['dk_nama'] ?></td>
                    <td class="text-center"><?= date('d-m-Y', strtotime($key['tgl_booking'])) ?></td>
                    <td class="text-center"><?= date('d-m-Y', strtotime($key['tgl_selesai'])) ?></td>
                    <td class="text-right"><?= "Rp. " . number_format($key['harga_booking']) ?></td>
                    <td class="text-right"><?= "Rp. " . number_format($key['harga_perjam']) ?></td>
                    <td class="text-right"><?= "Rp. " . number_format($key['harga_bayar']) ?></td>
                    <td class="text-center"><?= $key['kode_bank'] ?></td>
                    <td class="text-center"><?php
                                            if ($key['status_kapal'] == "Booked") {
                                                echo "Ready / Standby";
                                            } elseif ($key['status_kapal'] == "Berlayar") {
                                                echo "Berlayar / Booked";
                                            } elseif ($key['status_kapal'] == "Kembali") {
                                                echo "Selesai";
                                            } ?></td>
                    <td class="text-center"><?php
                                            if ($key['status_pembayaran'] == "DP") {
                                                echo "Pembayaran Di DP";
                                            } elseif ($key['status_pembayaran'] == "Lunas") {
                                                echo "Pembayaran Lunas";
                                            } elseif ($key['status_pembayaran'] == "Belum") {
                                                echo "Belum DIbayar";
                                            } ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


</body>
<script>
    window.print();
    setTimeout(function() {
        window.location.href = "laporanBookingKapal";
    }, 3000);
</script>

</html>