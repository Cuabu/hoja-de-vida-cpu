def comparar_archivos(archivo1, archivo2):
    # Leer el contenido de los archivos
    with open(archivo1, 'r') as file1:
        contenido1 = file1.readlines()
    with open(archivo2, 'r') as file2:
        contenido2 = file2.readlines()

    # Eliminar los saltos de línea y espacios en blanco al final de cada línea
    contenido1 = [line.rstrip() for line in contenido1]
    contenido2 = [line.rstrip() for line in contenido2]

    # Verificar si los contenidos son iguales
    if contenido1 == contenido2:
        print("Los archivos coinciden en un 100%.")
    else:
        print("Diferencias encontradas:")
        for linea1, linea2 in zip(contenido1, contenido2):
            if linea1 != linea2:
                print(f"Archivo 1: {linea1}")
                print(f"Archivo 2: {linea2}")
                print()

# Rutas de los archivos a comparar
archivo1 = 'archivo1.txt'
archivo2 = 'archivo2.txt'

# Llamar a la función para comparar los archivos
comparar_archivos(archivo1, archivo2)
