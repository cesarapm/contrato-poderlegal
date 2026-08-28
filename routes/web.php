<?php

use Illuminate\Support\Facades\Route;
use App\Models\Contrato;
use App\Http\Controllers\PreviewContratoController;

Route::get('/', function () {
    return view('formulario.inicio');
});

Route::get('/contrato/confirmacion/{contrato}', function ($contrato) {
    $contratoData = Contrato::with(['tramitante', 'inmueble', 'arrendatarios', 'arrendadores'])->findOrFail($contrato);
    return view('formulario.confirmacion', ['contrato' => $contratoData]);
})->name('contrato.confirmacion');

// Rutas de preview para desarrollo
Route::get('/preview', [PreviewContratoController::class, 'index'])
    ->name('preview.index');

Route::get('/preview/contrato/{contrato}/html', [PreviewContratoController::class, 'previewHtml'])
    ->name('preview.contrato.html');

Route::get('/preview/contrato/{contrato}/pdf', [PreviewContratoController::class, 'previewPdf'])
    ->name('preview.contrato.pdf');

Route::get('/preview/contrato/{contrato}/download', [PreviewContratoController::class, 'downloadPdf'])
    ->name('preview.contrato.download');
