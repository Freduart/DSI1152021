@extends('emails.plantillaCorreo')

@section('entidad', 'Estudiante')

@section('contenidoCorreo')
    <h4>El estudiante {{$details['nombres']}} {{$details['apellidos']}} ha finalizado su servicio social.</h4>
    <h4>Horas realizadas: <b>{{$details['horas']}}</b></h4>
    <h4>Generar e imprimir la constancia de cumplimiento desde el sitio y entregarla a su encargado de escuela.</h4>

@endSection