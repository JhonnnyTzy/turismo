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

    enviar_solicitud('view/paquetes/obtener', 'GET', {}, false, function (result) {

      if (result.success) {
        const paquetes = result.data;
        $('.contenedor_paquetes').html(paquetes);
      }else{
        $('.contenedor_paquetes').html("error en cargar paquetes");
      }

    });

  });

}
