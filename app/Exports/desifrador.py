import tkinter as tk
from tkinter import filedialog, messagebox
from cryptography.fernet import Fernet

def cargar_clave():
    # Abrir ventana para seleccionar el archivo de clave
    clave_filename = filedialog.askopenfilename(title="Seleccionar archivo de clave", filetypes=[("Archivos de Clave", "*.txt")])
    if clave_filename:
        # Leer la clave desde el archivo
        with open(clave_filename, "rb") as clave_file:
            clave = clave_file.read()
        return clave
    else:
        messagebox.showerror("Error", "No se seleccionó ningún archivo de clave.")
        return None

def cargar_script():
    # Abrir ventana para seleccionar el archivo de script cifrado
    script_filename = filedialog.askopenfilename(title="Seleccionar archivo de script cifrado", filetypes=[("Archivos de Script Cifrado", "*.sql")])
    if script_filename:
        # Leer el script cifrado desde el archivo
        with open(script_filename, "rb") as script_file:
            script_cifrado = script_file.read()
        return script_cifrado
    else:
        messagebox.showerror("Error", "No se seleccionó ningún archivo de script cifrado.")
        return None

def descifrar_script(clave, script_cifrado):
    try:
        # Crear el objeto Fernet con la clave
        cipher_suite = Fernet(clave)
        
        # Descifrar el script
        script_descifrado = cipher_suite.decrypt(script_cifrado).decode()
        
        return script_descifrado
    except Exception as e:
        messagebox.showerror("Error", f"No se pudo descifrar el script: {e}")
        return None

def guardar_script_descifrado(script_descifrado):
    # Abrir ventana para seleccionar la ubicación de guardado del script descifrado
    guardar_filename = filedialog.asksaveasfilename(title="Guardar script descifrado como", defaultextension=".sql", filetypes=[("Archivos SQL", "*.sql")])
    if guardar_filename:
        # Escribir el script descifrado en el archivo
        with open(guardar_filename, "w") as guardar_file:
            guardar_file.write(script_descifrado)
        messagebox.showinfo("Éxito", "Script descifrado guardado exitosamente.")
    else:
        messagebox.showerror("Error", "No se seleccionó una ubicación de guardado.")

def descifrar_y_guardar():
    # Cargar la clave
    clave = cargar_clave()
    if clave:
        # Cargar el script cifrado
        script_cifrado = cargar_script()
        if script_cifrado:
            # Descifrar el script
            script_descifrado = descifrar_script(clave, script_cifrado)
            if script_descifrado:
                # Guardar el script descifrado
                guardar_script_descifrado(script_descifrado)

# Crear la ventana principal
root = tk.Tk()
root.title("Descifrador de Script")

# Botón para descifrar y guardar el script
btn_descifrar = tk.Button(root, text="Descifrar y Guardar", command=descifrar_y_guardar)
btn_descifrar.pack(pady=10)

# Ejecutar el bucle de eventos
root.mainloop()
