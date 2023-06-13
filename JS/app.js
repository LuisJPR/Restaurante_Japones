// console.log("Hola Mundo");
// CODIGO PARA EL FILTRO DE MENU
const imagenes = document.querySelectorAll('img');
const btnTodos = document.querySelector('.todos');
const btnDesayunos = document.querySelector('.desayunos');
const btnEntradas = document.querySelector('.entradas');
const btnRamen = document.querySelector('.ramen');
const btnFideos = document.querySelector('.fideos');
const btnPicantes = document.querySelector('.picantes');
const btnPostres = document.querySelector('.postres');
const btnBebidas = document.querySelector('.bebidas');
const contenedorPlatillos = document.querySelector('.platillos');

document.addEventListener('DOMContentLoaded', ()=>{
    platillos();
})

// CARGA DE IMAGENES
const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
        if(entry.isIntersecting){
            const imagen = entry.target;
            imagen.src = imagen.dataset.src;
            observer.unobserve(imagen);
        }
    });
});
imagenes.forEach(imagen => {
    observer.observe(imagen);
});

//FILTRO DEL MENU
const platillos = () => {
    let platillosArreglo = [];  //Creamos un arreglo para almacenar los platillos
    const platillos = document.querySelectorAll('.platillo');
    // console.log(platillos);
    platillos.forEach(platillo => platillosArreglo = [...platillosArreglo, platillo]);
    // Filtro de platillos
    const desayunos = platillosArreglo.filter(desayuno => desayuno.getAttribute('data-platillo') === 'desayunos');
    const entradas = platillosArreglo.filter(entrada => entrada.getAttribute('data-platillo') === 'entradas');
    const ramen = platillosArreglo.filter(ramens => ramens.getAttribute('data-platillo') === 'ramen');
    const fideos = platillosArreglo.filter(fideo => fideo.getAttribute('data-platillo') === 'fideos');
    const picantes = platillosArreglo.filter(picante => picante.getAttribute('data-platillo') === 'picantes');
    const postres = platillosArreglo.filter(postre => postre.getAttribute('data-platillo') === 'postres');
    const bebidas = platillosArreglo.filter(bebida => bebida.getAttribute('data-platillo') === 'bebidas');
    // console.log(bebidas);
    mostrarPlatillos(desayunos, entradas, ramen, fideos, picantes, postres, bebidas, platillosArreglo);
}
const mostrarPlatillos = (desayunos, entradas, ramen, fideos, picantes, postres, bebidas, todos) => {
    btnDesayunos.addEventListener('click', () =>{
        limpiarHTML(contenedorPlatillos);
        desayunos.forEach(desayuno => contenedorPlatillos.appendChild(desayuno));
    });
    btnEntradas.addEventListener('click', () =>{
        limpiarHTML(contenedorPlatillos);
        entradas.forEach(entrada => contenedorPlatillos.appendChild(entrada));
    });
    btnRamen.addEventListener('click', () =>{
        limpiarHTML(contenedorPlatillos);
        ramen.forEach(ramen => contenedorPlatillos.appendChild(ramen));
    });
    btnFideos.addEventListener('click', () =>{
        limpiarHTML(contenedorPlatillos);
        fideos.forEach(fideo => contenedorPlatillos.appendChild(fideo));
    });
    btnPicantes.addEventListener('click', () =>{
        limpiarHTML(contenedorPlatillos);
        picantes.forEach(picante => contenedorPlatillos.appendChild(picante));
    })
    btnPostres.addEventListener('click', () =>{
        limpiarHTML(contenedorPlatillos);
        postres.forEach(postre => contenedorPlatillos.appendChild(postre));
    })
    btnBebidas.addEventListener('click', () =>{
        limpiarHTML(contenedorPlatillos);
        bebidas.forEach(bebida => contenedorPlatillos.appendChild(bebida));
    })
    btnTodos.addEventListener('click', () =>{
        limpiarHTML(contenedorPlatillos);
        todos.forEach(todo => contenedorPlatillos.appendChild(todo));
    })
};

// LIMPIAR HTML
const limpiarHTML = (contenedor) =>{
    while(contenedor.firstChild){
        contenedor.removeChild(contenedor.firstChild);
    }
}

//===========================================================================================

//CODIGO DEL CARRITO DE COMPRAS
const carrito = document.querySelector('#carrito');
const contenedorCarrito = document.querySelector('#lista-carrito tbody');
const vaciarCarritoBtn = document.querySelector('#vaciar-carrito');
const listaPlatillos = document.querySelector('#lista-platillos');
let articulosCarrito = [];

cargarEventListener();
function cargarEventListener(){
    // Cuando agregar un platillo presionando "Agregar al carrito"
    listaPlatillos.addEventListener('click', agregarPlatillo);

    // Elimina platillos del carrito
    carrito.addEventListener('click', eliminarPlatillo);

    // Vaciar el carrito
    vaciarCarritoBtn.addEventListener('click', () => {
        //console.log('Vaciar el carrito');
        articulosCarrito = [];  //reseteamos el arreglo
        limpiarHTML2();  //Eliminamos todo el HTMl
    })
}
//FUNCIONES
function agregarPlatillo(e){
    e.preventDefault();
    if(e.target.classList.contains('agregar-carrito')){
        const platilloSeleccionado = e.target.parentElement.parentElement; 
        //console.log(e.target.parentElement.parentElement);  //.parentElement para aceeder al elemento padre
        leerDatosPlatillo(platilloSeleccionado);
    }
}
//ELIMINA UN PLATILLO DEL CARRITO
function eliminarPlatillo(e){
    console.log(e.target.classList);
    if(e.target.classList.contains('borrar-curso')){
        const platilloId = e.target.getAttribute('data-id');

        //Elimina del arreglo de articulosCarrito por el data-id
        articulosCarrito = articulosCarrito.filter(platillo => platillo.id !== platilloId);
        //console.log(articulosCarrito);
        carritoHTML();  //Iterar sobre el carrito y mostrar su HTML
    }
}

//LEEMOS EL CONTENIDO DEL HTML AL QUE LE DIMOS CLICK Y EXTRAE LA INFORMACION DEL PLATILLO
function leerDatosPlatillo(platillo){
    //console.log(platillo);
    //CREAMOS UN OBJETO CON EL CONTENIDO DEL PLATILLO ACTUAL
    const infoPlatillo = {
        imagen: platillo.querySelector('img').src,
        titulo: platillo.querySelector('h2').textContent,
        precio: platillo.querySelector('.precio p').textContent,
        id: platillo.querySelector('button').getAttribute('data-id'),
        cantidad: 1,
    }
    //REVISA SI UN ELEMENTO YA EXISTE EN EL CARRITO
    const exite = articulosCarrito.some(platillo => platillo.id === infoPlatillo.id);
    //console.log(exite);
    if(exite){
        //Actualizamos la cantidad
        const platillos = articulosCarrito.map( platillo => {
            if(platillo.id === infoPlatillo.id){
                platillo.cantidad++;
                return platillo;  //retorna el objeto actualizado
            } else{
                return platillo;  //retorna los objetos que no son los duplicados
            }
        });
        articulosCarrito = [...platillos];
    } else{
        //Agregamos elementos al arreglo de carrito
        articulosCarrito = [...articulosCarrito, infoPlatillo];
    }

    //console.log(infoPlatillo);
    console.log(articulosCarrito);
    carritoHTML();
}
//MOSTRANDO EL CARRITO DE COMPRAS EN EL HTML
function carritoHTML(){
    //RECORRE EL HTML
    limpiarHTML2();

    //RECORRE EL CARRITO Y GENERA EL HTML
    articulosCarrito.forEach( platillo => {
        const {imagen, titulo, precio, cantidad, id} = platillo;
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>
                <img src="${imagen}" width="100">
            </td>
            <td>${titulo}</td>
            <td>${precio}</td>
            <td>${cantidad}</td>
            <td>
                <a href="#" class="borrar-curso" data-id="${id}"> X </a>
            </td>
        `;
        //AGREGA EL HTML DEL CARRITO EN EL TBODY
        contenedorCarrito.appendChild(row);
    })
}
//ELIMINA LOS CURSOS DEL TBODY
function limpiarHTML2(){
    //FORMA LENTA
    //contenedorCarrito.innerHTML = '';

    while(contenedorCarrito.firstChild){
        contenedorCarrito.removeChild(contenedorCarrito.firstChild);
    }
}

//MENU RESPONSIVO
function togglenav() {
    var div = document.getElementById("navmovil");
    if (div.style.display === "none") {
      div.style.display = "block";
    } else {
      div.style.display = "none";
    }
}