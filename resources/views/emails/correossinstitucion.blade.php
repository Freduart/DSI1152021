@extends('emails.plantillaCorreo')

@section('entidad', 'Institucion')

@section('contenidoCorreo')
    <h4>{{$details['mensaje']}}</h4>

            
<!--Informacion del proyecto y el estado que tiene-->
        
        <p>Proyecto: {{ $details['proyecto'] }}</p>
        <p>Estado: {{ $details['estado'] }}</p>
</body>
    
@endSection