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

  document
    .getElementById("addCategorie")
    .addEventListener("click", function () {
      document.getElementById("addCategorieForm").classList.toggle("hidden");
    });

  document.querySelectorAll("[data-addType]").forEach((element) => {
    element.addEventListener("click", function () {
      document.getElementById("addTypeForm").classList.toggle("hidden");
      document.getElementById("id_categorie").value =
        this.getAttribute("data-category-id");
    });
  });

  document.querySelectorAll("[data-addPrevision]").forEach((element) => {
    element.addEventListener("click", function () {
      document.getElementById("addPrevisionForm").classList.toggle("hidden");
      document.getElementById("id_type").value =
        this.getAttribute("data-type-id");
    });
  });
});
