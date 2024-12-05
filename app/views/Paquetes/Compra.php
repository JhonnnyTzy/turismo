<?php
session_start();

$imagenes = json_decode($paquete['d_imagenes'], true); // Decodificar el JSON de imágenes
$imagen_decodificada = json_decode($imagenes, true); // array de imagenes
foreach ($imagen_decodificada as $key => $value) {
    $info = pathinfo($value);
    $imagen_decodificada[$key] = $info['filename'] . ".webp";
}
$imagenes_a = json_decode($paquete['imagenes'], true); // Decodificar el JSON de imágenes
$imagen_decodificada_a = json_decode($imagenes_a, true); // array de imagenes
foreach ($imagen_decodificada_a as $key => $value) {
    $info = pathinfo($value);
    $imagen_decodificada_a[$key] = $info['filename'] . ".webp";
}
?>

<div class="header_compra">
    <div class="contenido_compra">

    </div>
</div>

<div class="contenedor_compra">

    <div class="contenedor_main">
        <h2>DESTINO</h2>
        <div class="contenedor_partes">

            <div class="parte_carousel">
                <!-- /.card-header -->
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

                    <ol class="carousel-indicators">
                        <?php foreach ($imagen_decodificada as $key => $value): ?>
                            <li data-target="#carouselExampleIndicators" data-slide-to=<?php echo $key ?> class=<?php $key == 0 ? "active" : "" ?>></li>
                        <?php endforeach; ?>
                    </ol>
                    <div class="carousel-inner">
                        <?php foreach ($imagen_decodificada as $key => $value): ?>
                            <div class="carousel-item <?php echo $key == 0 ? "active" : "" ?>">
                                <img src="<?php echo URL_RESOURCES; ?>/uploads/Destino/<?php echo $value; ?>" alt="imagen" class="imagen">
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-custom-icon" aria-hidden="true">
                            <i class="fas fa-chevron-left"></i>
                        </span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-custom-icon" aria-hidden="true">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="parte_info">

                <div class="destino_mas_info">
                    <h2><?php echo htmlspecialchars($paquete['d_nombre']); ?></h2>
                    <p><strong>Duracion:</strong> <?php echo htmlspecialchars($paquete['p_duracion']); ?></p>
                    <p><strong>Descripción:</strong> <?php echo htmlspecialchars($paquete['d_descripcion']); ?></p>
                    <p><strong>Departamento:</strong> <?php echo htmlspecialchars($paquete['d_departamento']); ?></p>
                    <p><strong>Coordenadas:</strong> <a href="<?php echo htmlspecialchars($paquete['d_coordenadas']); ?>" target="_blank">Ver en Google Maps</a></p>
                    <p><strong>Clima:</strong> <?php echo htmlspecialchars($paquete['clima']); ?></p>
                    <p><strong>Restricciones:</strong> <?php echo htmlspecialchars($paquete['restricciones']); ?></p>
                    <p><strong>Atracciones:</strong> <?php echo htmlspecialchars($paquete['atracciones']); ?></p>
                </div>


            </div>
        </div>

        <h2>ALOJAMIENTO</h2>
        <div class="contenedor_partes">
            <div class="parte_info">
                <div class="destino_mas_info">
                    <h2><?php echo htmlspecialchars($paquete['a_nombre']); ?></h2>
                    <p><strong>Descripción:</strong> <?php echo htmlspecialchars($paquete['a_descripcion']); ?></p>
                    <p><strong>Tipo:</strong> <?php echo htmlspecialchars($paquete['a_tipo']); ?></p>
                    <p><strong>Coordenadas:</strong> <a href="<?php echo htmlspecialchars($paquete['a_url_maps']); ?>" target="_blank">Ver en Google Maps</a></p>
                    <p><strong>Ubicacion:</strong> <?php echo htmlspecialchars($paquete['a_ubicacion']); ?></p>
                    <p><strong>Servicios:</strong> <?php echo htmlspecialchars($paquete['a_servicios']); ?></p>
                    <p><strong>Atracciones:</strong> <?php echo htmlspecialchars($paquete['atracciones']); ?></p>
                    <p><strong>Transporte:</strong> <?php echo htmlspecialchars($paquete['t_tipo']); ?></p>
                    <p><strong>Codigo:</strong> <?php echo htmlspecialchars($paquete['t_codigo']); ?></p>
                </div>

            </div>

            <div class="parte_carousel">

                <div id="carouselExampleIndicators1" class="carousel slide" data-ride="carousel">

                    <ol class="carousel-indicators">
                        <?php foreach ($imagen_decodificada_a as $key => $value): ?>
                            <li data-target="#carouselExampleIndicators" data-slide-to=<?php echo $key ?> class=<?php $key == 0 ? "active" : "" ?>></li>
                        <?php endforeach; ?>
                    </ol>
                    <div class="carousel-inner">
                        <?php foreach ($imagen_decodificada_a as $key => $value): ?>
                            <div class="carousel-item <?php echo $key == 0 ? "active" : "" ?>">
                                <img src="<?php echo URL_RESOURCES; ?>/uploads/Alojamiento/<?php echo $value; ?>" alt="imagen" class="imagen">
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <a class="carousel-control-prev" href="#carouselExampleIndicators1" role="button" data-slide="prev">
                        <span class="carousel-control-custom-icon" aria-hidden="true">
                            <i class="fas fa-chevron-left"></i>
                        </span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators1" role="button" data-slide="next">
                        <span class="carousel-control-custom-icon" aria-hidden="true">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="contenedor_comprar">
        <div class="compra">
            <h2>COMPRAR</h2>
            <p class="detalles"><b>Destino:</b> <?php echo htmlspecialchars($paquete['d_nombre']); ?></p>
            <p class="detalles"><b>Alojamiento:</b> <?php echo htmlspecialchars($paquete['a_nombre']); ?></p>
            <p class="detalles"><b>Transporte:</b> <?php echo htmlspecialchars($paquete['t_tipo']); ?></p>
            <p class="detalles"><b>Max personas:</b> 5</p>
            <p class="detalles precio"><?php echo htmlspecialchars((int)$paquete['p_precio_total']); ?>bs </p>
            
            <div class="botones">
                <a href="" class="item reserva" id="btn_reserva">RESERVAR</a>
                <a href="" class="item compra" 
                id="btn_comprar"
                data-idpaquete = "<?php echo $paquete['id']; ?>"
                data-iduser = "<?php echo htmlspecialchars($_SESSION['user']['id']); ?>"
                data-destino="<?php echo htmlspecialchars($paquete['d_nombre']); ?>"
                data-alojamiento="<?php echo htmlspecialchars($paquete['a_nombre']); ?>"
                data-transporte="<?php echo htmlspecialchars($paquete['t_tipo']); ?>"
                data-cantidad="5"
                data-precio_total="<?php echo htmlspecialchars((int)$paquete['p_precio_total']); ?>"
                >COMPRAR</a>
            </div>

        </div>

    </div>
</div>

<?php include ROOT_APP . 'views/partials/footer.php'; ?>