<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table, th, td{
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td, h3, h4{
            text-align: center;
        }
        p, h5{
            text-align: justify;
        }
    </style>
</head>
<body>
    <header>
        <h3>UNIVERSIDAD DE EL SALVADOR</h3>
        <h4>{{ $estudiante->nombre_facultad}}</h4>
        <h4>{{ $estudiante->nombre_carrera}}</h4>
        <h4>{{ $estudiante->correo_estudiante}}</h4>
    </header>

    <h4>CONSTANCIA DE CUMPLIMIENTO DE SERVICIO SOCIAL</h4>

    <section>
        <article>
            <p><h5>Los suscritos: Jefe de la Unidad de Proyección Social de la {{$estudiante->nombre_facultad}} y el Coordinador de la SubUnidad de la {{ $estudiante->nombre_carrera}}, Hacen constar que:   
            </h5></p>
        </article>
        <article>
            <p><h5>
                Que la bachiller {{ $estudiante->nombre_estudiante}} con Carnet No. {{ $estudiante->carnet_estudiante}} matriculada en la carrera de {{ $estudiante->nombre_carrera}} ha cumplido satisfactoriamente con todos los requerimientos que establece el Reglamento de
            Proyección Social y Servicio Social de la {{$estudiante->nombre_facultad}}, conforme a la descripción detallada en el siguiente cuadro:
            </h5></p>
        </article>
    </section>

    

    <table style="width: 100%;">
        <thead>
            <tr>
                <th scope="col"><h6>Servicio Social</h6></th>
                <th scope="col"><h6>Lugar de ejecución</h6></th>
                <th scope="col"><h6>Fecha Inicio</h6></th>
                <th scope="col"><h6>Fecha Fin</h6></th>
                <th scope="col"><h6>Número de horas</h6></th>
            </tr>
        </thead>
        <tbody>
        @foreach($servicios as $servicio)
            <tr>
                <td scope="col"><h6>{{ $servicio->nombre_tipo_servicio}}</h6></td>
                <td scope="col"><h6>{{ $servicio->ubicacion_actividades}}</h6></td>
                <td scope="col"><h6>{{ $servicio->fecha_peticion}}</h6></td>
                <td scope="col"><h6>{{ $servicio->fecha_peticion_fin}}</h6></td>
                <td scope="col"><h6>{{ $servicio->cantidad_horas}}</h6></td>
            </tr>
            @endforeach
        </tbody>
        <tr>
            <td colspan="4"><h6>Total:</h6></td>
            <td scope="col"><h6>{{ $total[0]->totalH }}</h6></td>
        </tr>
    </table>

    <p class="center"><h5>Y para los consiguientes trámites legales de graduación, se extiende la presente en la Ciudad Universitaria a
los ## días del mes de MES de ####.</h5></p>


{{ $servicio->nombre_encargado_escuela}}
<h5>Encargado de Escuela </h5>
{{ $servicio->nombre_encargado_facultad}}
<h5> Encargado de Facultad </h5>
</body>
</html>
