<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Jorge Copia">

    <title>Grilla simple Slim</title>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs-3.3.7/jqc-1.12.4/dt-1.10.13/datatables.min.css"/>

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs-3.3.7/jqc-1.12.4/dt-1.10.13/datatables.min.js"></script>

</head>
<body>
<div class="container">

    <h1>Developers SAC - Empleados</h1>
    <p><strong>Nombre:</strong> <?php echo $worker['name']; ?></p>
    <p><strong>Email:</strong> <?php echo $worker['email']; ?></p>
    <p><strong>Telefono:</strong> <?php echo $worker['phone']; ?></p>
    <p><strong>address:</strong> <?php echo $worker['address']; ?></p>
    <p><strong>Posición:</strong> <?php echo $worker['position']; ?></p>
    <p><strong>Sueldo:</strong> <?php echo $worker['salary']; ?></p>
    <p><strong>Habilidades:</strong> <?php   echo join(',', $worker['skills']); ?></p>
</div>
</body>

</html>

