<?php if (isset($paquetes)) : foreach ($paquetes as $paquete) : ?>
<div class="paquete">
    <!-- Mostrar solo la primera imagen del JSON -->
    <?php 
    $imagenes = json_decode($paquete['imagenes'], true); // Decodificar el JSON de imágenes
    $ruta = (json_decode($imagenes))[0];
    $info = pathinfo($ruta);
    $archivo = $info['filename'].".webp";
    
    ?>
    <img src="<?php echo URL_RESOURCES; ?>uploads/Destino/<?php echo htmlspecialchars($archivo); ?>" alt="foto_paquete" width="200px">
    
    <p class="nombre"><?php echo htmlspecialchars($paquete['nombre']);?></p>
    <a href="<?php echo htmlspecialchars($paquete['coordenadas']);?>" class="maps">Ubicacion</a>
    <div class="info">
        <p class="tipo_paquete"> <?php echo htmlspecialchars($paquete['tipo_paquete']);?></p>
        <p class="precio"> <?php echo htmlspecialchars($paquete['precio_total']);?></p>
    </div>
    <p class="descripcion"><?php echo htmlspecialchars($paquete['descripcion']);?></p>
    <a href="" class="detalle">detalle</a>
</div>
<?php endforeach; endif; ?>
