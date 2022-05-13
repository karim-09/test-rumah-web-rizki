<aside class="main-sidebar sidebar-light-info elevation-4">
    <a href="<?= base_url() ?>" class="brand-link">
        <span
            class="brand-text font-weight-light "><?= substr($this->get_profil['firstName'].' '.$this->get_profil['lastName'], 0, 17); ?></span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?= base_url('dashboard') ?>" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

<script>
var url = window.location.href.split("?")[0];
url.hash = "";
var cekt = url.substring(url.lastIndexOf('/') + 1);
if (cekt == 'tambah' || cekt == 'edit' || cekt == 'detail') {
    url = url.substring(0, url.lastIndexOf('/'));
}
$('ul.nav-sidebar a').filter(function() {
    return this.href == url;
}).addClass('active');

$('ul.nav-treeview a').filter(function() {
    return this.href == url;
}).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
</script>