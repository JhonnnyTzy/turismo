<?php if (isset($paquetes)) : foreach ($paquetes as $paquete) : ?>
        <div class="paquete scale-up-center">
            <!-- Mostrar solo la primera imagen del JSON -->
            <?php
            $imagenes = json_decode($paquete['imagenes'], true); // Decodificar el JSON de imágenes
            $imagen_decodificada = json_decode($imagenes, true);
            $ruta = $imagen_decodificada[rand(0, count($imagen_decodificada) - 1)];
            $info = pathinfo($ruta);
            $archivo = $info['filename'] . ".webp";
            ?>
            <img src="<?php echo URL_RESOURCES; ?>uploads/Destino/<?php echo htmlspecialchars($archivo); ?>" alt="foto_paquete" width="200px">
            <div class="ubicacion">
                    <div class="nombre_dep">
                        <p class="nombre"><?php echo htmlspecialchars($paquete['nombre']); ?></p>
                        <a href="<?php echo htmlspecialchars($paquete['coordenadas']); ?>" class="maps" target="_blank">Ubicacion</a>
                    </div>
                    <div class="departamento">
                        <p class="p_departamento"><?php echo htmlspecialchars($paquete['departamento']); ?></p>
                    </div>
            </div>
            
            <div class="contenido">
                <div class="info">
                    <p class="tipo_paquete"> <?php echo htmlspecialchars($paquete['tipo_paquete']); ?></p>
                    <p class="precio"> <?php echo htmlspecialchars((int)$paquete['precio_total']); ?> Bs</p>
                </div>
                <p class="descripcion"><?php echo htmlspecialchars($paquete['descripcion']); ?>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis, praesentium!dfgdfgdfgdfgdfgdfgdf</p>
                <div class="btn_paquete">
                    <button type="button" 
                    data-id="<?php echo $paquete['id']; ?>" 
                    class="detalle" id="btn_detalle">Ver detalles</button>
                </div>
            </div>

        </div>
<?php endforeach;
endif; ?>