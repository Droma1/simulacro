function generar(){
    const { jsPDF } = window.jspdf;

    // Crear un nuevo documento PDF con tamaño A4
    let pdf = new jsPDF({
        orientation: 'portrait',
        unit: 'mm',
        format: [210, 297]
    });

    // Obtener el contenedor con el contenido que queremos convertir a PDF
    const element = document.querySelector('.pdf_cuerpo');

    // Opciones para el método html2canvas
    let options = {
        scale: 3, // Escala del PDF (1 = tamaño original)
        useCORS: true // Habilitar CORS para imágenes externas
    };

    // Convertir el contenedor a una imagen utilizando html2canvas
    html2canvas(element, options).then((canvas) => {
        const imgData = canvas.toDataURL('image/png');
        const imgWidth = 210; // Ancho de la imagen en mm (A4)
        const pageHeight = 297; // Alto de la página en mm (A4)
        const imgHeight = canvas.height * imgWidth / canvas.width;
        let heightLeft = imgHeight;
        let position = 0;

        // Agregar la imagen al PDF
        pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
        heightLeft -= pageHeight;

        // Mientras haya altura restante en la página, agregamos nuevas páginas
        while (heightLeft >= 0) {
            position = heightLeft - imgHeight;
            pdf.addPage();
            pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
            heightLeft -= pageHeight;
        }

        // Guardar el PDF con el nombre "ejemplo.pdf"
        pdf.save("constancia_simulacro.pdf");
    });
}