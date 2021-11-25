@extends('emails.plantillaCorreo')

@section('entidad', 'Estudiante')

@section('contenidoCorreo')

    @if($details['tipoRechazo'] == 'Cuenta')
        <h3>Su solicitud de creación de cuenta en el sistema ha sido denegada.</h3>
        <h3>Favor revisar los datos que ha ingresado al momento de registrarse.</h3>
        <h3>Vuelva a registrarse en el sistema después de corregir.</h3>
    @endif    

@endSection