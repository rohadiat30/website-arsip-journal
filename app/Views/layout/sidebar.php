<?php

use App\Controllers\home;
?>
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="<?= base_url('home') ?>" target="_blank">
            <img src="<?= base_url() ?>/template/assets/img/masterlogo.png" class="navbar-brand-img h-100 mb-1" alt="main_logo">
            <span class="ms-1 font-weight-bold text-white">Catra research Institute</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white" href="<?= base_url('home') ?>">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="<?= base_url('/ijess') ?>">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">compost</i>
                    </div>
                    <span class="nav-link-text ms-1">IJESS</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="<?= base_url('/jtep') ?>">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">policy</i>
                    </div>
                    <span class="nav-link-text ms-1">JTEP</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="<?= base_url('/ahjpm') ?>">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">local_library</i>
                    </div>
                    <span class="nav-link-text ms-1">AHJPM</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="<?= base_url('/jogta') ?>">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">account_balance</i>
                    </div>
                    <span class="nav-link-text ms-1">JOGTA</span>
                </a>
            </li>
        </ul>
    </div>
</aside>