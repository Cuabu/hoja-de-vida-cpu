import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;

public class GeneradorSQL {

    public static void main(String[] args) {
        // Nombre del archivo de entrada y salida
        String archivoEntrada = "datos_computadoras.txt";
        String archivoSalida = "inserts_computadoras.sql";

        try (BufferedReader br = new BufferedReader(new FileReader(archivoEntrada));
             BufferedWriter bw = new BufferedWriter(new FileWriter(archivoSalida))) {

            String linea;
            while ((linea = br.readLine()) != null) {
                // Dividir la línea en partes usando una coma como separador
                String[] partes = linea.split(",");
                if (partes.length >= 23) {
                    // Extraer las variables de cada parte
                    String codigoEquipo = partes[0].trim();
                    String nombreSala = partes[1].trim();
                    String nombreEquipo = partes[2].trim();
                    String numeroEquipo = partes[3].trim();
                    String campus = partes[4].trim();
                    String marcaManufactura = partes[5].trim();
                    String tecladoMarcaModeloSerial = partes[6].trim();
                    String reguladorVoltajeSerial = partes[7].trim();
                    String monitorMarcaModeloSerial = partes[8].trim();
                    String mouseMarcaModeloSerial = partes[9].trim();
                    String cpuModeloSerial = partes[10].trim();
                    String discoDuroModeloSerial = partes[11].trim();
                    String macEthernetSerial = partes[12].trim();
                    String macWIFISerial = partes[13].trim();
                    String observaciones = partes[14].trim();
                    String responsableEquipo = partes[15].trim();
                    String fechaIngreso = partes[16].trim();
                    String velocidadHash = partes[17].trim();
                    String descripcionProducto = partes[18].trim();
                    String historialMantenimientos = partes[19].trim();
                    String detallesReparacion = partes[20].trim();
                    String informacionCompleta = partes[21].trim();

                    // Generar la sintaxis SQL e escribirla en el archivo de salida
                    String sql = "INSERT INTO equipos (CodigoEquipo, NombreSala, NombreEquipo, NumeroEquipo, Campus, MarcaManufactura, TecladoMarcaModeloSerial, ReguladorVoltajeSerial, MonitorMarcaModeloSerial, MouseMarcaModeloSerial, CPUModeloSerial, DiscoDuroModeloSerial, MacEthernetSerial, MacWIFISerial, Observaciones, ResponsableEquipo, FechaIngreso, VelocidadHash, DescripcionProducto, HistorialMantenimientos, DetallesReparacion, InformacionCompleta) VALUES (";
                    sql += "'" + codigoEquipo + "', '" + nombreSala + "', '" + nombreEquipo + "', '" + numeroEquipo + "', '" + campus + "', ";
                    sql += "'" + marcaManufactura + "', '" + tecladoMarcaModeloSerial + "', '" + reguladorVoltajeSerial + "', ";
                    sql += "'" + monitorMarcaModeloSerial + "', '" + mouseMarcaModeloSerial + "', '" + cpuModeloSerial + "', ";
                    sql += "'" + discoDuroModeloSerial + "', '" + macEthernetSerial + "', '" + macWIFISerial + "', ";
                    sql += (observaciones.isEmpty() ? "NULL" : "'" + observaciones + "'") + ", ";
                    sql += "'" + responsableEquipo + "', '" + fechaIngreso + "', '" + velocidadHash + "', ";
                    sql += (descripcionProducto.isEmpty() ? "NULL" : "'" + descripcionProducto + "'") + ", ";
                    sql += (historialMantenimientos.isEmpty() ? "NULL" : "'" + historialMantenimientos + "'") + ", ";
                    sql += "'" + detallesReparacion + "', ";
                    sql += "'" + informacionCompleta + "');\n";

                    bw.write(sql);
                }
            }
            System.out.println("Archivo SQL generado con éxito.");
        } catch (IOException e) {
            System.err.println("Error al procesar el archivo: " + e.getMessage());
        }
    }
}
