<ul class="nav nav-pills flex-column sidebar-nav">
    <li class="nav-item"><a class="nav-link <?= ($menuTitle == 'Home') ? 'active' : null ?>" href="home"><em class="fa fa-dashboard"></em> Home <span class="sr-only">(current)</span></a></li>
    <li class="nav-item"><a class="nav-link <?= (strpos($menuTitle, 'Tim')) ? 'active' : null ?>" href="tim"><em class="fa fa-users"></em> Data Tim</a></li>
    <li class="nav-item"><a class="nav-link <?= (strpos($menuTitle, 'Pengusaha')) ? 'active' : null ?>" href="pengusaha_lapangan"><em class="fa fa-dribbble"></em> Data Pengusaha Lapang</a></li>
    <li class="nav-item"><a class="nav-link <?= (strpos($menuTitle, 'Panitia')) ? 'active' : null ?>" href="panitia"><em class="fa fa-flag-o"></em> Data Panitia</a></li>
    <li class="nav-item"><a class="nav-link <?= (strpos($menuTitle, 'Klasemen')) ? 'active' : null ?>" href="klasemen"><em class="fa fa-sitemap"></em> Data Klasemen</a></li>
</ul>

<hr/>
<ul class="nav nav-pills flex-column sidebar-nav">
    <li class="nav-item"><a class="nav-link"  href="<?= base_url() ?>vendor/home"><em class="fa fa-dashboard"></em> Halaman Vendor</a></li>
    <li class="nav-item"><a class="nav-link"  href="<?= base_url() ?>commite/home"><em class="fa fa-calendar-o"></em> Halaman Panitia Event</a></li>
</ul>