document.addEventListener("DOMContentLoaded", function () {
  let toggles = JSON.parse(localStorage.getItem("toggles")) ?? {};
  const annee = new URLSearchParams(window.location.search).get("annee");

  document.querySelectorAll("[data-open-id]").forEach((element) => {
    toggles[annee] = toggles[annee] ?? {};
    let toggle = toggles[annee][element.getAttribute("data-open-id")] ?? 0;
    element.setAttribute("data-toggle", toggle);

    if (toggle == 1) fun = (a) => a.parentElement.classList.add("show");
    else fun = (a) => a.parentElement.classList.remove("show");

    document
      .querySelectorAll(
        `[data-opened-id="${element.getAttribute("data-open-id")}"]`
      )
      .forEach(fun);
  });

  document.querySelectorAll("[data-open-id]").forEach((e) => {
    e.addEventListener("click", (ev) => {
      let toggle = e.getAttribute("data-toggle");
      toggle = !toggle ? 1 : (Number(toggle) + 1) % 2;

      let fun;

      if (toggle == 1) fun = (a) => a.parentElement.classList.add("show");
      else fun = (a) => a.parentElement.classList.remove("show");

      document
        .querySelectorAll(
          `[data-opened-id="${e.getAttribute("data-open-id")}"]`
        )
        .forEach(fun);

      e.setAttribute("data-toggle", toggle);

      let ensToggle = {};
      document.querySelectorAll("[data-open-id]").forEach((e) => {
        let toggle_ = e.getAttribute("data-toggle") ?? 0;
        toggle_ = Number(toggle_);

        if (e.getAttribute("data-open-id"))
          ensToggle[e.getAttribute("data-open-id")] = toggle_;
      });

      let old = JSON.parse(localStorage.getItem("toggles")) ?? {};
      localStorage.setItem(
        "toggles",
        JSON.stringify({ ...old, [annee]: ensToggle })
      );
    });
  });

  (
    document.getElementById("addCategorie") ?? { addEventListener: () => {} }
  ).addEventListener("click", function () {
    document.getElementById("addCategorieForm").classList.toggle("hidden");
  });

  document.querySelectorAll("[data-addType]").forEach((element) => {
    element.addEventListener("click", function () {
      document.getElementById("addTypeForm").classList.toggle("hidden");
      document.getElementById("id_categorie").value =
        this.getAttribute("data-category-id");
    });
  });

  document.querySelector("#addTypeSelect").addEventListener("click", () => {
    document.getElementById("addTypeSelectForm").classList.toggle("hidden");
  });

  document.querySelectorAll("[data-addPrevision]").forEach((element) => {
    element.addEventListener("click", function () {
      document.getElementById("addPrevisionForm").classList.toggle("hidden");
      document.getElementById("id_type").value =
        this.getAttribute("data-type-id");
    });
  });

  document
    .querySelector("#addPrevisionSelect")
    .addEventListener("click", () => {
      document
        .getElementById("addPrevisionSelectForm")
        .classList.toggle("hidden");
    });

  const container = document.getElementById("content");

  // Restore scroll position
  try {
    const scrollData =
      JSON.parse(localStorage.getItem("containerScroll")) || {};
    if (annee && scrollData[annee]) {
      requestAnimationFrame(() => {
        container.scrollTop = parseInt(scrollData[annee]);
      });
    }
  } catch (err) {
    console.error("Error restoring scroll position:", err);
    localStorage.removeItem("containerScroll");
  }

  // Save scroll position
  if (annee) {
    // Use debouncing to avoid excessive writes to localStorage
    let scrollTimeout;
    container.addEventListener("scroll", () => {
      clearTimeout(scrollTimeout);
      scrollTimeout = setTimeout(() => {
        try {
          const scrollData =
            JSON.parse(localStorage.getItem("containerScroll")) || {};
          scrollData[annee] = container.scrollTop;
          localStorage.setItem("containerScroll", JSON.stringify(scrollData));
        } catch (e) {
          console.error("Error saving scroll position:", e);
        }
      }, 200); // Adjust debounce time as needed (200ms is good for most cases)
    });
  }
});
