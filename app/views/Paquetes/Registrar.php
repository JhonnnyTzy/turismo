<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Registrar Paquete</h3>
            </div>
            <form action="paquete/registrar" method="POST" id="formPaquete" class="w-100">

                <div class="card-body p-0">
                    <div class="bs-stepper">
                        <div class="bs-stepper-header" role="tablist">
                            <!-- your steps here -->
                            <div class="step" data-target="#parte-destino">
                                <button type="button" class="step-trigger" role="tab" aria-controls="parte-destino"
                                    id="parte-destino-trigger">
                                    <span class="bs-stepper-circle">1</span>
                                    <span class="bs-stepper-label">Eligir Destino</span>
                                </button>
                            </div>

                            <div class="step" data-target="#parte-detalles">
                                <button type="button" class="step-trigger" role="tab" aria-controls="parte-detalles"
                                    id="parte-detalles-trigger">
                                    <span class="bs-stepper-circle">2</span>
                                    <span class="bs-stepper-label">Detalles</span>
                                </button>
                            </div>

                            <div class="line"></div>
                            <div class="step" data-target="#information-part">
                                <button type="button" class="step-trigger" role="tab" aria-controls="information-part"
                                    id="information-part-trigger">
                                    <span class="bs-stepper-circle">3</span>
                                    <span class="bs-stepper-label">Paquete</span>
                                </button>
                            </div>
                        </div>
                        <div class="bs-stepper-content">
                            <!-- your steps content here -->
                            <div id="parte-destino" class="content" role="tabpanel" aria-labelledby="parte-destino-trigger">
                                <hr>
                                <h2>SALIDA</h2>

                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label for="select_departamento_origen">Departamento Salida: </label>
                                        <select name="departamento_origen" id="select_departamento_origen" class="form-control">
                                            <option value="">Departamento</option>
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
                                    <div class="form-group col-md-6">
                                        <label for="lugar_salida">Lugar (Google Maps)</label>
                                        <input type="text" name="lugar_salida" class="form-control" id="lugar_salida" required>
                                    </div>
                                </div>

                                <hr>
                                <h2>LLEGADA</h2>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="select_departamento">Filtrar por Departamentos: </label>
                                        <select name="departamento" id="select_departamento" class="form-control">
                                            <option value="">Seleccione Departamento</option>
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
                                    <div class="form-group col-md-6">
                                        <label for="select_destino">Destinos - <span id="s_departamento">Departamento</span></label>
                                        <select name="destino_id" id="select_destino" class="form-control">
                                            <option value="">Seleccione Destino</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="duracion">Duracion</label>
                                        <input type="input" name="duracion" class="form-control" id="duracion" placeholder="Ej. Abril - Octubre" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="plaza_disponible">Plazas Disponibles</label>
                                        <input type="number" name="plaza_disponible" class="form-control" id="plaza_disponible" placeholder="Ej. 40" />
                                    </div>
                                </div>

                                <button class="btn btn-primary" onclick="stepper.next()">
                                    Siguiente
                                </button>
                            </div>

                            <!-- your steps content here -->
                            <div id="parte-detalles" class="content" role="tabpanel"
                                aria-labelledby="parte-detalles-trigger">

                                <hr>
                                <h2>TRANSPORTE</h2>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="select_destino"> Salida de <span id="st_departamento">Departamento</span></label>
                                        <select name="transporte_salida" id="select_transporteS" class="form-control">
                                            <option value="">Seleccione Transporte</option>

                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="select_destino">Regreso de <span id="ll_departamento">Departamento</span></label>
                                        <select name="transporte_regreso" id="select_transporteL" class="form-control">
                                            <option value="">Seleccione Transporte</option>

                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <h2>ALOJAMIENTO</h2>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="select_alojamiento"> Alojamientos de <span id="al_departamento">Departamento</span></label>
                                        <select name="alojamiento_id" id="select_alojamiento" class="form-control">
                                            <option value="">Seleccione Alojamiento</option>
                                        </select>
                                    </div>
                                </div>
                                <button class="btn btn-primary" onclick="stepper.previous()">
                                    Atras
                                </button>
                                <button class="btn btn-primary" onclick="stepper.next()">
                                    Siguiente
                                </button>
                            </div>
                            <div id="information-part" class="content" role="tabpanel"
                                aria-labelledby="information-part-trigger">

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre del paquete" required />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="descripcion">Descripción</label>
                                        <textarea name="descripcion" class="form-control" id="descripcion" placeholder="Descripción del paquete" rows="3" required></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="id_tipo_paquete">Tipo de Paquete</label>
                                        <select name="id_tipo_paquete" id="id_tipo_paquete" class="form-control">
                                            <option value="">Seleccione Tipo de Paquete</option>
                                            <?php if ($tiposPaquetes) : foreach ($tiposPaquetes as $paquete) : ?>
                                                    <option value="<?= $paquete['id'] ?>"><?= $paquete['nombre'] ?></option>
                                            <?php endforeach;
                                            endif; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="precio_total">Precio Total</label>
                                        <input type="number" name="precio_total" class="form-control" id="precio_total" placeholder="Precio en Bs" required />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="informacion_adicional">Información Adicional</label>
                                        <textarea name="informacion_adicional" class="form-control" id="informacion_adicional" placeholder="Cualquier información adicional" rows="4"></textarea>
                                    </div>
                                </div>
                                <button class="btn btn-primary" onclick="stepper.previous()">
                                    Previous
                                </button>
                                <button type="submit" class="btn btn-primary">Registrar Paquete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- /.card-body -->
            <div class="card-footer">
                Visit
                <a href="https://github.com/Johann-S/bs-stepper/#how-to-use-it">bs-stepper documentation</a>
                for more examples and information about the plugin.
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
<!-- /.row -->