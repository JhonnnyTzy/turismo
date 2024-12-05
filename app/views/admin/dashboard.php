<h1>DASHBOARD</h1>
<div class="container-fluid">
<div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>150</h3>

                <p>Reservas</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>
                <p>Ganancias</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>44</h3>

                <p>Usuarios registrados</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>

                <p>Visitantes</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
</div>

<h1>Ventas</h1>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Lista de Ventas</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table_destino table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Paquete</th>
                    <th>destino</th>
                    <th>alojamiento</th>
                    <th>Transporte</th>
                    <th>Precio</th>
                    <th>Codigo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($ventas)): ?>
                    <?php foreach ($ventas as $venta): ?>
                        <tr>
                            <td><?= $venta['id'] ?></td>
                            <td><?= $venta['usuario'] ?></td>
                            <td><?= $venta['tipo_paquete'] ?></td>
                            <td><?= $venta['destino'] ?></td>
                            <td><?= $venta['alojamiento'] ?></td>
                            <td><?= $venta['transporte'] ?></td>
                            <td><?= $venta['precio'] ?></td>
                            <td><?= $venta['codigo_secreto'] ?></td>
                            <td class="d-flex justify-content-around">
                                <a href="#"
                                    class="btn btn-warning btn-action"
                                    data-toggle="modal"
                                    data-target="#modal-default"
                                    data-action="editar"
                                    data-entidad="destino"
                                    data-info='<?= json_encode($venta) ?>'>Ver más</a>
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
                    <th>Usuario</th>
                    <th>Paquete</th>
                    <th>destino</th>
                    <th>alojamiento</th>
                    <th>Transporte</th>
                    <th>Precio</th>
                    <th>Codigo</th>
                    <th>Acciones</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>
       