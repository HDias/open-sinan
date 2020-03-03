<?php

// Home
Breadcrumbs::register('dashboard.index', function ($breadcrumbs) {
    $breadcrumbs->push('Painel', route('dashboard.index'));
});

include __DIR__ . '/cid_breadcrumbs.blade.php';


