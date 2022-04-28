<li class="menu-header">Dashboard</li>
<li><a href="<?= site_url() ?>" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>
<?php
if (session()->get('user_level') == "admin") {
?>
    <li class="menu-header">Data</li>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Kode</span></a>
        <ul class="dropdown-menu">
            <li><a class="nav-link" href="<?= site_url('kodeKapal') ?>">Kapal</a></li>
            <li><a class="nav-link" href="<?= site_url('kodeMobil') ?>">Mobil</a></li>
            <li><a class="nav-link" href="<?= site_url('kodeKamar') ?>">Kamar</a></li>
        </ul>
    </li>
    <li><a class="nav-link" href="<?= site_url('detailKapal') ?>"><i class="fas fa-ship"></i> <span>Harga Sewa</span></a></li>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i> <span>User</span></a>
        <ul class="dropdown-menu">
            <li><a class="nav-link" href="<?= site_url('anggota') ?>">Aggota</a></li>
            <li><a class="nav-link" href="<?= site_url('customer') ?>">Customer</a></li>
        </ul>
    </li>
    <li><a class="nav-link" href="<?= site_url('kalender') ?>"><i class="far fa-calendar-alt"></i> <span>Kalender</span></a></li>
<?php } else {
} ?>

<!-- KAPAL -->
<li class="menu-header">Kapal</li>
<li class="nav-item dropdown">
    <a href="#" class="nav-link has-dropdown"><i class="far fa-calendar-check"></i> <span>Booking</span></a>
    <ul class="dropdown-menu">
        <li><a class="nav-link beep beep-sidebar" href="<?= site_url('bookingKapal') ?>">Daftar Booking</a></li>
        <li><a class="nav-link" href="<?= site_url('laporanBookingKapal') ?>">Laporan Booking</a></li>
    </ul>
</li>
<li class="nav-item dropdown">
    <a href="#" class="nav-link has-dropdown"><i class="fas fa-clipboard-list"></i> <span>Laporan Kegiatan</span></a>
    <ul class="dropdown-menu">
        <li><a href="<?= site_url() ?>">Kegiatan Harian</a></li>
        <li><a href="<?= site_url() ?>">Kegiatan Bulanan</a></li>
    </ul>
</li>
<li class="nav-item dropdown">
    <a href="#" class="nav-link has-dropdown"><i class="fas fa-tasks"></i> <span>Checklist</span></a>
    <ul class="dropdown-menu">
        <li><a class="nav-link" href="<?= site_url() ?>">Checklist Harian</a></li>
        <li><a class="nav-link" href="<?= site_url() ?>">Checklist Bulanan</a></li>
        <li><a class="nav-link" href="<?= site_url() ?>">Laporan Checklist</a></li>
    </ul>
</li>
<li class="nav-item dropdown">
    <a href="#" class="nav-link has-dropdown"><i class="fas fa-gas-pump"></i> <span>Pemakaian Solar</span></a>
    <ul class="dropdown-menu">
        <li><a class="nav-link" href="<?= site_url() ?>">Laporan Harian</a></li>
        <li><a class="nav-link" href="<?= site_url() ?>">Laporan Bulanan</a></li>
    </ul>
</li>
<li class="nav-item dropdown">
    <a href="#" class="nav-link has-dropdown"><i class="fas fa-chart-line"></i> <span>Laporan Keuangan</span></a>
    <ul class="dropdown-menu">
        <li><a class="nav-link" href="<?= site_url() ?>">Laporan Harian</a></li>
        <li><a class="nav-link" href="<?= site_url() ?>">Laporan Bulanan</a></li>
    </ul>
</li>

<!-- HOTEL -->
<!-- <li class="menu-header">Hotel</li>
<li class="nav-item dropdown">
    <a href="#" class="nav-link has-dropdown"><i class="far fa-calendar-check"></i> <span>Booking</span></a>
    <ul class="dropdown-menu">
        <li><a href="<?= site_url() ?>">Tambah Booking</a></li>
        <li><a href="<?= site_url() ?>">Daftar Booking</a></li>
        <li><a class="beep beep-sidebar" href="<?= site_url() ?>">Laporan Booking</a></li>
    </ul>
</li>
<li><a class="nav-link" href=""><i class="fas fa-hotel"></i> <span>Harga Kamar</span></a></li>
<li class="nav-item dropdown">
    <a href="<?= site_url() ?>" class="nav-link has-dropdown"><i class="fas fa-tasks"></i> <span>Laporan Tamu</span></a>
    <ul class="dropdown-menu">
        <li><a class="nav-link" href="<?= site_url() ?>">Daftar Tamu</a></li>
        <li><a class="nav-link" href="<?= site_url() ?>">Laporan Masalah</a></li>
        <li><a class="nav-link" href="<?= site_url() ?>">Laporan Layanan</a></li>
    </ul>
</li>
<li class="nav-item dropdown">
    <a href="#" class="nav-link has-dropdown"><i class="fas fa-tasks"></i> <span>Checklist Kamar</span></a>
    <ul class="dropdown-menu">
        <li><a class="nav-link" href="<?= site_url() ?>">Checklist Kamar</a></li>
        <li><a class="nav-link" href="<?= site_url() ?>">Laporan Checklist</a></li>
    </ul>
</li>
<li class="nav-item dropdown">
    <a href="#" class="nav-link has-dropdown"><i class="fas fa-broom"></i> <span>Laporan Kegiatan OB</span></a>
    <ul class="dropdown-menu">
        <li><a class="nav-link" href="<?= site_url() ?>">Laporan Harian</a></li>
        <li><a class="nav-link" href="<?= site_url() ?>">Laporan Alat</a></li>
    </ul>
</li>
<li class="nav-item dropdown">
    <a href="#" class="nav-link has-dropdown"><i class="fas fa-ellipsis-h"></i> <span>Utilities</span></a>
    <ul class="dropdown-menu">
        <li><a href="<?= site_url() ?>">Contact</a></li>
        <li><a class="nav-link" href="<?= site_url() ?>">Invoice</a></li>
        <li><a href="<?= site_url() ?>">Subscribe</a></li>
    </ul>
</li>
<li><a class="nav-link" href="<?= site_url() ?>"><i class="fas fa-pencil-ruler"></i> <span>Credits</span></a></li> -->