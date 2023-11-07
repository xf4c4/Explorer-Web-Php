document.addEventListener('DOMContentLoaded', function() {
    const popupCrearCarpeta = document.querySelector('.hidden-form-crear-carpeta');
    const popupSubirArchivo = document.querySelector('.hidden-form-subir-archivo');
    const fondoPantalla = document.querySelector(".fondo");
    const backPantallaCreate = document.querySelector(".icon-back-form-create");
    const backPantallaUpdate = document.querySelector(".icon-back-form-update");
    const iconCreate = document.querySelector('.icon-create');
    const iconUpload = document.querySelector('.icon-upload');

    iconCreate.addEventListener('click', function() {
        popupCrearCarpeta.classList.toggle('active');
        popupSubirArchivo.classList.remove('active');
        fondoPantalla.classList.toggle('active2');
    });

    backPantallaCreate.addEventListener("click", () => {
        popupCrearCarpeta.classList.remove('active');
        fondoPantalla.classList.remove("active2");
    });

    backPantallaUpdate.addEventListener("click", () => {
        popupSubirArchivo.classList.remove('active');
        fondoPantalla.classList.remove("active2");
    });

    iconUpload.addEventListener('click', function() {
        popupSubirArchivo.classList.toggle('active');
        popupCrearCarpeta.classList.remove('active');
        fondoPantalla.classList.toggle('active2');
    });
});