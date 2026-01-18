<?php

use App\Livewire\BuscaProdutos;
use Illuminate\Support\Facades\Route;

Route::get('/', BuscaProdutos::class)->name('home');

