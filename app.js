// Obtén referencias a los enlaces y al contenedor
const enlaces = document.querySelectorAll('enlace');
const contenedor = document.getElementById('contentphp');
// Agrega un controlador de eventos a cada enlace
document.querySelectorAll('.enlace').forEach((val,id)=> {
    val.addEventListener('click', (e) => {
        cargarPagina(e.target.dataset.urldestino);
    });
});
// Función para cargar la página PHP
function cargarPagina(urlDestino) {
    var url = urlDestino; // Obtiene la URL del enlace

    // Realiza la solicitud HTTP a la página PHP utilizando fetch
    fetch(url)
        .then(function(response) {
            if (response.ok) {
                return response.text(); // Convierte la respuesta a texto
            }
            throw new Error('Error en la solicitud HTTP');
        })
        .then(function(data) {
            contenedor.innerHTML = '';
            // Actualiza el contenido de la página actual con la respuesta de la página PHP
            let html = new DOMParser().parseFromString(data, 'text/html');
            let js  = document.createElement('script');
            if(html.head.children.length>0){
                js.src = html.head.children[0].src;
                js.defer;
                document.body.appendChild(js);
            }
            contenedor.append(...html.body.children);
        })
        .catch(function(error) {
            console.log('Error: ' + error.message);
        });
}