async function loadComponent(file, target) {
    const response = await fetch(file);
    const html = await response.text();
    document.querySelector(target).innerHTML = html;
}

loadComponent("components/navbar.html", "#site-header");
loadComponent("components/footer.html", "#site-footer");