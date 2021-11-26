<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Constancia</title>
    <style>
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
</head>
<body>
    <header style="width: 100%;">
        <img src="https://covid19.ues.edu.sv/wp-content/uploads/sites/16/2020/04/ues-logo.svg">
    </header>
    <p></p>
    <article>
        <strong>UNIVERSIDAD DE EL SALVADOR</strong>
    </article>
    <article>
        <strong>{{$estudiante->nombre_facultad}}</strong>
    </article>
    <article>
        <strong>{{$estudiante->nombre_carrera}}</strong>
    </article>
    <article>
        <strong>{{$estudiante->correo_estudiante}}</strong>
    </article>
    <p></p>
    <article>
        CONSTANCIA DE CUMPLIMIENTO DE SERVICIO SOCIAL
    </article>
    <p>
        Los suscritos: jefe de la Unidad de Proyección Social
        de la {{$estudiante->nombre_facultad}} y el Coordinador de la Subunidad
        de la {{ $estudiante->nombre_carrera}}, Hacen constar que:
    </p>
    <p>
        Que el bachiller {{ $estudiante->nombre_estudiante}} con Carnet {{ $estudiante->carnet_estudiante}} matriculado en la carrera de {{ $estudiante->nombre_carrera}}, ha cumplido satisfactoriamente con todos los
        requerimientos que establece el Reglamento de Proyección Social y Servicio Social de la {{$estudiante->nombre_facultad}}, conforme a la descripción detallada en el siguiente cuadro:
    </p>    

    <table border="1" cellspacing="0" cellpadding="0" style="width: 100%;">
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
    <P>
        Y para los consiguientes trámites legales de graducación, se extiende la presente constancia de cumplimiento de servicio
        en la Ciudad Universitaria para la fecha:
    <?php echo date('d/m/Y'); ?>
    </P>
    <p>
        En nombre del encargado de la {{ $estudiante->nombre_facultad }}, Ing. {{ $servicio->nombre_encargado_facultad}}, Coordinador de la
        subunidad de proyección social de la {{ $estudiante->nombre_facultad}}, doy fé y legalidad.
    </p>
    <p>F.______________________</p>
    <p>
        En nombre del encargado de la escuela de {{ $estudiante->nombre_carrera }}, Ing. {{ $servicio->nombre_encargado_escuela}}, Coordinador de la
        subunidad de proyección social de la escuela de {{ $estudiante->nombre_carrera}}, doy fé y legalidad.
    </p>
    <p>F.______________________</p>
    </body>
</html>
