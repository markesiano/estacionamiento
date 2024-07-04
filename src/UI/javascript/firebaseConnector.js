import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.1/firebase-app.js";
import { dbFirebaseConfig } from "../../../config/dbFirebase.config.js";
import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.12.1/firebase-analytics.js";
import { getAuth, createUserWithEmailAndPassword, signInWithEmailAndPassword, signOut } from "https://www.gstatic.com/firebasejs/10.12.1/firebase-auth.js";

const app = initializeApp( dbFirebaseConfig.firebaseConfig );
const analytics = getAnalytics(app);
const auth = getAuth();

export class ManageAccount {

    register(email, password,name, tipo, placa) {
      
      createUserWithEmailAndPassword(auth, email, password)
        .then((_) => {
        
          fetch('../controllers/addUser.php', {
              method: 'POST',
              headers: {
                  'Content-Type': 'application/json'
              },
              body: JSON.stringify({
                  nombre: name,
                  correo: email,
                  tipo: tipo,
                  placa: placa
              })

          }).then(response => response.json())
                  .then(result => {
                      if (result.success) {
                          // Mostrar alerta de registro exitoso
                            alert('Te has registrado correctamente'); 
                            window.location.href = "../pages/login.php";
                      } else {
                          alert('Error al crear usuario.');
                      }
                  }).catch(error => {
                      console.error('Error:', error);
                      alert('Error al crear usuario.');
                  });
        })
        .catch((error) => {
          console.error(error.message);
              // Mostrar alerta de error de registro
              alert("Error al registrar: " + error.message);
        });
    }
  
    authenticate(email, password) {
      signInWithEmailAndPassword(auth, email, password)
        .then((_) => {
            fetch('../controllers/controllerLogin.php', {
              method: 'POST',
              headers: {
                  'Content-Type': 'application/json'
              },
              body: JSON.stringify({
                  correo: email,
              })

          }).then(response => response.json())
                  .then(result => {
                      if (result.success) {
                          // Mostrar alerta de registro exitoso
                            window.location.href = "../index.php";
                      } else {
                          alert('Error al iniciar sesión.');
                      }
                  }).catch(error => {
                      console.error('Error:', error);
                      alert('Error al iniciar sesión.');
                  });

        })
        .catch((error) => {
          console.error(error.message);
                  // Mostrar alerta de error de inicio de sesión
                  alert("Error al iniciar sesión: " + error.message);
        });
    }
  
    signOut() {
      signOut(auth)
        .then((_) => {
          window.location.href = "../pages/login.php";
        })
        .catch((error) => {
          console.error(error.message);
        });
    }
}
