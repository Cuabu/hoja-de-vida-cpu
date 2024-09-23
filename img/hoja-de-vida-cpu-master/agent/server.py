from flask import Flask, request, jsonify, render_template_string
import json
import mysql.connector

app = Flask(__name__)
data_store = []

# Conexión a la base de datos
try:
    conn = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="hvcpu"
    )
    print("Conexión establecida con la base de datos")
except mysql.connector.Error as e:
    print(f"Error de conexión a la base de datos: {e}")
    exit()

def check_alerts(data):
    alerts = []
    if data['cpu_percent'] > 80:
        alerts.append(f"Alto Consumo de CPU: {data['cpu_percent']}%")
    if data['memory']['percent'] > 80:
        alerts.append(f"Alto Consumo de Memoria RAM: {data['memory']['percent']}%")
    if data['disk']['percent'] > 80:
        alerts.append(f"Alto Consumo de DISCO: {data['disk']['percent']}%")
    return alerts

@app.route('/receive_data', methods=['POST'])
def receive_data():
    data = request.get_json()
    if data:
        print("Received data:", json.dumps(data, indent=4))
        data_store.insert(0, {
            'data': data,
            'alerts': check_alerts(data)
        })  # Insertar al principio de la lista para que los nuevos datos estén arriba
        
        # Insertar alerta en la base de datos
        try:
            cursor = conn.cursor()
            for alerta in check_alerts(data):
                sql = "INSERT INTO alertas (mensaje) VALUES (%s)"
                cursor.execute(sql, (alerta,))
                conn.commit()
            cursor.close()
        except mysql.connector.Error as e:
            print(f"Error al insertar alerta en la base de datos: {e}")

        return jsonify({"status": "success"}), 200
    else:
        return jsonify({"status": "no data"}), 400

@app.route('/')
def index():
    return render_template_string("""
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="refresh" content="10"> <!-- Recargar la página cada 10 segundos -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <title>Datos del Sistema</title>
        <style>
            header {
                text-align: center; /* Centrar contenido dentro del header */
            }
            header img {
                display: inline-block; /* Alinear la imagen como bloque en línea */
                padding-top: 10px;
                margin-top: 10px;
            }
            .table .thead-dark th {
                color: #fff;
                background-color: #8c2525;
                border-color: #454d55;
            }
        </style>
    </head>
    <body>
        <header>
            <img src="https://booked.unilibre.edu.co/Web/img/custom-logo.png?2.7.6" title="Unilibre - Planificación" alt="Unilibre - Planificación">
            <!-- Contenido adicional del encabezado si es necesario -->
        </header>
        <br>
        <style> 
        .table .thead-dark th {
        color: #fff;
        background-color: #8c2525;
        border-color: #454d55;
        </style>
        <div class="container mt-4">
            <h1 class="text-center">Datos Del Sistema</h1>
            {% for entry in data %}
                {% for alert in entry.alerts %}
                <div class="alert alert-danger" role="alert">
                    {{ alert }}
                </div>
                {% endfor %}
            {% endfor %}
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">CPU </th>
                        <th scope="col">Memoria RAM</th>
                        <th scope="col">Disco Duro</th>
                        <th scope="col">Conexion De Red</th>
                    </tr>
                </thead>
                <tbody>
                    {% for entry in data %}
                    <tr>
                        <td>{{ entry.data.cpu_percent }}%</td>
                        <td>
                            Total: {{ entry.data.memory.total }}<br>
                            Disponible: {{ entry.data.memory.available }}<br>
                            Usada: {{ entry.data.memory.used }}<br>
                            Porcentaje: {{ entry.data.memory.percent }}%
                        </td>
                        <td>
                            Total: {{ entry.data.disk.total }}<br>
                            Usada: {{ entry.data.disk.used }}<br>
                            Libre: {{ entry.data.disk.free }}<br>
                            Porcentaje: {{ entry.data.disk.percent }}%
                        </td>
                        <td>
                            Bytes Enviados: {{ entry.data.network.bytes_sent }}<br>
                            Bytes Recibidos: {{ entry.data.network.bytes_recv }}<br>
                            Packets Enviados: {{ entry.data.network.packets_sent }}<br>
                            Packets Recibidos: {{ entry.data.network.packets_recv }}
                        </td>
                    </tr>
                    {% endfor %}
                </tbody>
            </table>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script>
            async function fetchDataAndUpdate() {
                try {
                    const response = await fetch('/receive_data', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            message: 'fetch data'
                        })
                    });
                    if (response.status === 200) {
                        location.reload();  // Recargar la página si se reciben nuevos datos
                    } else {
                        console.error('Failed to fetch data:', response.statusText);
                    }
                } catch (error) {
                    console.error('Error fetching data:', error);
                }
            }

            function startFetching() {
                fetchDataAndUpdate();
                setInterval(fetchDataAndUpdate, 10000);  // Actualizar cada 10 segundos
            }

            window.onload = startFetching;
        </script>
    </body>
    </html>
    """, data=data_store)

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)
