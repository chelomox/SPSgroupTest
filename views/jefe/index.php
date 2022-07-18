<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SPSgroup</title>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">

    <!-- JavaScript Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="#">
                    SPSgroup
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo URL . "jefe/index"; ?>">Jefe</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo URL . "empleado/index"; ?>">Empleado</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->

                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <div style="display: flex; justify-content: space-between; align-items: center;">

                                    <span id="card_title">
                                        Listado de Jefes
                                    </span>

                                    <div class="float-right">


                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#NuevoJefeModal">
                                            Nuevo jefe
                                        </button>


                                    </div>
                                </div>
                            </div>


                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="tablaJefe">
                                        <thead class="thead">
                                            <tr>
                                                <th>N&deg;</th>
                                                <th>Nombre</th>
                                                <th>Correo</th>
                                                <th>Correos empleados</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Modal Insert -->
            <div class="modal fade" id="NuevoJefeModal" tabindex="-1" aria-labelledby="NuevoJefeModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="NuevoJefeModalLabel">Nuevo Jefe</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="insert">

                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" placeholder="Nombre de jefe">
                            </div>

                            <div class="mb-3">
                                <label for="correo" class="form-label">Correo</label>
                                <input type="text" class="form-control" id="correo" placeholder="nombre@spsgroup.com">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" id="registrar">Registrar</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal Edit -->
            <div class="modal fade" id="EditJefeModal" tabindex="-1" aria-labelledby="EditJefeModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="EditJefeModalLabel">Editar Jefe</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="edit">

                            <input type="hidden" class="form-control" id="id">

                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" placeholder="Nombre de jefe">
                            </div>

                            <div class="mb-3">
                                <label for="correo" class="form-label">Correo</label>
                                <input type="text" class="form-control" id="correo" placeholder="nombre@spsgroup.com">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" id="actualizar">Actualizar</button>
                        </div>
                    </div>
                </div>
            </div>


        </main>
    </div>
</body>

<script>
    $('document').ready(function() {

        var DTtablaJefe = $('#tablaJefe').DataTable({
            ajax: "<?php echo URL . "jefe/show"; ?>",
            columns: [{
                    data: 'id'
                },
                {
                    data: 'nombre'
                },
                {
                    data: 'correo'
                },
                {
                    data: 'correos'
                },
                {
                    data: 'botones'
                }
            ],
        });

        $('body')
            .on('click', "#registrar", function() {

                $.ajax({
                        method: "POST",
                        url: "<?php echo URL . "jefe/insert"; ?>",
                        data: {
                            nombre: $("#insert #nombre").val(),
                            correo: $("#insert #correo").val()
                        }
                    })
                    .done(function(msg) {
                        //alert(msg);
                        $("#NuevoJefeModal").modal("hide");
                        $("#NuevoJefeModal input").val("");
                        DTtablaJefe.ajax.reload();
                    });

            })
            .on('click', ".editar", function() {

                jefe_id = $(this).attr("jefe_id");
                $.ajax({
                        method: "POST",
                        url: "<?php echo URL . "jefe/edit"; ?>",
                        data: {
                            id: jefe_id
                        }
                    })
                    .done(function(data) {

                        jefe = JSON.parse(data);

                        $("#EditJefeModal").modal("show");
                        $("#edit #id").val(jefe_id);
                        $("#edit #nombre").val(jefe.nombre);
                        $("#edit #correo").val(jefe.correo);

                    });
            })
            .on('click', "#actualizar", function() {
                $.ajax({
                        method: "POST",
                        url: "<?php echo URL . "jefe/update"; ?>",
                        data: {
                            id: $("#edit #id").val(),
                            nombre: $("#edit #nombre").val(),
                            correo: $("#edit #correo").val()
                        }
                    })
                    .done(function(msg) {
                        alert(msg);

                        $("#EditJefeModal").modal("hide");
                        DTtablaJefe.ajax.reload();
                    });
            })
            .on('click', ".eliminar", function() {
                jefe_id = $(this).attr("jefe_id");
                $.ajax({
                        method: "POST",
                        url: "<?php echo URL . "jefe/delete"; ?>",
                        data: {
                            id: jefe_id
                        }
                    })
                    .done(function(msg) {
                        alert(msg);
                        DTtablaJefe.ajax.reload();
                    });
            })
    });
</script>

</html>