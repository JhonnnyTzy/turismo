function configurarBodyModal(entidad, datos, esEditar) {
    switch (entidad) {
      case "transporte":
        // Cambiar el cuerpo del modal
        $("#modal-body").html(`
          <form id="form-modal">
              <div class="form-row">
                  <div class="form-group col-md-6">
                      <label for="id">ID</label>
                      <input type="text" class="form-control" name="id" id="id" value="${datos.id}" readonly>
                  </div>
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
              </div>
              <div class="form-row">
                  
                  <div class="form-group col-md-6">
                      <label for="capacidad">Capacidad</label>
                      <input type="number" name="capacidad" class="form-control" id="capacidad" placeholder="capacidad" value="${datos.capacidad}" />
                  </div>
                  
              </div>
              <div class="form-row">
                  <div class="form-group col-md-6">
                      <label for="codigo">Codigo</label>
                      <input type="text" name="codigo" class="form-control" id="codigo" placeholder="codigo" value="${datos.codigo}" />
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
          </form>
        `);
        $("#tipo").val(datos.tipo);
        $("#estado").val(datos.estado);
        
        break;
      case "destino":
        // Cambiar el cuerpo del modal
        $("#modal-body").html(`
          <form id="form-modal">
              <div class="form-row">
                  <div class="form-group col-md-6">
                      <label for="id">ID</label>
                      <input type="text" class="form-control" name="id" id="id" value="${datos.id}" readonly>
                  </div>
                  <div class="form-group col-md-6">
                      <label for="nombre">Nombre</label>
                      <input type="text" class="form-control" name="nombre" id="nombre" value="${datos.nombre}" readonly>
                  </div>
                  
              </div>
              <div class="form-row">
                  <div class="form-group col-md-12">
                      <label for="descripcion">Descripcion</label>
                      <input type="text" name="descripcion" class="form-control" id="descripcion" placeholder="descripcion" value="${datos.descripcion}" />
                  </div>
              </div>
  
              <div class="form-row">
                  <div class="form-group col-md-6">
                      <label for="departamento">Departamento</label>
                      <input type="text" name="departamento" class="form-control" id="departamento" placeholder="departamento" value="${datos.departamento}" />
                  </div>
                  <div class="form-group col-md-6">
                      <label for="ubicacion">Ubicacion</label>
                      <input type="text" name="ubicacion" class="form-control" id="ubicacion" placeholder="ubicacion" value="${datos.ubicacion}" />
                  </div>
              </div>
  
              <div class="form-row">
                  <div class="form-group col-md-6">
                      <label for="temporada">Temporada Recomendada</label>
                      <input type="text" name="temporada" class="form-control" id="temporada" placeholder="temporada" value="${datos.temporada_recomendada}" />
                  </div>
                  <div class="form-group col-md-6">
                  <label for="clima">Clima</label>
                      <input type="text" name="clima" class="form-control" id="clima" placeholder="clima" value="${datos.clima}" />
                  </div>
              </div>
              <div class="form-row">
                  <div class="form-group col-md-12">
                      <label for="coordenadas">Coordenadas</label>
                      <input type="text" name="coordenadas" class="form-control" id="coordenadas" placeholder="coordenadas" value="${datos.coordenadas}" />
                  </div>
              </div>
              <div class="form-row">
                  <div class="form-group col-md-6">
                      <label for="restricciones">Restricciones</label>
                      <textarea name="restricciones" class="form-control" id="restricciones" placeholder="restricciones">${datos.restricciones}</textarea>
                  </div>
                  <div class="form-group col-md-6">
                      <label for="atracciones">Atracciones</label>
                      <textarea name="atracciones" class="form-control" id="atracciones" placeholder="atracciones">${datos.atracciones}</textarea>
                  </div>
              </div>
          </form>
        `);
        $('#modal-body').find("#temporada").daterangepicker();
  
        break;
  
      case "alojamiento":
        // Cambiar el cuerpo del modal
        $("#modal-body").html(`
          <form id="form-modal">
              <div class="form-row">
                  <div class="form-group col-md-6">
                      <label for="id">ID</label>
                      <input type="text" class="form-control" name="id" id="id" value="${datos.id}" readonly>
                  </div>
                  <div class="form-group col-md-6">
                      <label for="nombre">Nombre</label>
                      <input type="text" class="form-control" name="nombre" id="nombre" value="${datos.nombre}" ${!esEditar ? "readonly" : ""}>
                  </div>
              </div>
              <div class="form-row">
                  <div class="form-group col-md-6">
                      <label for="tipo">Tipo</label>
                      <input type="text" class="form-control" name="tipo" id="tipo" value="${datos.tipo}"  ${!esEditar ? "readonly" : ""}>
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
            <div class="form-group col-md-12">
                      <label for="ubicacion">Ubicacion</label>
                      <input type="text" class="form-control" name="ubicacion" id="ubicacion" value="${datos.ubicacion}"  ${!esEditar ? "readonly" : ""}>
                  </div>
            </div>

              <div class="form-row">
                  <div class="form-group col-md-12">
                      <label for="url_maps">URL Google Maps</label>
                      <input type="text" class="form-control" name="url_maps" id="url_maps" value="${datos.url_maps}"  ${!esEditar ? "readonly" : ""}>
                  </div>
                </div>
              <div class="form-row">
                  <div class="form-group col-md-6">
                      <label for="capacidad">Capacidad</label>
                      <input type="text" class="form-control" name="capacidad" id="capacidad" value="${datos.capacidad}"  ${!esEditar ? "readonly" : ""}>
                  </div>
                  <div class="form-group col-md-6">
                      <label for="precio">Precio</label>
                      <input type="text" class="form-control" name="precio" id="precio" value="${datos.precio}"  ${!esEditar ? "readonly" : ""}>
                  </div>
              </div>
              <div class="form-row">
                  <div class="form-group col-md-6">
                      <label for="servicios">Servicios</label>
                      <textarea name="servicios" class="form-control" id="servicios" placeholder="servicios"  ${!esEditar ? "readonly" : ""}>${datos.servicios}</textarea>
                  </div>
                  <div class="form-group col-md-6">
                      <label for="descripcion">Descripcion</label>
                      <textarea name="descripcion" class="form-control" id="descripcion" placeholder="descripcion"  ${!esEditar ? "readonly" : ""}>${datos.descripcion}</textarea>
                    </div>
                  
                </div>
          </form>
        `);
        
        $('#departamento').val(datos.departamento);
        break;
  
      default:
        $("#modal-body").html(
          `<p>El cuerpo del modal no esta configurado para la entidad ${entidad}</p>`
        );
        break;
    }
  }