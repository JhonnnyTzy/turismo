<div class="card">
    <div class="card-header">
        <h3 class="card-title">Lista de Destino</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table_destino table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripccion</th>
                    <th>Ubicacion</th>
                    <th>Departamento</th>
                    <th>Coordenadas</th>
                    <th>Clima</th>
                    <th>Temporada</th>
                    <th>Restricciones</th>
                    <th>Atracciones</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($destinos)): ?>
                    <?php foreach ($destinos as $destino): ?>
                        <tr>
                            <td><?= $destino['id'] ?></td>
                            <td><?= $destino['nombre'] ?></td>
                            <td><?= $destino['descripcion'] ?></td>
                            <td><?= $destino['ubicacion'] ?></td>
                            <td><?= $destino['departamento'] ?></td>
                            <td><?= $destino['coordenadas'] ?></td>
                            <td><?= $destino['clima'] ?></td>
                            <td><?= $destino['temporada_recomendada'] ?></td>
                            <td><?= $destino['restricciones'] ?></td>
                            <td><?= $destino['atracciones'] ?></td>
                            <td class="d-flex justify-content-around">
                                <a href="#"
                                    class="btn btn-warning btn-action"
                                    data-toggle="modal"
                                    data-target="#modal-default"
                                    data-action="editar"
                                    data-entidad="destino"
                                    data-info='<?= json_encode($destino) ?>'>Editar</a>
                                <a href="#"
                                    class="btn btn-danger btn-action"
                                    data-toggle="modal"
                                    data-target="#modal-default"
                                    data-action="eliminar"
                                    data-entidad="destino"
                                    data-info='<?= json_encode($destino) ?>'>Eliminar</a>
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
                    <th>Descripccion</th>
                    <th>Ubicacion</th>
                    <th>Departamento</th>
                    <th>Coordenadas</th>
                    <th>Clima</th>
                    <th>Temporada</th>
                    <th>Restricciones</th>
                    <th>Atracciones</th>
                    <th>Acciones</th>

                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>