import platform
import psutil
import subprocess
import tkinter as tk
from tkinter import filedialog, simpledialog
import socket

# Función para obtener la información del sistema desde un archivo de texto
def extract_system_details_from_text(text):
    try:
        system_info = {}
        sections = text.split("===")
        
        for section in sections:
            lines = section.strip().split('\n')
            if lines:
                category = lines[0].strip()
                if category.startswith('Informacion del Sistema'):
                    for line in lines[1:]:
                        if line.strip():
                            key, value = [item.strip() for item in line.split(':', 1)]
                            system_info[key] = value
                elif category.startswith('Informacion de la CPU'):
                    cpu_info = lines[1].strip().split()[0]
                    system_info['Informacion de la CPU'] = cpu_info
                elif category.startswith('Informacion de la Memoria RAM'):
                    memory_info = lines[1].strip().split()[0]
                    system_info['Informacion de la Memoria RAM'] = memory_info
                elif category.startswith('Informacion del Disco Duro'):
                    disk_info = lines[1].strip().split()[1]
                    system_info['Informacion del Disco Duro'] = disk_info
                elif category.startswith('Informacion de la Red'):
                    mac_ethernet = lines[-4].split(':')[1].strip()
                    system_info['MAC Ethernet'] = mac_ethernet
                    mac_wifi = lines[-3].split(':')[1].strip()
                    system_info['MAC WiFi'] = mac_wifi
        return system_info
    except Exception as e:
        print("Error al extraer detalles del sistema:", e)

# Función para generar el script SQL
def generate_sql_script(system_info, codigo_equipo, nombre_sala, numero_equipo, campus):
    try:
        # Llenar las variables con datos obtenidos
        nombre_equipo = socket.gethostname()

        # Obtener información específica del sistema
        os_info = system_info.get('Nombre del sistema operativo', '')
        cpu_info = system_info.get('Informacion de la CPU', '')
        memory_info = system_info.get('Informacion de la Memoria RAM', '')
        disk_info = system_info.get('Informacion del Disco Duro', '')
        mac_ethernet = system_info.get('MAC Ethernet', '')
        mac_wifi = system_info.get('MAC WiFi', '')

        # Generar el script SQL con los datos
        sql_script = f"INSERT INTO auto_equipos (codigo_equipo, nombre_sala, nombre_equipo, numero_equipo, campus, memoria_ram, cpu_modelo_serial, disco_duro_modelo_serial, mac_ethernet_serial, mac_wifi_serial, os_info) VALUES ('{codigo_equipo}', '{nombre_sala}', '{nombre_equipo}', '{numero_equipo}', '{campus}', '{memory_info}', '{cpu_info}', '{disk_info}', '{mac_ethernet}', '{mac_wifi}', '{os_info}');"
        
        return sql_script
    except Exception as e:
        print("Error al generar el script SQL:", e)

# Función para abrir un archivo de texto y obtener su contenido
def abrir_archivo():
    try:
        # Abrir ventana para seleccionar un archivo de texto
        ruta_archivo = filedialog.askopenfilename(filetypes=[("Archivos de texto", "*.txt")])
        
        if ruta_archivo:
            # Leer el contenido del archivo
            with open(ruta_archivo, 'r') as file:
                texto = file.read()
            
            # Obtener detalles del sistema del texto proporcionado
            system_info = extract_system_details_from_text(texto)
            
            # Solicitar entrada del usuario
            codigo_equipo, nombre_sala, numero_equipo, campus = solicitar_entrada()

            # Generar script SQL
            sql_script = generate_sql_script(system_info, codigo_equipo, nombre_sala, numero_equipo, campus)
            
            # Guardar el script SQL en un archivo con el nombre de la sala
            if sql_script:
                nombre_archivo = f'{nombre_sala}.sql'
                with open(nombre_archivo, 'w') as file:
                    file.write(sql_script)
                print("Script SQL generado exitosamente.")
    except Exception as e:
        print("Error al abrir el archivo o procesar los detalles del sistema:", e)

# Función para solicitar la entrada del usuario
def solicitar_entrada():
    try:
        root = tk.Tk()
        root.withdraw()  # Ocultar la ventana principal

        codigo_equipo = simpledialog.askstring("Código de Equipo", "Ingrese el código del equipo:")
        nombre_sala = simpledialog.askstring("Nombre de Sala", "Ingrese el nombre de la sala u oficina:")
        numero_equipo = simpledialog.askstring("Número de Equipo", "Ingrese el número del equipo:")
        campus = simpledialog.askstring("Campus", "Ingrese el nombre del campus:")

        return codigo_equipo, nombre_sala, numero_equipo, campus
    except Exception as e:
        print("Error al solicitar la entrada:", e)

# Llamar a la función para abrir el archivo
abrir_archivo()
