@extends('emails.plantillaCorreo')

@section('entidad', 'Institucion')

@section('contenidoCorreo')
    <h4>{{$details['mensaje']}}</h4>
    
  <!--Credenciales del usuario-->
        <p>Usuario: {{ $details['usuario'] }}</p>
            <p>Contraseña: {{ $details['contrasena'] }}</p>
            
<!--Informacion del proyecto y el estado que tiene-->
        <p>Proyecto: {{ $details['proyecto'] }}</p>
            <p>Estado: {{ $details['estado'] }}</p>
</body>
    
@endSection