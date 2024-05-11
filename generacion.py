import re

# Texto proporcionado
texto = """
$nombreEquipo: CSADP2SLA21NV52
$marcaManufactura: Dell Inc.
$cpuModeloSerial: Intel(R) Core(TM) i7-4790S CPU @ 3.20GHz
$MemoriaRam: 4294967296 Samsung 1600
$discoDuroModeloSerial: WD C WD5000LPLX-75ZNTT0 500105249280
$macEthernetSerial: 10-7D-1A-FF-FB-0C
$macWIFISerial: A4-C4-94-0C-A6-C5
$observaciones: Ninguna
"""

# Expresión regular para encontrar variables
patron_variable = r"\$(\w+):\s*(.*)"

# Diccionario para mapear las variables de texto a las variables de la base de datos
variables_db = {
    "nombreEquipo": "nombre_equipo",
    "marcaManufactura": "marca_manufactura",
    "cpuModeloSerial": "cpu_modelo_serial",
    "MemoriaRam": "memoria_ram",
    "discoDuroModeloSerial": "disco_duro_modelo_serial",
    "macEthernetSerial": "mac_ethernet_serial",
    "macWIFISerial": "mac_wifi_serial",
    "observaciones": "observaciones"
}

# Inicializar lista para almacenar las inserciones de variables en la base de datos
inserciones_db = []

# Buscar variables en el texto y crear inserciones de variables en la base de datos
for match in re.finditer(patron_variable, texto):
    nombre_variable = match.group(1)
    valor_variable = match.group(2)
    if nombre_variable in variables_db:
        nombre_variable_db = variables_db[nombre_variable]
        insercion = f"{nombre_variable_db}: '{valor_variable.strip()}'"
    else:
        insercion = f"{nombre_variable}: 'sin detalles'"
    inserciones_db.append(insercion)

# Crear consulta SQL para la inserción en la base de datos
consulta_sql = f"INSERT INTO equipos ({', '.join(variables_db.values())}) VALUES ({', '.join(inserciones_db)});"

# Guardar la consulta SQL en un archivo de texto
with open("insercion_bd.txt", "w") as archivo:
    archivo.write(consulta_sql)

print("Consulta SQL generada y guardada en 'insercion_bd.txt'.")
