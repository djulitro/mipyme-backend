<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Verificación de correo electrónico</title>
    <!-- Bootstrap CSS inline -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            padding: 30px;
        }
        h1 {
            color: #0d6efd;
            text-align: center;
        }
        h2 {
            color: #495057;
            text-align: center;
            margin-bottom: 20px;
        }
        p {
            color: #212529;
            font-size: 16px;
            line-height: 1.5;
            text-align: center;
        }
        .btn {
            display: inline-block;
            margin: 20px auto;
            padding: 12px 24px;
            background-color: #0d6efd;
            color: #ffffff !important;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            border-radius: 8px;
            text-align: center;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #6c757d;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>¡Hola! Bienvenido a <strong>miPyme</strong></h1>
        <h2>Por favor, verifica tu correo electrónico</h2>
        <p>
            Haz clic en el botón de abajo para verificar tu dirección de correo electrónico y activar tu cuenta.
        </p>
        <div style="text-align:center;">
            <a href="{{ $urlVerify }}" class="btn">Verificar correo electrónico</a>
        </div>
        <p>
            Si no creaste una cuenta, puedes ignorar este correo.
        </p>
        <div class="footer">
            &copy; {{ date('Y') }} miPyme. Todos los derechos reservados.
        </div>
    </div>
</body>
</html>
