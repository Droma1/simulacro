function exportarTablaAExcel(tablaID, nombreArchivo = 'registro_simulacro.xlsx'){
    var tabla = document.getElementById(tablaID);
    var hojaDeTrabajo = XLSX.utils.table_to_sheet(tabla);
    var libroDeTrabajo = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(libroDeTrabajo, hojaDeTrabajo, "Hoja1");
    XLSX.writeFile(libroDeTrabajo, nombreArchivo);
}