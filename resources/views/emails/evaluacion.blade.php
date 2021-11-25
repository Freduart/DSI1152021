@extends('emails.plantillaCorreo')

{{-- @section('entidad', 'Estudiante') --}}

@section('contenidoCorreo') 
    {{-- <h2>
        {{$details['proyecto']}}
    </h2> --}}
    <h4>
        {{$details['usuario']}}
    </h4>
    <h4>
        {{$details['mensaje']}}
    </h4>
@endSection