<?php

use Illuminate\Support\Facades\Route;
use App\Models\Contrato;

Route::get('/', function () {
    return view('formulario.inicio');
});

Route::get('/contrato/confirmacion/{contrato}', function ($contrato) {
    $contratoData = Contrato::with(['tramitante', 'inmueble', 'arrendatarios', 'arrendadores'])->findOrFail($contrato);
    return view('formulario.confirmacion', ['contrato' => $contratoData]);
})->name('contrato.confirmacion');
