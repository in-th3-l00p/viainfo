const name = document.querySelector("#name");

function generateSlug() {
    const slug = document.querySelector("#slug");
    if (slug.value.length === 0)
        slug.value = name.value.toLowerCase().replace(/ /g, "-");
}

name.onchange = () => {
    generateSlug();
}
