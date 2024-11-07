<!DOCTYPE html>
<html lang="en">
<head>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' rel='stylesheet'>
</head>
<body>
    <form action="../controller/enviarCodigo.php" method="POST">
        <h2>Recuperar contraseña</h2>
        <div>
            <label for="email">Correo electrónico</label>
            <input type="email" name="email" placeholder="Ingrese su correo" required>
        </div>
        <button type="submit">Enviar código</button>
    </form>
</body>
</html>
