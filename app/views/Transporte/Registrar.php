<div class="form_contenedor" id="registrarTransporte" data-container="registrarTransporte" data-entidad="Transporte">
    <div class="contenido">
        <h2>Registro Transporte</h2>
        <form action="transporte/registrar" method="POST" id="uploadForm" class="w-100">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="tipo">Tipo</label>
                                <select class="form-control" name="tipo" id="tipo">
                                    <option value="AUTOBUS">AUTOBUS</option>
                                    <option value="AVION">AVION</option>
                                    <option value="BARCO">BARCO</option>
                                    <option value="MINIBUS">MINIBUS</option>
                                    <option value="TAXI">TAXI</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="capacidad">Capacidad</label>
                                <input type="number" name="capacidad" class="form-control" id="capacidad" placeholder="capacidad" />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="codigo">Codigo</label>
                                <input type="text" name="codigo" class="form-control" id="codigo" placeholder="codigo" />
                            </div>

                            <div class="form-group col-md-6">
                                <label for="estado">Estado</label>
                                <select class="form-control" name="estado" id="estado">
                                    <option value="DISPONIBLE">DISPONIBLE</option>
                                    <option value="RESERVADO">RESERVADO</option>
                                    <option value="MANTENIMIENTO">MANTENIMIENTO</option>
                                    <option value="NUEVO">NUEVO</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-default">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            Seleccionar imagenes
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <div id="actions" class="row">
                                            <div class="col-lg-6">
                                                <div class="btn-group w-100">
                                                    <span class="btn btn-success col fileinput-button">
                                                        <i class="fas fa-plus"></i>
                                                        <span>Agregar imagenes</span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 d-flex align-items-center">
                                                <div class="fileupload-process w-100">
                                                    <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                                        aria-valuemax="100" aria-valuenow="0">
                                                        <div class="progress-bar progress-bar-success" style="width: 0%" data-dz-uploadprogress></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table table-striped files" id="previews">
                                            <div id="template" class="row mt-2">
                                                <div class="col-auto">
                                                    <span class="preview"><img src="data:," alt="" data-dz-thumbnail /></span>
                                                </div>
                                                <div class="col d-flex align-items-center">
                                                    <p class="mb-0">
                                                        <span class="lead" data-dz-name></span>
                                                        (<span data-dz-size></span>)
                                                    </p>
                                                    <strong class="error text-danger" data-dz-errormessage></strong>
                                                </div>
                                                <div class="col-4 d-flex align-items-center">
                                                    <div class="progress progress-striped active w-100" role="progressbar" aria-valuemin="0"
                                                        aria-valuemax="100" aria-valuenow="0">
                                                        <div class="progress-bar progress-bar-success" style="width: 0%" data-dz-uploadprogress></div>
                                                    </div>
                                                </div>
                                                <div class="col-auto d-flex align-items-center">
                                                    <div class="btn-group">
                                                        <button data-dz-remove class="btn btn-danger delete">
                                                            <i class="fas fa-trash"></i>
                                                            <span>Delete</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <p>Agrega imagenes llamativas...</p>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Registrar Transporte</button>
            </div>
        </form>
    </div>
</div>