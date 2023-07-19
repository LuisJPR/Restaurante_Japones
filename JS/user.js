/**
 * Evento del botón "Modificar Datos" 
 */
document.getElementById("modify-btn").addEventListener("click", function() {
  var inputs = document.getElementsByTagName("input");
  for (var i = 0; i < inputs.length; i++) {
    inputs[i].readOnly = false;
  }

  document.getElementById("save-btn").disabled = false;
  this.disabled = true;
});

/**
 * Cierra la simulación de la ventana emergente en el HTML
 */
function cerrarVentanaEmergente() {
  var fondoTraslucido = document.querySelector('.fondo-traslucido');
  var ventana = document.querySelector('.ventana-emergente');
            
  if (fondoTraslucido) {
      fondoTraslucido.remove();
  }

  if (ventana) {
      ventana.remove();
  }
  location.reload();
}

function logout() {
  // Redirigir al usuario a la página de cierre de sesión
  window.location.href = "PHP/cerrar_sesion.php";
}

/**
 * 
 * Crea una simulación de ventana emergente en el HTML
 * @param {infoVentana} infoVentana Mensaje a mostrar en la ventana emergente 
 */
function crearVentanaEmergente(infoVentana) {
  // Se crea un fondo tenue
  var fondoTraslucido = document.createElement('div');
  fondoTraslucido.className = 'fondo-traslucido';

  // Se crea una simulación de ventana emergente personalizada en la página 
  var ventana = document.createElement('div');
  ventana.className = 'ventana-emergente';
  ventana.innerHTML = infoVentana;
  
  document.body.appendChild(fondoTraslucido);
  document.body.appendChild(ventana);
}

/**
 * Evento del botón "Cerrar sesión"
 */
document.getElementById('logout-btn').addEventListener('click', function() {
  var msj = '<h1>Mensaje</h1><p>Está a punto de cerrar la sesión de su cuenta. ¿Continuar?</p><button class="btn-aceptar" onclick="logout()">Sí, continuar</button><button class="btn-cancelar" onclick="cerrarVentanaEmergente()">Cancelar</button>';
  crearVentanaEmergente(msj);
});

/**
 * Evento del botón "Guardar Cambios" del perfil de usuario
 */
document.getElementById("save-btn").addEventListener("click", function() {
  var name = document.getElementById("name").value;
  var email = document.getElementById("email").value;
  var password = document.getElementById("password").value;
  var address = document.getElementById("address").value;

  // Crear un objeto de datos con los valores del perfil de usuario
  var userData = {
    nombre: name,
    correo: email,
    clave: password,
    direccion: address
  };

  var jsonData = JSON.stringify(userData);

  // Enviar los datos del perfil de usuario al archivo PHP usando Axios
  axios.post("PHP/update_data.php", jsonData)
    .then(function(response) {
      // Manejar la respuesta JSON del archivo PHP  
      if (response.data.error) {
        var msj = '<h1>Alerta</h1><p>' + response.data.error + '</p><button class="btn-aceptar" id="btnAceptar">Aceptar</button>';
          crearVentanaEmergente(msj);
          // Vincular el evento onclick del botón "Aceptar" después de agregarlo al DOM
          document.getElementById("btnAceptar").addEventListener("click", cerrarVentanaEmergente);

      } else {
        var msj = '<h1>Mensaje</h1><p>Los datos se actualizaron exitosamente en el servidor.</p><button class="btn-aceptar" id="btnAceptar">Aceptar</button>';
        crearVentanaEmergente(msj);
        document.getElementById("btnAceptar").addEventListener("click", cerrarVentanaEmergente);

      }

    })
    .catch(function(error) {
      // Manejar errores en caso de que ocurra alguno
      console.error(error);
      alert("Ocurrió un error en la comunicación con el servidor. Intente de nuevo más tarde.");
      // Recargar la página
      location.reload();
    });

  var inputs = document.getElementsByTagName("input");
  for (var i = 0; i < inputs.length; i++) {
    inputs[i].readOnly = true;
  }

  this.disabled = true;
  document.getElementById("modify-btn").disabled = false;
});

function borrarCuenta() {
  // Redirigir al usuario a la página de cierre de sesión
  window.location.href = "PHP/eliminar_usuario.php";
}

/**
 * Evento del botón "Eliminar Cuenta"
 */
document.getElementById("delete-btn").addEventListener("click", function() {
  var msj = '<h1>Atención</h1><p>Está a punto de eliminar su cuenta. Esta acción es irreversible. ¿Continuar?</p><button class="btn-aceptar" onclick="borrarCuenta()">Sí, continuar</button><button class="btn-cancelar" onclick="cerrarVentanaEmergente()">Cancelar</button>';
  crearVentanaEmergente(msj);
});