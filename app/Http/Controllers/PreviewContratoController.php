<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Services\GeneradorContratoPdf;
use Barryvdh\DomPDF\Facade\Pdf;

class PreviewContratoController extends Controller
{
    /**
     * Muestra la página principal con todos los contratos disponibles
     */
    public function index()
    {
        $contratos = Contrato::with(['arrendadores', 'arrendatarios'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('preview.index', ['contratos' => $contratos]);
    }

    /**
     * Muestra el HTML del contrato (con footer HTML visible)
     */
    public function previewHtml(Contrato $contrato)
    {
        $contrato->load(['plantilla', 'arrendadores', 'arrendatarios', 'inmueble', 'fiador', 'tramitante']);

        $plantilla = $contrato->plantilla
            ?? \App\Models\PlantillaContrato::where('slug', 'contrato-arrendamiento-profesional')->first()
            ?? \App\Models\PlantillaContrato::where('slug', 'contrato-arrendamiento-ultimo')->first();

        if (!$plantilla) {
            return response('<h1>Error: No se encontró la plantilla</h1>', 500);
        }

        $html = $plantilla->contenido_html;

        $generador = app(GeneradorContratoPdf::class);
        $reflection = new \ReflectionClass($generador);
        $method = $reflection->getMethod('construirVariables');
        $method->setAccessible(true);
        $variables = $method->invoke($generador, $contrato);

        foreach ($variables as $clave => $valor) {
            $html = str_replace('{{' . $clave . '}}', $valor ?? '', $html);
        }

        return response($html)->header('Content-Type', 'text/html; charset=UTF-8');
    }

    /**
     * Muestra el PDF en el navegador (con footer en canvas + página)
     */
    public function previewPdf(Contrato $contrato)
    {
        return $this->generarPdfConFooter($contrato, 'inline');
    }

    /**
     * Descarga el PDF (con footer en canvas + página)
     */
    public function downloadPdf(Contrato $contrato)
    {
        return $this->generarPdfConFooter($contrato, 'attachment');
    }

    /**
     * Método privado: genera PDF con footer HTML
     */
    private function generarPdfConFooter(Contrato $contrato, string $disposition = 'inline')
    {
        $contrato->load(['plantilla', 'arrendadores', 'arrendatarios', 'inmueble', 'fiador', 'tramitante']);

        $plantilla = $contrato->plantilla
            ?? \App\Models\PlantillaContrato::where('slug', 'contrato-arrendamiento-profesional')->first()
            ?? \App\Models\PlantillaContrato::where('slug', 'contrato-arrendamiento-ultimo')->first();

        if (!$plantilla) {
            return response('<h1>Error: No se encontró la plantilla</h1>', 500);
        }

        $html = $plantilla->contenido_html;

        $generador = app(GeneradorContratoPdf::class);
        $reflection = new \ReflectionClass($generador);
        $method = $reflection->getMethod('construirVariables');
        $method->setAccessible(true);
        $variables = $method->invoke($generador, $contrato);

        foreach ($variables as $clave => $valor) {
            $html = str_replace('{{' . $clave . '}}', $valor ?? '', $html);
        }

        $pdf = Pdf::loadHTML($html)
            ->setPaper('letter', 'portrait')
            ->setOptions([
                'defaultFont'     => 'serif',
                'isRemoteEnabled' => false,
                'dpi'             => 150,
            ]);

        // PRIMERO render() para que _pages se llene
        $pdf->render();

        // DESPUÉS page_text() — así processPageScript() itera sobre TODAS las páginas
        $dompdf = $pdf->getDomPDF();
        $canvas = $dompdf->getCanvas();
        $font = $dompdf->getFontMetrics()->getFont('Helvetica', 'bold');
        $purple = [91 / 255, 44 / 255, 131 / 255];

        $canvas->page_text(45,  765, 'www.poderlegal.mx',          $font, 8, $purple);
        $canvas->page_text(510, 765, '{PAGE_NUM} de {PAGE_COUNT}', $font, 8, $purple);

        return response(
            $pdf->output(),
            200,
            [
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => $disposition . '; filename="' . $contrato->folio . '.pdf"',
            ]
        );
    }
}
