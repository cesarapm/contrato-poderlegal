<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview de Contratos - Poder Legal</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .header {
            background: white;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        
        .header h1 {
            color: #5b2c83;
            font-size: 32px;
            margin-bottom: 10px;
        }
        
        .header p {
            color: #666;
            font-size: 16px;
        }
        
        .info-box {
            background: #fff3cd;
            border: 2px solid #ffc107;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
        }
        
        .info-box h3 {
            color: #856404;
            margin-bottom: 10px;
            font-size: 18px;
        }
        
        .info-box ul {
            margin-left: 20px;
            color: #856404;
        }
        
        .info-box li {
            margin: 8px 0;
        }
        
        .info-box code {
            background: rgba(0,0,0,0.1);
            padding: 2px 8px;
            border-radius: 4px;
            font-family: 'Courier New', monospace;
        }
        
        .contracts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 20px;
        }
        
        .contract-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        
        .contract-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        
        .contract-card h3 {
            color: #5b2c83;
            font-size: 20px;
            margin-bottom: 8px;
        }
        
        .contract-card .folio {
            color: #999;
            font-size: 14px;
            margin-bottom: 20px;
        }
        
        .buttons {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s;
            border: 2px solid transparent;
        }
        
        .btn-html {
            background: #4CAF50;
            color: white;
        }
        
        .btn-html:hover {
            background: #45a049;
            transform: scale(1.02);
        }
        
        .btn-pdf {
            background: #2196F3;
            color: white;
        }
        
        .btn-pdf:hover {
            background: #0b7dda;
            transform: scale(1.02);
        }
        
        .btn-download {
            background: #FF9800;
            color: white;
        }
        
        .btn-download:hover {
            background: #e68900;
            transform: scale(1.02);
        }
        
        .btn::before {
            content: '';
            margin-right: 8px;
        }
        
        .btn-html::before {
            content: '📄';
        }
        
        .btn-pdf::before {
            content: '📋';
        }
        
        .btn-download::before {
            content: '⬇️';
        }
        
        .refresh-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background: #5b2c83;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            cursor: pointer;
            box-shadow: 0 5px 20px rgba(91, 44, 131, 0.4);
            transition: all 0.3s;
            text-decoration: none;
        }
        
        .refresh-btn:hover {
            transform: scale(1.1) rotate(180deg);
            box-shadow: 0 8px 30px rgba(91, 44, 131, 0.6);
        }
        
        @media (max-width: 768px) {
            .contracts-grid {
                grid-template-columns: 1fr;
            }
            
            .header h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔍 Preview de Contratos</h1>
            <p>Visualiza y edita contratos en tiempo real</p>
        </div>
        
        <div class="info-box">
            <h3>💡 ¿Cómo usar esta herramienta?</h3>
            <ul>
                <li><strong>Vista HTML:</strong> Ver el contrato como HTML puro (más rápido, ideal para editar la plantilla)</li>
                <li><strong>Vista PDF:</strong> Ver el contrato convertido a PDF en el navegador</li>
                <li><strong>Descargar PDF:</strong> Descargar el archivo PDF</li>
            </ul>
            <br>
            <p><strong>Flujo de trabajo recomendado:</strong></p>
            <ol style="margin-left: 20px; margin-top: 10px; color: #856404;">
                <li>Edita la plantilla en <code>resources/html/plantilla-contrato-arrendamiento.html</code></li>
                <li>Ejecuta: <code>php artisan db:seed --class=PlantillaArrendamientoProfesionalSeeder</code></li>
                <li>Recarga la página y haz clic en "Ver HTML" para ver cambios inmediatos</li>
                <li>Cuando esté bien, verifica con "Ver PDF" el resultado final</li>
            </ol>
        </div>
        
        <div class="contracts-grid">
            @forelse($contratos as $contrato)
            <div class="contract-card">
                <h3>Contrato #{{ $contrato->id }}</h3>
                <div class="folio">📋 {{ $contrato->folio }}</div>
                
                <div class="buttons">
                    <a href="{{ route('preview.contrato.html', $contrato->id) }}" 
                       class="btn btn-html" 
                       target="_blank">
                        Ver HTML
                    </a>
                    
                    <a href="{{ route('preview.contrato.pdf', $contrato->id) }}" 
                       class="btn btn-pdf" 
                       target="_blank">
                        Ver PDF
                    </a>
                    
                    <a href="{{ route('preview.contrato.download', $contrato->id) }}" 
                       class="btn btn-download">
                        Descargar PDF
                    </a>
                </div>
            </div>
            @empty
            <div class="contract-card">
                <h3>No hay contratos disponibles</h3>
                <p style="color: #999; margin-top: 10px;">
                    Crea un contrato desde el formulario o Filament para poder previsualizarlo aquí.
                </p>
            </div>
            @endforelse
        </div>
    </div>
    
    <a href="{{ route('preview.index') }}" class="refresh-btn" title="Recargar">
        🔄
    </a>
</body>
</html>
