document.querySelectorAll(".brand-link").forEach((link) => {
  link.addEventListener("click", (e) => {
    e.preventDefault();
    window.location.reload();
  });
});

const nav_bar = document.getElementById("navbar");

window.addEventListener("scroll", () => {
  if (window.scrollY > 0) {
    nav_bar.classList.add("scrolled");
  } else {
    nav_bar.classList.remove("scrolled");
  }
});

document.addEventListener("DOMContentLoaded", () => {
  const menuLinks = document.querySelectorAll('.menu-link[data-ajax="true"]');
  const content = document.getElementById("content"); // Contenedor para cargar las vistas
  menuLinks.forEach((link) => {
    link.addEventListener("click", async (e) => {
      e.preventDefault();

      // Resaltar el enlace activo
      menuLinks.forEach((l) => l.classList.remove("active"));
      link.classList.add("active");

      const url = link.dataset.url;

      if (!url) {
        console.error("No se encontró la URL en data-url.");
        return;
      }
      content.innerHTML = "<p>Cargando...</p>"; // Mostrar mensaje de carga
      try {
        // Hacer la solicitud con Fetch
        const response = await fetch(url);
        if (!response.ok) {
          throw new Error(`Error en la solicitud: ${response.statusText}`);
        }
        const html = await response.text();
        content.innerHTML = html; // Insertar el contenido HTML cargado
        reload_script("#content");
      } catch (error) {
        console.error(error);
        content.innerHTML = "<p>Error al cargar la vista.</p>";
      }
    });
  });
});


async function enviar_solicitud(
  url,
  method,
  data,
  mostrar_notificacion,
  callback
) {
  try {
    const options = {
      method: method,
    };

    if (data instanceof FormData) {
      // Si los datos son FormData, no necesitamos establecer el tipo de contenido
      options.body = data;
    } else {
      // Si no son FormData, los convertimos a JSON
      options.headers = {
        "Content-Type": "application/json",
      };
      if (method === "POST") {
        options.body = JSON.stringify(data);
      }
    }

    const response = await fetch(url, options);

    if (!response.ok) {
      throw new Error(`Error en la solicitud: ${response.statusText}`);
    }

    const resultado = await response.json();

    callback(resultado);

  } catch (error) {
    console.error(error);
  }
}

function reload_script(dom) {

  $(dom).find(".contenedor_paquetes").each(function () {
    const contenedor = $(this); // Selecciona el contenedor actual
    enviar_solicitud('view/paquetes/obtener', 'GET', {}, false, function (result) {

      if (result.success) {
        const paquetes = result.data;
        $('.contenedor_paquetes').html(paquetes);
      } else {
        $('.contenedor_paquetes').html("error en cargar paquetes");
      }
    });

    contenedor.on('click', '#btn_detalle', function (e) {
      const id = $(this).data("id"); // Obtén el atributo data-id del botón
      enviar_solicitud(`view/paquetes/detalle`, 'POST', { id: id }, false, function (result) {
        if (result.success) {
          const paquete = result.data;
          $('#content').html(paquete);
          reload_script("#content");
        } else {
          $('#content').html("error en cargar compra");
        }
      });
    });

  });

  $(dom).find(".contenedor_comprar").each(function () {
    const contenedor = $(this); // Selecciona el contenedor actual

    contenedor.on('click', '#btn_comprar', function (e) {
      e.preventDefault();

      const id_paquete = $(this).data("idpaquete");
      const id_user = $(this).data("iduser");
      const destino = $(this).data("destino");
      const alojamiento = $(this).data("alojamiento");
      const trasporte = $(this).data("transporte");
      const precio = $(this).data("precio_total");
      const codigo_secreto = generarCodigoSecreto();
      const cantidad = $(this).data("cantidad");
      const url = "paquetes/comprar";
      configurarModal({ destino, alojamiento, trasporte,cantidad, precio });

      $('#modal-default').modal('show');

      $("#modal-confirm")
        .off("click")
        .on("click", function () {
          const formulario = document.getElementById("form-modal");
          const formData = new FormData(formulario);
          formData.append("id_paquete", id_paquete);
          formData.append("id_user", id_user);
          formData.append("codigo_secreto", codigo_secreto);
          enviar_solicitud(url, 'POST', formData, false, function (result) {
            if (result.success) {
              
              
            } else {
              
            }
          });
          
            
          

          $("#modal-default").modal("hide");
          $(".modal-backdrop").remove(); // Limpia el fondo si es necesario
        });
      
    });

  });

}


function configurarModal(datos) {
  // Cambiar el encabezado y los colores
  $("#modal-header")
    .toggleClass("bg-warning", true)
    
  $("#modal-title").text("PROCESO DE COMPRA");

  // Configurar el modal
  configurarBodyModal(datos);

  // Configurar el botón de confirmación
  $("#modal-confirm")
    .text("Comprar")
    
    
}

function generarCodigoSecreto(longitud = 10) {
  const caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
  let codigo = "";
  
  for (let i = 0; i < longitud; i++) {
    const indiceAleatorio = Math.floor(Math.random() * caracteres.length);
    codigo += caracteres[indiceAleatorio];
  }

  return codigo;
}


function configurarBodyModal(datos) {
  $("#modal-body").html(`
    <form id="form-modal">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="destino">Destino</label>
                <input type="text" class="form-control" name="destino" id="destino" value="${datos.destino}" readonly>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="alojamiento">Alojamiento</label>
                <input type="text" class="form-control" name="alojamiento" id="alojamiento" value="${datos.alojamiento}" readonly>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="transporte">Transporte</label>
                <input type="text" class="form-control" name="transporte" id="transporte" value="${datos.trasporte}" readonly>
            </div>
        <div class="form-group col-md-6">
                <label for="cantidad">Cantidad</label>
                <input type="text" class="form-control" name="cantidad" id="cantidad" value="${datos.cantidad}" readonly>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="precio">Precio</label>
                <input type="text" class="form-control" name="precio" id="precio" value="${datos.precio}" readonly>
            </div>
        </div>
      </form>`);
}