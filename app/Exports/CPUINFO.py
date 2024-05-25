import platform
import socket
import psutil
import subprocess
import tkinter as tk
from tkinter import simpledialog
from cryptography.fernet import Fernet
import base64

# Clave estática proporcionada para la encriptación
clave_encriptacion = b'YHQOwpGLmGaHTdlw-8QtBw0RAa77h4Wmf7BzGyQdgdY='
cipher_suite = Fernet(clave_encriptacion)

# Función para obtener la información del sistema
def get_system_info():
    try:
        # Obtener información del sistema operativo
        system_info = platform.uname()

        # Obtener información del procesador
        cpu_info = subprocess.check_output(['wmic', 'cpu', 'get', 'name']).decode().strip().split('\n')[1]

        # Obtener velocidad de reloj del procesador
        cpu_speed_info = subprocess.check_output(['wmic', 'cpu', 'get', 'maxclockspeed']).decode().strip().split('\n')[1]

        # Obtener información de la memoria RAM
        memory_info = subprocess.check_output(['wmic', 'memorychip', 'get', 'capacity']).decode().strip().split('\n')[1]

        # Obtener información extendida de la memoria RAM
        memory_info_extended = subprocess.check_output(['wmic', 'memorychip', 'get', 'Manufacturer,Speed,Capacity,PartNumber']).decode().strip().split('\n')[1:]

        # Obtener información del disco duro
        disk_info = subprocess.check_output(['wmic', 'diskdrive', 'get', 'model']).decode().strip().split('\n')[1]

        # Obtener información extendida del disco duro
        disk_info_extended = subprocess.check_output(['wmic', 'diskdrive', 'get', 'size']).decode().strip().split('\n')[1:]

        # Obtener información de la tarjeta de red
        network_info = get_mac_address()

        # Obtener dirección MAC de la tarjeta de red WiFi
        mac_wifi_info = subprocess.check_output(['wmic', 'nic', 'where', 'NetEnabled=true', 'get', 'MACAddress']).decode().strip().split('\n')[1]

        # Obtener información del BIOS
        bios_info = subprocess.check_output(['wmic', 'bios', 'get', 'serialnumber']).decode().strip().split('\n')[1]

        # Obtener información del adaptador de red
        adapter_info = subprocess.check_output(['wmic', 'nicconfig', 'get', 'description']).decode().strip().split('\n')[1]

        # Obtener información del sistema operativo
        os_info = subprocess.check_output(['wmic', 'os', 'get', 'caption']).decode().strip().split('\n')[1]

        return system_info, cpu_info, cpu_speed_info, memory_info, memory_info_extended, disk_info, disk_info_extended, network_info, mac_wifi_info, bios_info, adapter_info, os_info
    except Exception as e:
        print("Error al obtener la información del sistema:", e)

# Función para obtener la dirección MAC de la tarjeta de red
def get_mac_address():
    try:
        for interface, addresses in psutil.net_if_addrs().items():
            for address in addresses:
                if address.family == psutil.AF_LINK:
                    return address.address
    except Exception as e:
        print("Error al obtener la dirección MAC:", e)

# Función para generar el script SQL
def generate_sql_script(codigo_equipo, nombre_sala, numero_equipo, campus, system_info, cpu_info, cpu_speed_info, memory_info, memory_info_extended, disk_info, disk_info_extended, network_info, mac_wifi_info, bios_info, adapter_info, os_info):
    try:
        # Llenar las variables con datos obtenidos
        nombre_equipo = socket.gethostname()

        # Generar el script SQL con los datos
        sql_script = f"INSERT INTO auto_equipos (codigo_equipo, nombre_sala, nombre_equipo, numero_equipo, campus, memoria_ram, cpu_modelo_serial, disco_duro_modelo_serial, mac_ethernet_serial, mac_wifi_serial, bios_info, adapter_info, os_info, cpu_speed_info, memory_info_extended, disk_info_extended) VALUES ('{codigo_equipo}', '{nombre_sala}', '{nombre_equipo}', '{numero_equipo}', '{campus}', '{memory_info}', '{cpu_info}', '{disk_info}', '{network_info}', '{mac_wifi_info}', '{bios_info}', '{adapter_info}', '{os_info}', '{cpu_speed_info}', '{', '.join(memory_info_extended)}', '{', '.join(disk_info_extended)}');"
        
        # Cifrar el script SQL
        sql_cifrado = cipher_suite.encrypt(sql_script.encode())
        
        return sql_cifrado
    except Exception as e:
        print("Error al generar el script SQL:", e)

# Crear ventana para solicitar la entrada del usuario
def solicitar_entrada():
    try:
        root = tk.Tk()
        root.withdraw()  # Ocultar la ventana principal

        codigo_equipo = simpledialog.askstring("Código de Equipo", "Ingrese el código del equipo:")
        nombre_sala = simpledialog.askstring("Nombre de Sala", "Ingrese el nombre de la sala o oficina:")
        numero_equipo = simpledialog.askstring("Número de Equipo", "Ingrese el número del equipo:")
        campus = simpledialog.askstring("Campus", "Ingrese el nombre del campus:")

        return codigo_equipo, nombre_sala, numero_equipo, campus
    except Exception as e:
        print("Error al solicitar la entrada:", e)

# Obtener entrada del usuario
codigo_equipo, nombre_sala, numero_equipo, campus = solicitar_entrada()

# Obtener información del sistema
system_info, cpu_info, cpu_speed_info, memory_info, memory_info_extended, disk_info, disk_info_extended, network_info, mac_wifi_info, bios_info, adapter_info, os_info = get_system_info()

# Generar script SQL
sql_script = generate_sql_script(codigo_equipo, nombre_sala, numero_equipo, campus, system_info, cpu_info, cpu_speed_info, memory_info, memory_info_extended, disk_info, disk_info_extended, network_info, mac_wifi_info, bios_info, adapter_info, os_info)

# Guardar el script SQL cifrado en un archivo con el nombre de la sala
if sql_script:
    try:
        # Cambiar el nombre del archivo al nombre de la sala
        nombre_archivo = f'{nombre_sala}.sql'
        with open(nombre_archivo, 'wb') as file:
            file.write(sql_script)
        print("Script SQL cifrado y generado exitosamente.")
    except Exception as e:
        print("Error al guardar el script SQL cifrado en un archivo:", e)
