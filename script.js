(function () {
  const modal = document.getElementById("lightbox");
  const modalImage = document.getElementById("lightboxImage");
  const modalCaption = document.getElementById("lightboxCaption");
  const closeButton = document.getElementById("closeLightbox");
  const prevButton = document.getElementById("prevImage");
  const nextButton = document.getElementById("nextImage");

  let currentItems = [];
  let currentIndex = 0;

  function renderImage(index) {
    const item = currentItems[index];
    if (!item) {
      return;
    }

    modalImage.className = "";
    modalImage.src = item.dataset.src;
    modalImage.alt = item.querySelector("img").alt;
    modalCaption.textContent = item.dataset.title + " (" + (index + 1) + "/" + currentItems.length + ")";

    const effect = item.dataset.effect || "fade";
    modalImage.classList.add("effect-" + effect);
  }

  function openModal(items, index) {
    currentItems = items;
    currentIndex = index;
    modal.classList.add("open");
    document.body.style.overflow = "hidden";
    renderImage(currentIndex);
  }

  function closeModal() {
    modal.classList.remove("open");
    document.body.style.overflow = "";
  }

  function showNext() {
    currentIndex = (currentIndex + 1) % currentItems.length;
    renderImage(currentIndex);
  }

  function showPrev() {
    currentIndex = (currentIndex - 1 + currentItems.length) % currentItems.length;
    renderImage(currentIndex);
  }

  document.querySelectorAll(".gallery-grid").forEach(function (gallery) {
    const items = Array.from(gallery.querySelectorAll(".gallery-item"));

    items.forEach(function (item, index) {
      item.addEventListener("click", function () {
        openModal(items, index);
      });
    });
  });

  closeButton.addEventListener("click", closeModal);
  nextButton.addEventListener("click", showNext);
  prevButton.addEventListener("click", showPrev);

  modal.addEventListener("click", function (event) {
    if (event.target === modal) {
      closeModal();
    }
  });

  document.addEventListener("keydown", function (event) {
    if (!modal.classList.contains("open")) {
      return;
    }

    if (event.key === "Escape") {
      closeModal();
    }

    if (event.key === "ArrowRight") {
      showNext();
    }

    if (event.key === "ArrowLeft") {
      showPrev();
    }
  });

  const jsPrimitives = document.getElementById("jsPrimitives");
  const jsPersona = document.getElementById("jsPersona");
  const jsArrays = document.getElementById("jsArrays");
  const jsFunctions = document.getElementById("jsFunctions");

  const nombreCurso = "Frontend Avanzado";
  const edicion = 2026;
  const precio = 299.95;
  const activo = true;
  const cupoDisponible = null;
  let profesorAsignado;
  const identificador = Symbol("curso-id");
  const totalHoras = BigInt(48);

  const persona = {
    nombre: "Ana",
    rol: "Estudiante",
    experiencia: "Intermedia",
    intereses: ["HTML", "CSS", "JavaScript"]
  };

  const tutor = {
    nombre: "Carlos",
    especialidad: "Arquitectura Frontend",
    activo: true
  };

  const modulos = ["HTML Semantico", "CSS Avanzado", "JavaScript UI", "Accesibilidad"];
  const intereses = ["UX", "Animaciones", "Performance", "Testing"];
  const niveles = [1, 2, 3, 4, 5, 6];

  function formatearPrimitivo(nombre, valor) {
    return nombre + ": " + String(valor) + " (" + typeof valor + ")";
  }

  function resumenPersona(obj) {
    return obj.nombre + " - " + obj.rol + " - Nivel " + obj.experiencia;
  }

  function contarElementos(array) {
    return "Total: " + array.length;
  }

  function unirLista(array) {
    return array.join(", ");
  }

  function crearItem(texto) {
    const li = document.createElement("li");
    li.textContent = texto;
    return li;
  }

  if (jsPrimitives && jsPersona && jsArrays && jsFunctions) {
    const primitivas = [
      formatearPrimitivo("nombreCurso", nombreCurso),
      formatearPrimitivo("edicion", edicion),
      formatearPrimitivo("precio", precio),
      formatearPrimitivo("activo", activo),
      formatearPrimitivo("cupoDisponible", cupoDisponible),
      formatearPrimitivo("profesorAsignado", profesorAsignado),
      formatearPrimitivo("identificador", identificador.description),
      formatearPrimitivo("totalHoras", totalHoras + "n")
    ];

    primitivas.forEach(function (item) {
      jsPrimitives.appendChild(crearItem(item));
    });

    jsPersona.appendChild(crearItem("persona: " + resumenPersona(persona)));
    jsPersona.appendChild(crearItem("intereses de persona: " + unirLista(persona.intereses)));
    jsPersona.appendChild(crearItem("tutor: " + tutor.nombre + " (" + tutor.especialidad + ")"));

    jsArrays.appendChild(crearItem("modulos -> " + unirLista(modulos)));
    jsArrays.appendChild(crearItem("intereses -> " + unirLista(intereses)));
    jsArrays.appendChild(crearItem("niveles -> " + unirLista(niveles)));
    jsArrays.appendChild(crearItem("array de intereses: " + contarElementos(intereses)));

    jsFunctions.appendChild(crearItem("formatearPrimitivo(): convierte valor a texto tipado"));
    jsFunctions.appendChild(crearItem("resumenPersona(): resume datos del objeto persona"));
    jsFunctions.appendChild(crearItem("contarElementos(): cuenta elementos de cualquier array"));
    jsFunctions.appendChild(crearItem("unirLista(): renderiza arrays en una sola linea"));
  }
})();
