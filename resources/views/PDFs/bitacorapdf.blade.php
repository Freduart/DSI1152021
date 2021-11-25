<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    
    <title>Document</title>
</head>

<style>
.center {
    margin: auto;
    width: 50%;
    border: 3px solid green;
    padding: 10px;
}
</style>
<body>
    <div style="width: 100%; height:200px">
        <div style="float: left; width: 25%;"></div>
        <div style="float: left; width: 50%; text-align: center;">
            <h2>UNIVERSIDAD DE EL SALVADOR</h2>
            <h4>Hacia la libertad por la cultura</h4>
            <h4>{{$estudiante->nombre_facultad}}</h4>
            <h4>{{$estudiante->nombre_carrera}}</h4>
        </div>
        <div style="float: left; width: 25%;"></div>              
    </div>        
    <div style="width: 100%; height: 100px">
        <h4 style="height: 10px">Carnet: {{$estudiante->carnet_estudiante}}</h4>        
        <h4 style="height: 10px">Nombre completo: {{$estudiante->nombre_estudiante}} {{$estudiante->apellido_estudiante}}</h4>        
    </div>
    
    <table width="100%" border="2px solid black">
        <tr class="center">
            <td style="width: 25%">Fecha</td>
            <td style="width: 25%">Actividad realizada</td>
            {{-- <td>Persona que certifica</td> --}}
            <td style="width: 25%">Total de horas invertidas</td>
        </tr>
        <tr>
            @foreach ($actividades as $actividad)
                <td style="width: 25%">{{$actividad->fecha_actividad}}</td>
                <td style="width: 25%">{{$actividad->nombre_actividad}}</td>
                {{-- <td>{{$actividad->fecha_actividad}}</td> --}}
                <td style="width: 25%">{{$actividad->total_horas}}</td>
                <br>
            @endforeach
        </tr>
    </table>
    
    {{-- @foreach($actividades as $actividad)
        <h3>{{ $actividad->nombre_actividad}}</h3>
    @endforeach
    <hr/>
    <h3>{{ $estudiante->nombre_facultad}}</h3> --}}
</body>
</html>