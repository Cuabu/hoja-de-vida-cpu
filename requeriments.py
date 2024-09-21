import subprocess

def install_libraries():
    libraries = ['psutil', 'requests', 'cryptography']

    for lib in libraries:
        print(f"Instalando {lib}...")
        subprocess.run(['pip', 'install', lib])

    # Instalación de la biblioteca 'fernet'
    print("Instalando fernet...")
    subprocess.run(['pip', 'install', 'cryptography'])

    # Instalación de la biblioteca 'mysql'
    print("Instalando base de datos...")
    subprocess.run(['pip', 'install', 'mysql.connector'])

if __name__ == "__main__":
    install_libraries()
