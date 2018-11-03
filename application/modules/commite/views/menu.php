<ul class="nav nav-pills flex-column sidebar-nav">
  <li class="nav-item"><a class="nav-link <?= ($menuTitle == 'Home') ? 'active' : null ?>" href="<?= $modulUrl ?>/home"><em class="fa fa-dashboard"></em> Home <span class="sr-only">(current)</span></a></li>
  <li class="nav-item"><a class="nav-link <?= ($menuTitle == 'Data Event') ? 'active' : null ?>" href="<?= $modulUrl ?>/event"><em class="fa fa-calendar-o"></em> Data Event</a></li>
  <li class="nav-item"><a class="nav-link <?= ($menuTitle == 'Data Klasemen') ? 'active' : null ?>" href="<?= $modulUrl ?>/klasemen"><em class="fa fa-sitemap"></em> Data Klasemen</a></li>
  <li class="nav-item"><a class="nav-link <?= ($menuTitle == 'Data Team') ? 'active' : null ?>" href="<?= $modulUrl ?>/team"><em class="fa fa-users"></em> Data Team</a></li>

</ul>

<hr/>

<?php if($this->ion_auth->in_group('admin')) { ?>
    <ul class="nav nav-pills flex-column sidebar-nav">
        <li class="nav-item"><a class="nav-link"  href="<?= base_url() ?>admin/home"><em class="fa fa-dashboard"></em> Halaman Admin</a></li>
        <li class="nav-item"><a class="nav-link"  href="<?= base_url() ?>vendor/home"><em class="fa fa-calendar-o"></em> Halaman Vendor</a></li>
    </ul>
<?php } ?>