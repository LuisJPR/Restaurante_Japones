// Código JavaScript para validar los formularios de inicio de sesión y registro
document.getElementById("login-form").addEventListener("submit", function(event) {
  event.preventDefault(); // Evita que el formulario se envíe automáticamente

  // Validar campos y realizar lógica de inicio de sesión aquí
  var email = document.getElementById("login-form").elements["email"].value;
  var password = document.getElementById("login-form").elements["password"].value;

  // Lógica para iniciar sesión...
});

document.getElementById("register-form").addEventListener("submit", function(event) {
  event.preventDefault(); // Evita que el formulario se envíe automáticamente

  // Validar campos y realizar lógica de registro aquí
  var name = document.getElementById("register-form").elements["name"].value;
  var email = document.getElementById("register-form").elements["email"].value;
  var password = document.getElementById("register-form").elements["password"].value;
  var phone = document.getElementById("register-form").elements["phone"].value;
  var address = document.getElementById("register-form").elements["address"].value;

  // Lógica para registrar al usuario...
});

// Código JavaScript para mostrar el historial de compras en la página de perfil
// lista de objetos de historial de compras llamada "purchaseHistory"
var purchaseHistory = [
  { pedido: 1, productos: "Sushi variado", fecha: "2023-06-18", monto: "$25" },
  { pedido: 2, productos: "Tempura mixta", fecha: "2023-06-17", monto: "$15" },
  // Agrega más objetos de historial de compras 
];

var table = document.createElement("table");
var thead = document.createElement("thead");
var tbody = document.createElement("tbody");

// Crear la cabecera de la tabla
var headerRow = document.createElement("tr");
var headers = ["N° Pedido", "Productos", "Fecha de compra", "Monto total de pedido"];

for (var i = 0; i < headers.length; i++) {
  var th = document.createElement("th");
  th.textContent = headers[i];
  headerRow.appendChild(th);
}

thead.appendChild(headerRow);
table.appendChild(thead);

// Crear filas de datos en la tabla
for (var j = 0; j < purchaseHistory.length; j++) {
  var purchase = purchaseHistory[j];
  var row = document.createElement("tr");

  var pedidoCell = document.createElement("td");
  pedidoCell.textContent = purchase.pedido;
  row.appendChild(pedidoCell);

  var productosCell = document.createElement("td");
  productosCell.textContent = purchase.productos;
  row.appendChild(productosCell);

  var fechaCell = document.createElement("td");
  fechaCell.textContent = purchase.fecha;
  row.appendChild(fechaCell);

  var montoCell = document.createElement("td");
  montoCell.textContent = purchase.monto;
  row.appendChild(montoCell);

  tbody.appendChild(row);
}

table.appendChild(tbody);

// Agregar la tabla al elemento con el id "purchase-history"
document.getElementById("purchase-history").appendChild(table);
