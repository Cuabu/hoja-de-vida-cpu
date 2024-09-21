import psutil
import requests
import json
import time

def collect_system_data():
    data = {
        "cpu_percent": psutil.cpu_percent(interval=1),
        "memory": {
            "total": psutil.virtual_memory().total,
            "available": psutil.virtual_memory().available,
            "used": psutil.virtual_memory().used,
            "percent": psutil.virtual_memory().percent,
        },
        "disk": {
            "total": psutil.disk_usage('/').total,
            "used": psutil.disk_usage('/').used,
            "free": psutil.disk_usage('/').free,
            "percent": psutil.disk_usage('/').percent,
        },
        "network": psutil.net_io_counters()._asdict(),
    }
    return data

def send_data_to_server(data, server_url):
    try:
        response = requests.post(server_url, json=data)
        response.raise_for_status()
        print(f"Data sent successfully: {response.status_code}")
    except requests.exceptions.RequestException as e:
        print(f"Error sending data: {e}")

def main():
    server_url = 'http://127.0.0.1:5000/receive_data'  # Usa la IP y puerto correctos de tu servidor
    while True:
        data = collect_system_data()
        send_data_to_server(data, server_url)
        time.sleep(10)  # Enviar datos cada 10 segundos

if __name__ == "__main__":
    main()
