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

// Mostrar el formulario de inicio de sesión por defecto al cargar la página
document.addEventListener('DOMContentLoaded', function() {
  changeTab('login');
});

