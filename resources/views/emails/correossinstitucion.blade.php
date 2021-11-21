<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <h1>Confirmacion de peticion de servicio social</h1>
    <!--Informacion del proyecto y el estado que tiene-->
        <p>Proyecto: {{ $details['nombre'] }}</p>
            <p>Estado: {{ $details['estado'] }}</p>

  <!--Credenciales del usuario-->
        <p>Usuario: {{ $details['usuario'] }}</p>
            <p>Contraseña: {{ $details['contrasena'] }}</p>
</body>
</html>