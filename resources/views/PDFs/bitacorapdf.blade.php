<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    
    <title>Bitacoras</title>
</head>

<style>
    .center {
        margin: auto;
        width: 50%;
        border: 3px solid green;
        padding: 10px;
    }

    .table, th, td{
        border: 1px solid black;
    }
    th, td, h3, h4, article{
        text-align: center;
    }
    p, h5{
        text-align: justify;
    }

</style>
<body>
    <header style="width: 100%">
        <div style="height: 150px">
            <div style="float: left; width: 25%;">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRChFQlYeaFCq-GLoz0C3ul_9A7I9Qe2Djj1g&usqp=CAU" height="90px" width="90px">
            </div>
            <div style="float: left; width: 50%; text-align: center;">
                <article><strong>UNIVERSIDAD DE EL SALVADOR</strong></article>
                
                <article><strong>{{$estudiante->nombre_facultad}}</strong></article>
                <article><strong>{{$estudiante->nombre_carrera}}</strong></article>
                <br>

                <article>{{$estudiante->correo_estudiante}}</article>
            </div>
            <div style="float: right; width: 25%;">

            </div>
        </div>                
    </header>

    <div style="width: 100%; height:60px;">
        <article> <strong>Carnet: {{$estudiante->carnet_estudiante}} </strong></article>
        <article> <strong>Nombre completo: {{$estudiante->nombre_estudiante}} {{$estudiante->apellido_estudiante}}</strong></article>
    </div>

    @if (count($actividades)>0)
    <table border="1" cellspacing="0" cellpadding="0" style="width: 100%;">
        <thead>
            <tr>
                <th scope="col">Fecha</th>
                <th scope="col">Actividad realizada</th>
                <th scope="col">Estado actividad</th>
                {{-- <td>Persona que certifica</td> --}}
                <th scope="col">Total de horas invertidas</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($actividades as $actividad)
            <tr>
                <td scope="col">{{$actividad->fecha_actividad}}</td>
                <td scope="col">{{$actividad->nombre_actividad}}</td>
                <th scope="col">{{$actividad->verificado}}</th>
                {{-- <td>{{$actividad->fecha_actividad}}</td> --}}
                <td scope="col">{{$actividad->total_horas}}</td>                
            </tr>
        @endforeach
        {{-- @for ($i = 1; $i < count($actividades); $i++) --}}
            <tr>
                <td scope="col"><h6></h6></td>
                <td scope="col"><h6></h6></td>
                <td scope="col">Total:</td>
                <td scope="col">{{ $totalH[0]->total_horas }}</td>
            </tr>
        {{-- @endfor --}}
        </tbody>        
    </table>
    @endif
</body>
</html>