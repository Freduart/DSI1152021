@extends('emails.plantillaCorreo')

@section('entidad', 'Estudiante')

@section('contenidoCorreo')
    <h4>{{$details['mensaje']}}</h4>
    <h4>Sus credenciales de inicio de sesión son:</h4>
    <h5>Usuario: {{$details['usuario']}}</h5>
    <h5>Contraseña: {{$details['contraseña']}}</h5>
@endSection