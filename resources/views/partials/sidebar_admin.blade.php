
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
    <div id="sidebar-menu" class="sidebar-menu">
    <ul>
    <li class="menu-title">
    <span>Main Menu</span>
    </li>
    <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
        <a href="/dashboard"><i class="feather-grid"></i> <span>Beranda</span></a>
    </li>
    <li class="menu-title">
        <span>Master Data</span>
    </li>
    <li>
        <a href="index.html"><i class="fas fa-building"></i><span>Role Pengguna</span></a>
    </li>
    <li>
        <a href="index.html"><i class="fas fa-users"></i><span>Pengguna</span></a>
    </li>
    <li class="menu-title">
    <span>Managemen Absensi</span>
    </li>
    <li>
        <a href="index.html"><i class="fas fa-clock"></i><span>Jam Kerja</span></a>
    </li>
    <li>
        <a href="index.html"><i class="fas fa-fingerprint"></i><span>Mesin Fingerprint</span></a>
    </li>
    <li class="menu-title">
        <span>Laporan Absensi</span>
    </li>
    <li>
        <a href="index.html"><i class="fas fa-clipboard-list"></i><span>Laporan Absensi</span></a>
    </li>
    