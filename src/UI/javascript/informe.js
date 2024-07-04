

document.addEventListener('DOMContentLoaded', function () {
    const datePicker = document.getElementById('datePicker');
    const informDataContainer = document.getElementById('informDataContainer');
    const openInformModalBtn = document.getElementById('openInformModal');
    const informModal = document.getElementById('informModal');
    const closeBtn = document.getElementsByClassName('close')[0];


    datePicker.addEventListener('change', function () {
        const selectedDate = datePicker.value;
        fetchInformData(selectedDate);
    });

    function fetchInformData(date) {
        console.log(date);

        fetch('controllers/getInformData.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ date: date })
        }).then(response => response.json())
        .then(data => {
            renderInformData(data);
        }).catch(error => {
            console.error('Error:', error);
            informDataContainer.innerHTML = '<h2>Error al cargar los datos.</h2>';
        });
    }

    function renderInformData(data) {
        informDataContainer.innerHTML = ''; // Limpiar el contenedor antes de renderizar los nuevos datos

        if (data.length > 0) {
            const labels = [];
            const carData = [];
            const timeData = [];

            const table = document.createElement('table');
            table.innerHTML = `
                <tr>
                    <th>Lugar</th>
                    <th>Automóviles</th>
                    <th>Tiempo de ocupación</th>
                    <th>Número de automóviles</th>
                </tr>
            `;

            data.forEach(inform => {
                inform.listaCarrosEstacionados = inform.listaCarrosEstacionados.map(carro => {
                    const [car, plate] = carro.split(' (');
                    return `Carro: ${car}, Placa: ${plate.slice(0, -1)}`;
                });

                

                const row = table.insertRow();
                row.innerHTML = `
                    <td>${inform.lugar}</td>
                    <td>${inform.listaCarrosEstacionados.join('<br>')}</td>
                    <td>${inform.tiempoOcupacion}</td>
                    <td>${inform.nCarrosEstacionados}</td>
                `;

                labels.push(inform.lugar);
                carData.push(inform.nCarrosEstacionados);
                const [hours, minutes] = inform.tiempoOcupacion.split(':').map(Number);
                const totalMinutes = hours * 60 + minutes;
                timeData.push(totalMinutes);
            });

            informDataContainer.appendChild(table);

            const chartContainer = document.createElement('div');
            chartContainer.className = 'chart-container';

            // Crear contenedor y título para la gráfica de barras
            const barChartBox = document.createElement('div');
            barChartBox.className = 'chart-box';
            const barChartTitle = document.createElement('h3');
            barChartTitle.innerText = 'Número de Automóviles por Lugar';
            const barCanvas = document.createElement('canvas');
            barCanvas.id = 'carChart';
            barChartBox.appendChild(barChartTitle);
            barChartBox.appendChild(barCanvas);

            // Crear contenedor y título para la gráfica de pastel
            const pieChartBox = document.createElement('div');
            pieChartBox.className = 'chart-box';
            const pieChartTitle = document.createElement('h3');
            pieChartTitle.innerText = 'Tiempo de Ocupación por Lugar (minutos)';
            const pieCanvas = document.createElement('canvas');
            pieCanvas.id = 'timeChart';
            pieChartBox.appendChild(pieChartTitle);
            pieChartBox.appendChild(pieCanvas);

            chartContainer.appendChild(barChartBox);
            chartContainer.appendChild(pieChartBox);

            informDataContainer.appendChild(chartContainer);

            // Renderizar gráficas
            renderChart('carChart', 'bar', labels, carData, 'Número de Automóviles');
            renderChart('timeChart', 'pie', labels, timeData, 'Tiempo de Ocupación (minutos)');
        } else {
            informDataContainer.innerHTML = '<h2>No hay informes disponibles para esta fecha.</h2>';
        }
    }

    function renderChart(canvasId, chartType, labels, data, label) {
        var ctx = document.getElementById(canvasId).getContext('2d');
        new Chart(ctx, {
            type: chartType,
            data: {
                labels: labels,
                datasets: [{
                    label: label,
                    data: data,
                    backgroundColor: chartType === 'pie' ? [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ] : 'rgba(54, 162, 235, 0.2)',
                    borderColor: chartType === 'pie' ? [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ] : 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: chartType === 'bar' ? {
                    y: {
                        beginAtZero: true
                    }
                } : {}
            }
        });
    }
    openInformModalBtn.addEventListener('click', () => {
        informModal.style.display = 'block';
        fetchInformData(datePicker.value);

    });

    closeBtn.onclick = function() {
        informModal.style.display = "none";
    };

    window.onclick = function(event) {
        if (event.target == informModal) {
            informModal.style.display = "none";
        }
    };
});
