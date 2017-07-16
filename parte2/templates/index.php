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
<table id="example" class="display table table-bordered" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>name</th>
        <th>email</th>
        <th>position</th>
        <th>salary</th>
        <th>ver</th>
    </tr>
    </thead>
</table>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable( {
            "processing": true,
            "serverSide": true,
            "columns" : [
                  {'data':'name', "searchable": false},
                  {'data':'email', "searchable": true},
                  {'data': 'position', "searchable": false},
                  {'data' : 'salary', "searchable": false},
                  {'data' : 'ver', "searchable": false}],
            "ajax": "employees"
        } );
    } );
</script>
</div>
</body>

</html>

