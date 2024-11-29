// Función para actualizar el gráfico usando los datos de la tabla
function updateChartFromTable() {
    const rows = document.querySelectorAll('#jobTableBody tr');
    let onCount = 0;
    let offCount = 0;

    rows.forEach(row => {
        const state = row.cells[0].textContent.trim().toLowerCase();  // Estado en la primera celda
        if (state === 'encendido') {  // Cambia si el estado es en español
            onCount++;
        } else if (state === 'apagado') {
            offCount++;
        }
    });

    // Verificar los conteos
    console.log("Encendidos (on):", onCount);
    console.log("Apagados (off):", offCount);

    // Verifica que existan datos antes de crear el gráfico
    if (onCount === 0 && offCount === 0) {
        console.warn('No hay suficientes datos para mostrar en el gráfico');
        return;
    }

    // const ctx = document.getElementById('ledStateChart').getContext('2d');
    // if (window.ledStateChart) {
    //     window.ledStateChart.destroy(); // Destruir el gráfico anterior si existe
    // }

    // Crear o actualizar el gráfico
//     document.addEventListener('DOMContentLoaded', function () {
//     const canvas = document.getElementById('ledStateChart');
//     if (!canvas) {
//         console.error("El canvas con id 'ledStateChart' no existe.");
//         return;
//     }

//     const ctx = canvas.getContext('2d');
//     if (!ctx) {
//         console.error("No se pudo obtener el contexto del canvas.");
//         return;
//     }

//     if (window.ledStateChart) {
//         window.ledStateChart.destroy();  // Destruir el gráfico anterior si existe
//     }

//     window.ledStateChart = new Chart(ctx, {
//         type: 'pie',
//         data: {
//             labels: ['Encendido', 'Apagado'], // Etiquetas
//             datasets: [{
//                 data: [onCount, offCount],     // Datos
//                 backgroundColor: ['#36A2EB', '#FF6384'],  // Colores
//                 borderWidth: 1
//             }]
//         },
//         options: {
//             responsive: true,
//             plugins: {
//                 legend: {
//                     position: 'top',  // Posición de la leyenda
//                 },
//             },
//         }
//     });
// });


}

// Función para obtener los últimos 10 registros de la base de datos
function fetchLatestJobs() {
    $.ajax({
        url: '/api/get-latest-jobs',
        method: 'GET',
        success: function (data) {
            if (data.length) {
                updateTable(data);  // Actualiza la tabla con los nuevos datos
                updateChartFromTable();  // Actualiza el gráfico usando los datos de la tabla
            }
        },
        error: function (xhr) {
            console.error('Error al obtener los datos:', xhr);
        }
    });
}

// Función para actualizar la tabla con los últimos 10 registros
function updateTable(data) {
    const tbody = document.getElementById('jobTableBody');
    tbody.innerHTML = '';  // Limpiar la tabla antes de agregar nuevas filas

    data.forEach(job => {
        const row = document.createElement('tr');

        // Crear las celdas
        const stateCell = document.createElement('td');
        stateCell.textContent = job.state === 'on' ? 'Encendido' : 'Apagado';

        const timestampCell = document.createElement('td');
        timestampCell.textContent = new Date(job.timestamp).toLocaleString();

        // Añadir las celdas a la fila
        row.appendChild(stateCell);
        row.appendChild(timestampCell);

        // Añadir la fila a la tabla
        tbody.appendChild(row);
    });
}

// Llamar a fetchLatestJobs cada 5 segundos para actualizar los datos dinámicamente
setInterval(fetchLatestJobs, 5000);

// Llamada inicial para cargar los datos al cargar la página
fetchLatestJobs();



