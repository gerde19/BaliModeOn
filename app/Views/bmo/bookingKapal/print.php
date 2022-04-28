<html>

<head>
    <title>Nota</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">
    <link rel="shortcut icon" href="<?= base_url() ?>/img/bmo.png" />
    <style>
        @page {
            size: A5 landscape;
        }

        #tabel {
            font-size: 15px;
            border-collapse: collapse;
        }

        #tabel td {
            padding-left: 5px;
            border: 1px solid black;
        }
    </style>
</head>
<?php
$tanggal = date('d F Y');
$jam = date('h:i:s');
?>

<body class="A5" style='font-family:tahoma; font-size:8pt;'>
    <?php foreach ($transaksi as $d) :
        $transaksi = $d['transaksi_id'];
        $nama = $d['nama'];
        $nama_kapal = $d['dk_nama'];
        $tgl_booking = $d['tgl_booking'];
        $tgl_selesai = $d['tgl_selesai'];
        $harga_booking = $d['harga_booking'];
        $harga_bayar = $d['harga_bayar'];
        $status_pembayaran = $d['status_pembayaran'];
    endforeach ?>
    <center>
        <table style='width:350px; font-size:16pt; font-family:calibri; border-collapse: collapse;' border='0'>
            <td><img src="<?= base_url('img/bmo.png') ?>" width="100"></td>
            <td width='70%' align='RIGHT' vertical-align:top'><span style='color:black;'>
                    <b>BALI MODE ON | KAPAL</b></br>JL. Kuta Bali No. 22</span></br>
                <span style='font-size:12pt'>No. : <?= $transaksi ?>, <?= $tanggal ?>, <?= $jam ?></span></br>
            </td>
        </table>
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
        <table cellspacing='0' cellpadding='0' style='width:350px; font-size:12pt; font-family:calibri;  border-collapse: collapse;' border='0'>

            <tr align='center'>
                <td colspan="5"></td>
            </tr>
            <tr>
                <td colspan='5'>
                    <hr>
                </td>
            </tr>
            <tr>
                <td>Kode Sewa</td>
                <td>:</td>
                <td colspan="3" style="text-align: right;"><?= $transaksi ?></td>
            </tr>
            <tr>
                <td>Nama Customer</td>
                <td>:</td>
                <td colspan="3" style="text-align: right;"><?= $nama ?></td>
            </tr>
            <tr>
                <td>Nama Kapal</td>
                <td>:</td>
                <td colspan="3" style="text-align: right;"><?= $nama_kapal ?></td>
            </tr>
            <tr>
                <td>Tanggal Booking</td>
                <td>:</td>
                <td colspan="3" style="text-align: right;"><?= date('d/m/Y', strtotime($tgl_booking)) ?></td>
            </tr>
            <tr>
                <td>Tanggal Selesai</td>
                <td>:</td>
                <td colspan="3" style="text-align: right;">
                    <?php
                    if ($tgl_selesai == "0000-00-00") {
                        echo "-";
                    } else {
                        echo date('d/m/Y', strtotime($tgl_selesai));
                    }
                    ?></td>
            </tr>
            <tr>
                <td>Harga Booking</td>
                <td>:</td>
                <td colspan="3" style="text-align: right;"><?= "Rp. " . number_format($harga_booking) ?></td>
            </tr>
            <tr>
                <td>Harga Bayar</td>
                <td>:</td>
                <td colspan="3" style="text-align: right;"><?= "Rp. " . number_format($harga_bayar) ?></td>
            </tr>
            <tr>
                <td>Status Pembayaran</td>
                <td>:</td>
                <td colspan="3" style="text-align: right;"><?= $status_pembayaran ?></td>
            </tr>
            <tr>
                <td colspan='5'>
                    <hr>
                </td>
            </tr>
        </table>
        <table style='width:350; font-size:12pt;' cellspacing='2'>
            <tr></br>
                <td align='center'>****** TERIMAKASIH ******</br></td>
            </tr>
        </table>
    </center>

</body>
<script>
    window.print();
</script>

</html>