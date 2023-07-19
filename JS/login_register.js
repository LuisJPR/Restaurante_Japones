/**
  * 
  * @param {tabId} tabId Pestaña (form) a mostrar en la página de "login_register"
  */
function changeTab(tabId) {
  const loginForm = document.getElementById('login-form');
  const registerForm = document.getElementById('register-form');
  const loginTab = document.querySelector('.tab:nth-child(1)');
  const registerTab = document.querySelector('.tab:nth-child(2)');
  const formContainer = document.querySelector('.form-container');
  const container = document.querySelector('.container');

  if (tabId === 'login') {
    loginForm.style.transform = 'translateX(0)';
    registerForm.style.transform = 'translateX(100%)';
    loginForm.style.opacity = '1';
    registerForm.style.opacity = '0';
    loginForm.classList.add('active');
    registerForm.classList.remove('active');
    loginForm.style.pointerEvents = 'auto'; // Habilitar eventos del formulario de inicio de sesión
    registerForm.style.pointerEvents = 'none'; // Deshabilitar eventos del formulario de registro
    container.style.height = formContainer.offsetHeight + 'px'; // Ajustar altura del contenedor

    loginTab.classList.add('active'); // Agregar clase active a la pestaña de inicio de sesión
    registerTab.classList.remove('active'); // Remover clase active de la pestaña de registro

  } else if (tabId === 'register') {
    loginForm.style.transform = 'translateX(-100%)';
    registerForm.style.transform = 'translateX(0)';
    loginForm.style.opacity = '0';
    registerForm.style.opacity = '1';
    loginForm.classList.remove('active');
    registerForm.classList.add('active');
    loginForm.style.pointerEvents = 'none'; // Deshabilitar eventos del formulario de inicio de sesión
    registerForm.style.pointerEvents = 'auto'; // Habilitar eventos del formulario de registro
    container.style.height = '415px';
  
    loginTab.classList.remove('active'); // Remover clase active de la pestaña de inicio de sesión
    registerTab.classList.add('active'); // Agregar clase active a la pestaña de registro
  }
}

/**
   * Función para validar los campos "name", "email" y "password".
   * @param {string} name
   * @param {string} email El valor del campo de correo electrónico.
   * @param {string} password El valor del campo de contraseña.
   * @returns {string} Un mensaje de error personalizado, o una cadena vacía si no hay errores.
   */
function validarCampos(name, email, password) {
  // Verificar si ambos campos están vacíos
  if (name.trim() === '' && email.trim() === '' && password.trim() === '') {
    return 'Los campos de nombre, correo electrónico y contraseña no pueden estar vacíos. Revise sus datos e intente de nuevo.';
  }
  else if (name.trim() === '') {
    return 'El campo de nombre no puede estar vacío. Revise sus datos e intente de nuevo.';
  }
  else if (email.trim() === '') {
    return 'El campo de correo electrónico no puede estar vacío. Revise sus datos e intente de nuevo.';
  }
  else if (password.trim() === '') {
    return 'El campo de contraseña no puede estar vacío. Revise sus datos e intente de nuevo.';
  } else {
    // Si no hay errores devolver una cadena vacía
    return "";
  }
}

  /**
   * Función para validar los campos "email" y "password".
   * @param {string} email El valor del campo de correo electrónico.
   * @param {string} password El valor del campo de contraseña.
   * @returns {string} Un mensaje de error personalizado, o una cadena vacía si no hay errores.
   */
  function validarCampos(email, password) {
    // Verificar si ambos campos están vacíos
    if (email.trim() === '' && password.trim() === '') {
      return 'Los campos de correo electrónico y contraseña no pueden estar vacíos. Revise sus datos e intente de nuevo.';
    }
    // Verificar si el campo de correo electrónico está vacío
    else if (email.trim() === '') {
      return 'El campo de correo electrónico no puede estar vacío. Revise sus datos e intente de nuevo.';
    }
    // Verificar si el campo de contraseña está vacío
    else if (password.trim() === '') {
      return 'El campo de contraseña no puede estar vacío. Revise sus datos e intente de nuevo.';
    } else {
      // Si no hay errores devolver una cadena vacía
      return "";
    }
  }

document.addEventListener('DOMContentLoaded', function() {
  
  // Mostrar el formulario de inicio de sesión por defecto al cargar la página
  changeTab('login');

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
   * Evento del botón "Iniciar sesión" del Login
   */
  document.getElementById("login-btn").addEventListener("click", function() {
    var email = document.getElementById("login-email").value;
    var password = document.getElementById("login-password").value;
    
    // Validar los campos
    if (validarCampos(email, password) !== '') {
      var msj = '<h1>Alerta</h1><p>' + validarCampos(email, password) + '</p><button class="btn-aceptar" id="btnAceptar">Aceptar</button>';
      crearVentanaEmergente(msj);
      // Vincular el evento onclick del botón "Aceptar" después de agregarlo al DOM
      document.getElementById("btnAceptar").addEventListener("click", cerrarVentanaEmergente);
      return; // Detener la ejecución si hay errores
    }

    // Crear un objeto de datos con los valores del login
    var dataLogin = {
      correo: email,
      clave: password
    };

    var jsonData = JSON.stringify(dataLogin);
    console.log(jsonData);

    // Enviar los datos del form login al archivo PHP usando Axios
    axios.post("PHP/login.php", jsonData)
      .then(function(response) {
        // Manejar la respuesta JSON del archivo PHP
        if (response.data.error) {
          var msj = '<h1>Alerta</h1><p>' + response.data.error + '</p><button class="btn-aceptar" id="btnAceptar">Aceptar</button>';
          crearVentanaEmergente(msj);
          // Vincular el evento onclick del botón "Aceptar" después de agregarlo al DOM
          document.getElementById("btnAceptar").addEventListener("click", cerrarVentanaEmergente);
        } else {
          location.reload();
        }

      })
      .catch(function(error) {
        // Manejar errores en caso de que ocurra alguno
        console.error(error);
        alert("Ocurrió un error en la comunicación con el servidor. Intente de nuevo más tarde.");
        // Recargar la página
        location.reload();
      });

  });

  /**
   * Evento del botón "Registrarse"
   */
  document.getElementById("register-btn").addEventListener("click", function() {
    var name = document.getElementById("register-name").value;
    var email = document.getElementById("register-email").value;
    var password = document.getElementById("register-password").value;

    const validationError = validarCampos(name, email, password);

    // Validar los campos
    if (validationError !== '') {
      var msj = '<h1>Alerta</h1><p>' + validationError + '</p><button class="btn-aceptar" id="btnAceptar">Aceptar</button>';
      crearVentanaEmergente(msj);
      // Vincular el evento onclick del botón "Aceptar" después de agregarlo al DOM
      document.getElementById("btnAceptar").addEventListener("click", cerrarVentanaEmergente);
      return; // Detener la ejecución si hay errores
    }

    // Crear un objeto de datos con los valores del login
    var dataRegister = {
      nombre: name,
      correo: email,
      clave: password
    };

    var jsonDataRegister = JSON.stringify(dataRegister);
    console.log(jsonDataRegister);

    // Enviar los datos del registro al archivo PHP usando Axios
    axios.post("PHP/register.php", jsonDataRegister)
      .then(function(response) {
        // Manejar la respuesta JSON del archivo PHP
        if (response.data.error) {
          var msj = '<h1>Alerta</h1><p>' + response.data.error + '</p><button class="btn-aceptar" id="btnAceptar">Aceptar</button>';
          crearVentanaEmergente(msj);
          // Vincular el evento onclick del botón "Aceptar" después de agregarlo al DOM
          document.getElementById("btnAceptar").addEventListener("click", cerrarVentanaEmergente);
        } else {
          location.reload();
        }

      })
      .catch(function(error) {
        // Manejar errores en caso de que ocurra alguno
        console.error(error);
        alert("Ocurrió un error en la comunicación con el servidor. Intente de nuevo más tarde.");
        // Recargar la página
        location.reload();
      });

  });

});