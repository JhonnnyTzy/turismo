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
      const listar = link.dataset.listar;
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
        reload_script("#content", listar);
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

    mostrar_toast(resultado, mostrar_notificacion);
  } catch (error) {
    console.error(error);
  }
}

function mostrar_toast(resultado, mostrar_notificacion) {
  if (!mostrar_notificacion) {
    return;
  }
  const toast = document.querySelector(".toast");
  const toastTitle = document.getElementById("toast-titulo");
  const toastMessage = document.getElementById("toast-mensaje");

  if (resultado.success) {
    toast.classList.remove("bg-danger");
    toast.classList.add("bg-success");
    toastTitle.textContent = "Operacion Exitosa";
    toastMessage.textContent = resultado.message;
  } else {
    toast.classList.remove("bg-success");
    toast.classList.add("bg-danger");
    toastTitle.textContent = "Operacion Fallida";
    toastMessage.textContent = resultado.message;
  }
  const bootstrapToast = new bootstrap.Toast(toast);
  bootstrapToast.show();
}

function reload_script(dom, listar) {
  $(dom).find(".select2").select2();
  $(dom).find(".select2bs4").select2({
    theme: "bootstrap4",
  });

  $(dom)
    .find(".form_contenedor")
    .each(function () {
      const container = $(this).data("container");
      const entidad = $(this).data("entidad"); // Ejecutar el Dropzone
      addEventFormulario("uploadForm", generate_Dropzone(container, entidad));
      // Agregar eventos al formulario
    });
  $(dom).find("#temporada").daterangepicker();

  $(dom)
    .find("#duracion")
    .daterangepicker({
      autoApply: true,
      showDropdowns: true,
      minDate: moment(),
      locale: {
        format: "YYYY-MM-DD",
        separator: " - ",
      },
    });

  if (listar) {
    $(dom)
      .find(".table")
      .DataTable({
        responsive: true,
        lengthChange: false,
        autoWidth: false,
        buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
      })
      .buttons()
      .container()
      .appendTo("#example1_wrapper .col-md-6:eq(0)");

    $(dom)
      .find(".table")
      .on("click", ".btn-action", function () {
        const action = $(this).data("action");
        const dt = $(this).data("info");
        const entidad = $(this).data("entidad");
        console.log(action);
        configurarModal(action, dt, entidad);

        // Configuración del botón de confirmación
        $("#modal-confirm")
          .off("click")
          .on("click", function () {
            const formulario = document.getElementById("form-modal");
            const datos = Object.fromEntries(new FormData(formulario));
            const url =
              action === "editar"
                ? entidad + "/actualizar"
                : entidad + "/eliminar";
            const method = "POST";

            enviar_solicitud(url, method, datos, true, function (response) {
              if (response.success) {
                recargarTabla(entidad); // Recarga la tabla después de una acción
              } else {
                console.error("Error: " + response.error);
              }
            });

            $("#modal-default").modal("hide");
            $(".modal-backdrop").remove(); // Limpia el fondo si es necesario
          });
      });
  }

  // BS-Stepper Init
  // Inicializa el BS-Stepper solo si existe el contenedor
  const stepperContainer = document.querySelector(".bs-stepper");
  if (stepperContainer) {
    window.stepper = new Stepper(stepperContainer);
  }
  $(dom)
    .find("#formPaquete")
    .on("submit", function (e) {
      e.preventDefault();
      const formData = new FormData(this);
      enviar_solicitud(
        this.action,
        "POST",
        formData,
        true,
        function (response) {
          if (response.success) {
            $("#content").html(response.html);
            reload_script("#content");
          }
        }
      );
    });
  // Cofigurar selct de departamentos en paquete
  $(dom)
    .find("#select_departamento")
    .on("change", function () {
      const departamentoId = $(this).val();
      $("#s_departamento").text(departamentoId);

      if (departamentoId) {
        // filtar destinos - final
        enviar_solicitud(
          "destino/filtrarD",
          "POST",
          departamentoId,
          false,
          function (response) {
            if (response.success) {
              const selectDestino = document.getElementById("select_destino");
              selectDestino.innerHTML = "";
              response.destinos.forEach((destino) => {
                const option = document.createElement("option");
                option.value = destino.id;
                option.text = destino.nombre;
                selectDestino.appendChild(option);
              });
            }
          }
        );
        //filtrar transportes - Regreso

        enviar_solicitud(
          "transporte/filtrarD",
          "POST",
          departamentoId,
          false,
          function (response) {
            if (response.success) {
              const selectTransporte =
                document.getElementById("select_transporteL");
              selectTransporte.innerHTML = "";
              response.transportes.forEach((transporte) => {
                const option = document.createElement("option");
                option.value = transporte.id;
                option.text = transporte.tipo;
                selectTransporte.appendChild(option);
              });
              $("#ll_departamento").text(departamentoId);
            }
          }
        );

        enviar_solicitud(
          "alojamiento/filtrarD",
          "POST",
          departamentoId,
          false,
          function (response) {
            if (response.success) {
              const selectAlojamiento =
                document.getElementById("select_alojamiento");
              selectAlojamiento.innerHTML = "";
              response.alojamientos.forEach((alojamiento) => {
                const option = document.createElement("option");
                option.value = alojamiento.id;
                option.text = alojamiento.nombre;
                selectAlojamiento.appendChild(option);
              });
              $("#al_departamento").text(departamentoId);
            }
          }
        );
      }
    });

  $(dom)
    .find("#select_departamento_origen")
    .on("change", function () {
      const departamentoId = $(this).val();
      $("#st_departamento").text(departamentoId);

      if (departamentoId) {
        // filtar transporte - Salida
        enviar_solicitud(
          "transporte/filtrarD",
          "POST",
          departamentoId,
          false,
          function (response) {
            if (response.success) {
              const selectTransporteS =
                document.getElementById("select_transporteS");
              selectTransporteS.innerHTML = "";
              response.transportes.forEach((transporte) => {
                const option = document.createElement("option");
                option.value = transporte.id;
                option.text = transporte.tipo;
                selectTransporteS.appendChild(option);
              });
            }
          }
        );
      }
    });
}

var uploadedFilePaths = [];
function generate_Dropzone(id_container, folder) {
  contenedor = document.getElementById(id_container);
  uploadedFilePaths = [];
  // Validar si el contenedor existe
  if (!contenedor) {
    console.error(`No se encontró el contenedor con ID: ${id_container}`);
    return;
  }
  Dropzone.autoDiscover = false;

  let previewNode = document.querySelector("#template");

  // Validar si el elemento #template existe
  if (!previewNode) {
    console.error("El elemento con ID 'template' no existe.");
    return;
  }

  previewNode.id = "";
  let previewTemplate = previewNode.parentNode.innerHTML;
  previewNode.parentNode.removeChild(previewNode);

  const myDropzone = new Dropzone(contenedor, {
    url: "/turismo/app/services/upload.php",
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false,
    previewsContainer: "#previews",
    clickable: ".fileinput-button",
  });

  // Progreso de subida
  myDropzone.on("totaluploadprogress", function (progress) {
    document.querySelector("#total-progress .progress-bar").style.width =
      progress + "%";
  });

  // Agregar archivo a la cola
  myDropzone.on("addedfile", function (file) {
    uploadedFilePaths.push(file.name);
  });

  // Eliminar archivo de la cola
  myDropzone.on("removedfile", function (file) {
    const fileIndex = uploadedFilePaths.indexOf(file.name);
    if (fileIndex !== -1) {
      uploadedFilePaths.splice(fileIndex, 1);
    }
  });

  // Enviar archivo con datos adicionales
  myDropzone.on("sending", function (file, xhr, formData) {
    document.querySelector("#total-progress").style.opacity = "1";
    formData.append("entidad", folder);
  });

  return myDropzone;
}

function addEventFormulario(idForm, myDropzone) {
  formulario = document.getElementById(idForm);
  url = formulario.action;
  formulario.addEventListener("submit", async function (event) {
    event.preventDefault();
    // Enviar datos del formulario al servidor solo después de subir las imágenes
    if (uploadedFilePaths.length === 0) {
      alert("Por favor, sube las imágenes antes de enviar el formulario.");
      return;
    }
    // Recolectar datos del formulario
    const formData = new FormData(event.target);
    // Agregar las rutas al formulario como un campo JSON
    formData.append("imagenes", JSON.stringify(uploadedFilePaths));

    await enviar_solicitud(url, "POST", formData, true, function (result) {
      if (result.success) {
        myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED)); // Subir todos los archivos en cola

        myDropzone.on("queuecomplete", function () {
          document.querySelector("#total-progress").style.opacity = "0";
          myDropzone.removeAllFiles(true); //Limpiar el selecctor de imagenes
        });

        formulario.reset();
      } else {
        console.log(result.message);
      }
    });
  });
}

async function recargarTabla(entidad) {
  const url = "view/" + entidad + "/listar";
  const method = "GET";

  try {
    const response = await fetch(url, { method });
    const html = await response.text();
    const content = document.getElementById("content");
    content.innerHTML = html;
    reload_script("#content");
  } catch (error) {
    console.error(error);
  }
}

// Función para configurar el modal
function configurarModal(action, datos, entidad) {
  const esEditar = action === "editar";
  // Cambiar el encabezado y los colores
  $("#modal-header")
    .toggleClass("bg-warning", esEditar)
    .toggleClass("bg-danger", !esEditar);
  $("#modal-title").text(esEditar ? "Editar Registro" : "Eliminar Registro");

  // Configurar el modal
  configurarBodyModal(entidad, datos, esEditar);

  // Configurar el botón de confirmación
  $("#modal-confirm")
    .text(esEditar ? "Guardar Cambios" : "Eliminar")
    .toggleClass("btn-primary", esEditar)
    .toggleClass("btn-danger", !esEditar);
}
