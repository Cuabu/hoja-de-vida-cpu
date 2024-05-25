import psutil
import subprocess
import platform
import time

def get_cpu_temperature():
    if platform.system() == "Windows":
        output = subprocess.run(["wmic", "cpu", "get", "temperature"], capture_output=True, text=True)
        temperature = output.stdout.strip().split("\n")[1]
        return temperature
    elif platform.system() == "Linux":
        # Aquí podrías usar comandos de Linux para obtener la temperatura del procesador
        pass
    else:
        return "N/A"

def get_memory_usage():
    memory = psutil.virtual_memory()
    total_memory = memory.total
    available_memory = memory.available
    used_memory = total_memory - available_memory
    return total_memory, used_memory

def get_network_usage():
    network = psutil.net_io_counters()
    sent_bytes = network.bytes_sent
    recv_bytes = network.bytes_recv
    return sent_bytes, recv_bytes

def get_disk_usage():
    disk = psutil.disk_usage('/')
    total_disk_space = disk.total
    used_disk_space = disk.used
    return total_disk_space, used_disk_space

def save_to_file(data):
    with open("system_stats.txt", "a") as file:
        file.write(data)
        file.write("\n")

def main():
    while True:
        cpu_temperature = get_cpu_temperature()
        total_memory, used_memory = get_memory_usage()
        sent_bytes, recv_bytes = get_network_usage()
        total_disk_space, used_disk_space = get_disk_usage()

        data = f"CPU Temperature: {cpu_temperature} | Memory Usage: {used_memory}/{total_memory} | Network Usage: Sent: {sent_bytes} bytes, Received: {recv_bytes} bytes | Disk Usage: {used_disk_space}/{total_disk_space}"
        print(data)
        save_to_file(data)

        time.sleep(20)

if __name__ == "__main__":
    main()
