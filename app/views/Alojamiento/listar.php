<div class="card">
    <div class="card-header">
        <h3 class="card-title">Lista de Alojamientos</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Departamento</th>
                    <th>URL Maps</th>
                    <th>Ubicacion</th>
                    <th>Capacidad</th>
                    <th>Precio</th>
                    <th>Servicios</th>
                    <th>Descripcion</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($alojamientos)): ?>
                    <?php foreach ($alojamientos as $alojamiento): ?>
                        <tr>
                            <td><?= $alojamiento['id'] ?></td>
                            <td><?= $alojamiento['nombre'] ?></td>
                            <td><?= $alojamiento['tipo'] ?></td>
                            <td><?= $alojamiento['departamento'] ?></td>
                            <td><?= $alojamiento['url_maps'] ?></td>
                            <td><?= $alojamiento['ubicacion'] ?></td>
                            <td><?= $alojamiento['capacidad'] ?></td>
                            <td><?= $alojamiento['precio'] ?></td>
                            <td><?= $alojamiento['servicios'] ?></td>
                            <td><?= $alojamiento['descripcion'] ?></td>
                            <td class="d-flex justify-content-around">
                                <a href="#"
                                    class="btn btn-warning btn-action"
                                    data-toggle="modal"
                                    data-target="#modal-default"
                                    data-action="editar"
                                    data-entidad="alojamiento"
                                    data-info='<?= json_encode($alojamiento) ?>'>Editar</a>
                                <a href="#"
                                    class="btn btn-danger btn-action"
                                    data-toggle="modal"
                                    data-target="#modal-default"
                                    data-action="eliminar"
                                    data-entidad="alojamiento"
                                    data-info='<?= json_encode($alojamiento) ?>'>Eliminar</a>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No hay registros</td>
                    </tr>
                <?php endif; ?>

            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Departamento</th>
                    <th>URL Maps</th>
                    <th>Ubicacion</th>
                    <th>Capacidad</th>
                    <th>Precio</th>
                    <th>Servicios</th>
                    <th>Descripcion</th>
                    <th>Acciones</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>