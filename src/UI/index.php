<?php
session_start();
$nombre = $_SESSION['cliente'];
$correo = $_SESSION['correo'];
$tipo = $_SESSION['tipo'];
$placa = $_SESSION['placa'];

if (!isset($nombre) || !isset($correo) || !isset($tipo) || !isset($placa)) {
    header("Location: pages/login.php");
    exit();
}
date_default_timezone_set('America/Mexico_City');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estacionamiento</title>
    <link rel="stylesheet" href="css/style.css">
    <script type="module" src="javascript/firebaseConnector.js"></script>
    <link rel="stylesheet" href="css/commentStyle.css">
    <link rel="stylesheet" href="css/headerStyle.css">
    <link rel="stylesheet" href="css/containerInforme.css">
    <script src="javascript/comments.js"  defer></script>
    <script src="javascript/informe.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js" ></script>


</head>
<body>

<!-- User Header -->
<header class="header-container">
    <div class="user-info">
        <div class="info-item">
            <span class="info-label">Nombre:</span>
            <span class="info-value"><?php echo $nombre; ?></span>
        </div>
        <div class="info-item">
            <span class="info-label">Correo:</span>
            <span class="info-value"><?php echo $correo; ?></span>
        </div>

    </div>
    <div class = "user-info">
        <div class="info-item">
            <span class="info-label">Automóvil:</span>
            <span class="info-value"><?php echo $tipo; ?></span>
        </div>
        <div class="info-item">
            <span class="info-label">Placa:</span>
            <span class="info-value"><?php echo $placa; ?></span>
        </div>

    </div>
    
    <?php if ($nombre === "ADMIN"): ?>
    <button id="openInformModal" class="inform-button">Informes</button>
    <?php endif; ?>


    <form action="controllers/logout.php" method="post" class="logout-form">
        <button type="submit" class="logout-button">Cerrar sesión</button>
    </form>
</header>

<?php if ($nombre === "ADMIN"): ?>
<!-- Modal para el informe -->
<div id="informModal" class="modal1">
    <div class="modal-content1">
        <span class="close">&times;</span>
        <div class="inform-container">
            <div class="title-container" style="margin-top: 20px; text-align:center;">
                <h1>Informes</h1>
                <input type="date" id="datePicker" value="<?php echo date('Y-m-d'); ?>">
            </div>
            <div class="datos-informe" id="informDataContainer">
                <!-- Aquí se cargará la tabla y la gráfica -->
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<div class="inform-container">
    <div class="data-parking">
        <div class="parking-lot" id="parking-lot">
                <!-- Parking spots will be dynamically generated here -->
        </div>
    </div>
</div>



<!-- Mostrar comentarios -->
<div class="comments-section">
    <h2>Comentarios</h2>
    <form id="commentForm">
        <textarea id="commentText" name="comment" rows="4" placeholder="Nuevo comentario"></textarea>
        <button type="button" id="submitComment">Agregar</button>
    </form>
    <div class="comments-list" id="commentsList">
        <!-- Aquí se cargarán los comentarios -->
    </div>
</div>



<!-- Modal for confirming the removal of a parking spot -->
<div id="removeModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Retirar estacionamiento</h2>
        <p>¿Estás seguro de que deseas retirar?</p>
        <button id="confirmRemove">Confirmar</button>
        <button id="cancelRemove">Cancelar</button>
    </div>
</div>

<!-- Modal for parking or reserving a spot -->
<div id="actionModal" class="modal">
    <div class="modal-content">
        <span class="close-action">&times;</span>
        <h2>Acción de Estacionamiento</h2>
        <p>¿Qué desea hacer?</p>
        <button id="parkBtn">Estacionar</button>
        <button id="reserveBtn">Reservar</button>
    </div>
</div>

<!-- Modal for reserving a spot -->
<div id="reserveModal" class="modal">
    <div class="modal-content">
        <span class="close-reserve">&times;</span>
        <h2>Reservar Estacionamiento</h2>
        <label for="reservationTime">Hora de Reserva:</label>
        <input type="time" id="reservationTime" name="reservationTime" required>
        <button id="confirmReserve">Confirmar Reserva</button>
        <button id="cancelReserve">Cancelar</button>
    </div>
</div>

<?php 
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/CompositionRoot/EstacionamientoDataFactory.php';

    $estacionamientoViewModel = EstacionamientoDataFactory::create();
    $parkingData = [];

    foreach($estacionamientoViewModel->onAppear() as $estacionamiento){
        $parkingData[$estacionamiento->getLugar()] = [
            'lugar' => $estacionamiento->getLugar(),
            'situacion' => $estacionamiento->getSituacion(),
            'cliente' => $estacionamiento->getCliente(),
            'automovil' => $estacionamiento->getAutomovil(),
            'placas' => $estacionamiento->getPlacas(),
            'horaEntrada' => $estacionamiento->getHoraEntrada(),
            'horaSalida' => $estacionamiento->getHoraSalida()
        ];
    }

    // Ensure all 12 places are initialized
    for ($i = 1; $i <= 12; $i++) {
        if (!isset($parkingData[$i])) {
            $parkingData[$i] = [
                'lugar' => $i,
                'situacion' => false,
                'cliente' => "",
                'automovil' => "",
                'placas' => "",
                'horaEntrada' => "",
                'horaSalida' => ""
            ];
        }
    }

    // Reindex array to be 0-based for JavaScript
    $parkingData = array_values($parkingData);
?>

<script>
    const nombre = <?php echo json_encode($nombre); ?>;
    const placa = <?php echo json_encode($placa); ?>;
</script>

<script>
    // Pass PHP data to JavaScript
    const parkingData = <?php echo json_encode($parkingData); ?>;

    document.addEventListener('DOMContentLoaded', () => {
        const parkingLot = document.getElementById('parking-lot');
        const actionModal = document.getElementById('actionModal');
        const reserveModal = document.getElementById('reserveModal');
        const closeActionModal = document.getElementsByClassName('close-action')[0];
        const closeReserveModal = document.getElementsByClassName('close-reserve')[0];
        const parkBtn = document.getElementById('parkBtn');
        const reserveBtn = document.getElementById('reserveBtn');
        const confirmReserveBtn = document.getElementById('confirmReserve');
        const cancelReserveBtn = document.getElementById('cancelReserve');
        const removeModal = document.getElementById('removeModal');
        const span = document.getElementsByClassName('close');
        const confirmRemoveBtn = document.getElementById('confirmRemove');
        let lugarToRemove = null;
        let selectedSpot = null;

        const topRow = document.createElement('div');
        topRow.className = 'parking-row';
        const bottomRow = document.createElement('div');
        bottomRow.className = 'parking-row';

        // Helper function to create parking spot
        function createParkingSpot(spot) {
            const spotDiv = document.createElement('div');
            spotDiv.className = spot.situacion ? (spot.situacion === "Ocupado" ? 'parking-spot occupied' : 'parking-spot reserved') : 'parking-spot empty';
            spotDiv.dataset.info = JSON.stringify(spot);

            if (!spot.situacion) {
                spotDiv.addEventListener('click', () => {
                    selectedSpot = spot;
                    actionModal.style.display = "block";
                });
            } else if (spot.situacion === "Ocupado") {
                // Resto del código para spots ocupados...
                spotDiv.addEventListener('click', () => {
                    const spotInfo = JSON.parse(spotDiv.dataset.info);
                    if (nombre === "ADMIN" || spotInfo.placas === placa) {
                        lugarToRemove = spot.lugar;
                        removeModal.style.display = "block";
                    } else {
                        alert('No tiene permiso para retirar este vehículo.');
                    }
                });
                const infoDiv = document.createElement('div');
                infoDiv.className = 'info';
                infoDiv.innerHTML = `
                    <p><strong>Lugar:</strong> ${spot.lugar}</p>
                    <p><strong>Situación:</strong> Ocupado</p>
                    <p><strong>Cliente:</strong> ${spot.cliente}</p>
                    <p><strong>Automóvil:</strong> ${spot.automovil}</p>
                    <p><strong>Placas:</strong> ${spot.placas}</p>
                    <p><strong>Hora entrada:</strong> ${spot.horaEntrada}</p>
                    <p><strong>Hora salida:</strong> ${spot.horaSalida}</p>
                `;
                spotDiv.appendChild(infoDiv);
            } else {
                spotDiv.addEventListener('click', () => {
                    const spotInfo = JSON.parse(spotDiv.dataset.info);
                    if (nombre === "ADMIN" || spotInfo.placas === placa) {
                        lugarToRemove = spot.lugar;
                        removeModal.style.display = "block";
                    } else {
                        alert('No tiene permiso para quitar la reservación.');
                    }
                });
                const infoDiv = document.createElement('div');
                infoDiv.className = 'info';
                infoDiv.innerHTML = `
                    <p><strong>Lugar:</strong> ${spot.lugar}</p>
                    <p><strong>Situación:</strong> Reservado</p>
                    <p><strong>Cliente:</strong> ${spot.cliente}</p>
                    <p><strong>Automóvil:</strong> ${spot.automovil}</p>
                    <p><strong>Placas:</strong> ${spot.placas}</p>
                    <p><strong>Hora entrada:</strong> ${spot.horaEntrada}</p>
                    <p><strong>Hora salida:</strong> En espera </p>
                `;
                spotDiv.appendChild(infoDiv);
            }

            return spotDiv;
        }

        function parkCar(spot) {
            const now = new Date().toTimeString().split(' ')[0];
            const data = {
                lugar: spot.lugar,
                cliente: nombre,
                automovil: "<?php echo $tipo; ?>",
                placas: placa,
                horaEntrada: now,
                reservado: 0
            };
            sendRequest('controllers/executeEstacionamiento.php', data);
        }
        function reserveSpot(spot) {
            const reservationTime = document.getElementById('reservationTime').value;
            const data = {
                lugar: spot.lugar,
                cliente: nombre,
                automovil: "<?php echo $tipo; ?>",
                placas: placa,
                horaEntrada: reservationTime,
                reservado: 1
            };
            sendRequest('controllers/executeEstacionamiento.php', data);
        }
        function sendRequest(url, data) {
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            }).then(response => response.json())
            .then(result => {
                if (result.success) {
                    window.open("controllers/" + result.pdf, '_blank');
                    window.location.reload();
                } else {
                    alert('Error al procesar la solicitud.');
                }
            }).catch(error => {
                console.error('Error:', error);
                alert('Error al procesar la solicitud.');
            });
        }


            // Modal button events
        parkBtn.addEventListener('click', () => {
            parkCar(selectedSpot);
            actionModal.style.display = "none";
        });

        reserveBtn.addEventListener('click', () => {
            actionModal.style.display = "none";
            reserveModal.style.display = "block";
        });

        confirmReserveBtn.addEventListener('click', () => {
            reserveSpot(selectedSpot);
            reserveModal.style.display = "none";
        });

        cancelReserveBtn.addEventListener('click', () => {
            reserveModal.style.display = "none";
        });

        closeActionModal.onclick = function() {
            actionModal.style.display = "none";
        };

        closeReserveModal.onclick = function() {
            reserveModal.style.display = "none";
        };

        window.onclick = function(event) {
            if (event.target == actionModal) {
                actionModal.style.display = "none";
            } else if (event.target == reserveModal) {
                reserveModal.style.display = "none";
            } else if (event.target == removeModal) {
                removeModal.style.display = "none";
            }
        };



        // Create an array to hold the spots
        const topRowSpots = [];
        const bottomRowSpots = [];

        // Add the spots to the correct array based on the place number
        parkingData.forEach((spot) => {
            const spotDiv = createParkingSpot(spot);
            if (spot.lugar <= 6) {
                if (spot.situacion === "Ocupado") {
                    spotDiv.classList.add('from-top'); 
                    setTimeout(() => {
                        spotDiv.classList.remove('from-top', 'from-bottom'); 
                    }, 5000); 
                }
                topRowSpots[spot.lugar - 1] = spotDiv;
            } else {
                if (spot.situacion === "Ocupado") {
                    spotDiv.classList.add('from-bottom'); 
                    setTimeout(() => {
                        spotDiv.classList.remove('from-top', 'from-bottom'); 
                    }, 5000); 
                }
                bottomRowSpots[spot.lugar - 7] = spotDiv;
            }
        });

        // Append the spots to the rows
        topRowSpots.forEach((spot) => topRow.appendChild(spot));
        bottomRowSpots.forEach((spot) => bottomRow.appendChild(spot));

        // Append the rows to the parking lot
        parkingLot.appendChild(topRow);
        parkingLot.appendChild(bottomRow);

        // When the user clicks on <span> (x), close the modal
        Array.from(span).forEach(element => {
            element.onclick = function() {
                removeModal.style.display = "none";
            }
        });



        confirmRemoveBtn.addEventListener('click', function() {
            const spot = parkingData.find(spot => spot.lugar === lugarToRemove);
            fetch('controllers/retireEstacionamiento.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ 
                    lugarretirar: lugarToRemove,
                    cliente: spot.cliente,
                    automovil: spot.automovil,
                    placas: spot.placas,
                    horaEntrada: spot.horaEntrada,
                    reservado: spot.situacion === "Reservado" ? 1 : 0
                 })
            }).then(response => response.json())
            .then(result => {
                if (result.success) {
                    window.open("controllers/"+result.pdf, '_blank'); // Open PDF in new tab
                    window.location.reload();
                } else {
                    alert('Error al retirar el estacionamiento.');
                }
            }).catch(error => {
                console.error('Error:', error);
                alert('Error al retirar el estacionamiento.');
                alert(error.message);
            });
        });

        // Handle cancel removal
        document.getElementById('cancelRemove').addEventListener('click', function() {
            removeModal.style.display = "none";
        });
    });






</script>

</body>
</html>
