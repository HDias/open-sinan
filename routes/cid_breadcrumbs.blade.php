<?php

// Permissions
Breadcrumbs::register('cid.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard.index');
    $breadcrumbs->push('Lista de CIDs', route('cid.index'));
});
Breadcrumbs::register('cid.create', function ($breadcrumbs) {
    $breadcrumbs->parent('cid.index');
    $breadcrumbs->push('Novo CID', route('cid.create'));
});
Breadcrumbs::register('cid.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('cid.index');
    $breadcrumbs->push('Editar CID', route('cid.edit', $id));
});
