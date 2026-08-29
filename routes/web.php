<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::view('ui', 'ui.playground.overview')->name('ui.playground');
    Route::view('ui/foundations', 'ui.playground.foundations')->name('ui.playground.foundations');
    Route::view('ui/components', 'ui.playground.components')->name('ui.components');
    Route::view('ui/components/input', 'ui.playground.components.input')->name('ui.components.input');
    Route::view('ui/forms', 'ui.playground.forms')->name('ui.playground.forms');
    Route::view('ui/data-display', 'ui.playground.data-display')->name('ui.playground.data-display');
    Route::view('ui/navigation', 'ui.playground.navigation')->name('ui.playground.navigation');
    Route::view('ui/interaction', 'ui.playground.interaction')->name('ui.playground.interaction');
    Route::view('ui/application', 'ui.playground.application')->name('ui.playground.application');
    Route::view('ui/blocks', 'ui.playground.blocks')->name('ui.playground.blocks');
    Route::view('ui/authentication', 'ui.playground.authentication')->name('ui.playground.authentication');

});

require __DIR__.'/settings.php';
