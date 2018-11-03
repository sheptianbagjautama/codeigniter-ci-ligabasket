<ul class="nav nav-pills flex-column sidebar-nav">
    <li class="nav-item"><a class="nav-link <?= ($menuTitle == 'Home') ? 'active' : null ?>" href="<?= $modulUrl ?>/home"><em class="fa fa-dashboard"></em> Home <span class="sr-only">(current)</span></a></li>
    <li class="nav-item"><a class="nav-link <?= ($menuTitle == 'Data Lapangan') ? 'active' : null ?>" href="<?= $modulUrl ?>/data_lapangan"><em class="fa fa-hospital-o"></em> Data Lapangan</a></li>
    <li class="nav-item"><a class="nav-link <?= ($menuTitle == 'Jadwal Lapangan') ? 'active' : null ?>" href="<?= $modulUrl ?>/jadwal_lapangan"><em class="fa fa-cogs"></em> Kelola Jadwal Lapangan</a></li>
    <li class="nav-item"><a class="nav-link <?= ($menuTitle == 'Data Penyewaan') ? 'active' : null ?>" href="<?= $modulUrl ?>/data_penyewaan"><em class="fa fa-list"></em> Data Penyewaan</a></li>
    <li class="nav-item"><a class="nav-link <?= ($menuTitle == 'Konfirmasi Transfer') ? 'active' : null ?>" href="<?= $modulUrl ?>/konfirmasi_transfer"><em class="fa fa-files-o"></em> Konfirmasi Transfer</a></li>
</ul>

<hr/>

<?php if($this->ion_auth->in_group('admin')) { ?>
    <ul class="nav nav-pills flex-column sidebar-nav">
        <li class="nav-item"><a class="nav-link"  href="<?= base_url() ?>admin/home"><em class="fa fa-dashboard"></em> Halaman Admin</a></li>
        <li class="nav-item"><a class="nav-link"  href="<?= base_url() ?>commite/home"><em class="fa fa-calendar-o"></em> Halaman Panitia Event</a></li>
    </ul>
<?php } ?>