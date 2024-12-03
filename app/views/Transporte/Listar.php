<div class="modal fade" id="modal-default" style="transition: transform 0.5s ease-out, opacity 0.5s ease-out;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" id="modal-header">
                <h4 class="modal-title" id="modal-title">Default Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-body">
                <p>Contenido dinámico aquí...</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="modal-confirm">Confirmar</button>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Lista de Transportes</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table_transporte table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Codigo</th>
                    <th>Estado</th>
                    <th>Capacidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($transportes)): ?>
                    <?php foreach ($transportes as $transporte): ?>
                        <tr>
                            <td><?= $transporte['id'] ?></td>
                            <td><?= $transporte['tipo'] ?></td>
                            <td><?= $transporte['codigo'] ?></td>
                            <td><?= $transporte['estado'] ?></td>
                            <td><?= $transporte['capacidad'] ?></td>
                            <td class="d-flex justify-content-around">
                                <a href="#"
                                    class="btn btn-warning btn-action"
                                    data-toggle="modal"
                                    data-target="#modal-default"
                                    data-action="editar"
                                    data-entidad="transporte"
                                    data-info='<?=json_encode($transporte)?>'>Editar</a>
                                <a href="#"
                                    class="btn btn-danger btn-action"
                                    data-toggle="modal"
                                    data-target="#modal-default"
                                    data-action="eliminar"
                                    data-entidad="transporte"
                                    data-info='<?=json_encode($transporte)?>'>Eliminar</a>
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
                    <th>Tipo</th>
                    <th>Codigo</th>
                    <th>Estado</th>
                    <th>Capacidad</th>
                    <th>Acciones</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>
