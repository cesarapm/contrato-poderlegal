<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .header {
            background-color: #5b2c83;
            color: white;
            padding: 20px;
            border-radius: 5px 5px 0 0;
            text-align: center;
        }
        .content {
            padding: 20px;
            background-color: #f9f9f9;
        }
        .details {
            background-color: white;
            padding: 15px;
            border-left: 4px solid #5b2c83;
            margin: 15px 0;
        }
        .detail-row {
            display: flex;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .detail-label {
            font-weight: bold;
            width: 150px;
            color: #5b2c83;
        }
        .detail-value {
            flex: 1;
        }
        .button {
            display: inline-block;
            background-color: #5b2c83;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
            text-align: center;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #666;
            font-size: 12px;
            border-top: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Nuevo Contrato Creado</h1>
        </div>
        
        <div class="content">
            <p>¡Hola <strong>{{ $tramitante->nombre ?? 'Tramitante' }}</strong>!</p>
            
            <p>Se ha creado un nuevo contrato en el sistema.</p>
            
            <div class="details">
                <div class="detail-row">
                    <div class="detail-label">Folio:</div>
                    <div class="detail-value">{{ $folio }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Estado:</div>
                    <div class="detail-value">{{ $estado }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Fecha de Creación:</div>
                    <div class="detail-value">{{ $fechaCreacion }}</div>
                </div>
            </div>
            
            <div style="text-align: center;">
                <a href="{{ config('app.url') }}" class="button">Ver en el Sistema</a>
            </div>
            
            <p>Gracias por tu atención.</p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>
