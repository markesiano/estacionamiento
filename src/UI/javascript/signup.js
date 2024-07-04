

import { ManageAccount } from './firebaseConnector.js';

document.getElementById("formulario-crear").addEventListener("submit", (event) => {
  event.preventDefault();

  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;
  const name = document.getElementById("name").value;
  const tipo = document.getElementById("tipo").value;
  const placa = document.getElementById("placa").value;

  const account = new ManageAccount();
  account.register(email, password, name, tipo, placa);

});
