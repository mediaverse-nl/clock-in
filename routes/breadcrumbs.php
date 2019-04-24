<?php

// admin > dashboard
Breadcrumbs::register('super.dashboard', function($breadcrumbs)
{
    $breadcrumbs->push('Dashboard', route('super.dashboard'));
});

// dashboard > business
Breadcrumbs::register('super.business.index', function($breadcrumbs)
{
    $breadcrumbs->parent('super.dashboard');
    $breadcrumbs->push('Business', route('super.business.index'));
});

// dashboard > business > edit
Breadcrumbs::register('super.business.edit', function($breadcrumbs, $modal)
{
    $breadcrumbs->parent('super.business.index');
    $breadcrumbs->push('#'.$modal->id, route('super.business.edit', $modal->id));
});

// dashboard > business > edit > location
Breadcrumbs::register('super.location.edit', function($breadcrumbs, $modal)
{
    $breadcrumbs->parent('super.business.edit', $modal->business);
    $breadcrumbs->push($modal->fulAddress, route('super.business.edit', $modal->id));
});