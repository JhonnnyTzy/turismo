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
          // reload_script("#content");
        } catch (error) {
          console.error(error);
          content.innerHTML = "<p>Error al cargar la vista.</p>";
        }
      });
    });
  });