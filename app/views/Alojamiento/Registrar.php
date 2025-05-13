<div class="form_contenedor" id="registrarAlojamiento" data-container="registrarAlojamiento" data-entidad="Alojamiento">
    <div class="contenido">
        <h2>Registro Alojamiento</h2>
        <form action="alojamiento/registrar" method="POST" id="uploadForm" class="w-100">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Ej. Alexander" required />
                        </div>

                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea name="descripcion" class="form-control" id="descripcion" placeholder="Descripción del destino" rows="2" required></textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="tipo">Tipo</label>
                                <select class="form-control" name="tipo" id="tipo">
                                    <option value="HOTEL">Hotel</option>
                                    <option value="CABAÑA">Cabaña</option>
                                    <option value="HOSTAL">Hostal</option>
                                    <option value="ALOJAMIENTO">Alojamiento</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="departamento">Departamento</label>
                                <select class="form-control" name="departamento" id="departamento">
                                    <option value="LA PAZ">LA PAZ</option>
                                    <option value="SANTA CRUZ">SANTA CRUZ</option>
                                    <option value="BENI">BENI</option>
                                    <option value="CHUQUISACA">CHUQUISACA</option>
                                    <option value="COCHABAMBA">COCHABAMBA</option>
                                    <option value="ORURO">ORURO</option>
                                    <option value="PANDO">PANDO</option>
                                    <option value="POTOSI">POTOSI</option>
                                    <option value="TARIJA">TARIJA</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <label for="ubicacion">Ubicación</label>
                                <input type="text" name="ubicacion" class="form-control" id="ubicacion" placeholder="Dirección o ubicación específica" />
                            </div>

                            <div class="form-group col-md-6">
                                <label for="url_maps">URL Google Maps</label>
                                <input type="text" name="url_maps" class="form-control" id="url_maps" placeholder="Enlace de Google Maps" />
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="capacidad">Capacidad</label>
                                    <input type="number" name="capacidad" class="form-control" id="capacidad" placeholder="capacidad">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="precio">Precio x Noche</label>
                                    <input type="number" name="precio" class="form-control" id="precio" placeholder="precio"></input>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="servicios">Servicios</label>
                                    <textarea name="servicios" class="form-control" id="servicios" placeholder="servicios" rows="3"></textarea>
                                </div>
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
                                                        <span>Add files</span>
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
                <button type="submit" class="btn btn-primary">Registrar Destino</button>
            </div>
        </form>
    </div>
</div>