<?php 

require('views/fpdf/fpdf.php');

// Iniciar la instancia de FPDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

// Título
$pdf->Cell(0, 10, 'Resultados de los estudiantes', 0, 1, 'C');

// Descripción
$pdf->Cell(0, 10, 'Consulte aquí los resultados de los estudiantes del grado 11', 0, 1, 'C');
$pdf->Ln(5);

// Mostrar los filtros seleccionados
$pdf->Cell(60, 10, 'Materia:', 0);
$pdf->Cell(60, 10, 'Tipo de Pregunta:', 0);
$pdf->Cell(60, 10, 'Estudiante:', 0);
$pdf->Ln();
$pdf->Cell(60, 10, $materiaSeleccionada, 0);
$pdf->Cell(60, 10, $tipoPreguntaSeleccionada, 0);
$pdf->Cell(60, 10, $estudianteSeleccionado, 0);
$pdf->Ln(10);

// Tabla de preguntas correctas
$pdf->Cell(0, 10, 'Preguntas correctas (' . $correctas . ')', 0, 1);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(90, 10, 'Enunciado de la pregunta', 1);
$pdf->Cell(50, 10, 'Opción pregunta', 1);
$pdf->Cell(50, 10, 'Fecha contestada', 1);
$pdf->Ln();
$pdf->SetFont('Arial', '', 12);

foreach ($resultadoCalificacion as $value) {
    if ($value['validacion_pregunta_id'] == 1) {
        $pdf->Cell(90, 10, $value['enunciado_pregunta'], 1);
        $pdf->Cell(50, 10, $value['nombre_tipo_pregunta'], 1);
        $pdf->Cell(50, 10, $value['fecha_contestada'], 1);
        $pdf->Ln();
    }
}

if (empty($resultadoCalificacion) || $correctas == 0) {
    $pdf->Cell(0, 10, 'No hay preguntas correctas por el momento.', 0, 1);
}

$pdf->Ln(10);

// Tabla de preguntas incorrectas
$pdf->Cell(0, 10, 'Preguntas incorrectas (' . $incorrectas . ')', 0, 1);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(90, 10, 'Enunciado de la pregunta', 1);
$pdf->Cell(50, 10, 'Opción pregunta', 1);
$pdf->Cell(50, 10, 'Fecha contestada', 1);
$pdf->Ln();
$pdf->SetFont('Arial', '', 12);

foreach ($resultadoCalificacion as $value) {
    if ($value['validacion_pregunta_id'] == 2) {
        $pdf->Cell(90, 10, $value['enunciado_pregunta'], 1);
        $pdf->Cell(50, 10, $value['nombre_tipo_pregunta'], 1);
        $pdf->Cell(50, 10, $value['fecha_contestada'], 1);
        $pdf->Ln();
    }
}

if (empty($resultadoCalificacion) || $incorrectas == 0) {
    $pdf->Cell(0, 10, 'No hay preguntas incorrectas por el momento.', 0, 1);
}

$pdf->Ln(10);

// Total de preguntas contestadas
$pdf->Cell(0, 10, 'Total de preguntas contestadas: ' . count($resultadoCalificacion), 0, 1);
$pdf->Ln(10);

// Gráficos
$pdf->Cell(0, 10, 'Resultados graficados de ' . ($resultadoCalificacion ? $resultadoCalificacion[0]['nombres_materias'] : ''), 0, 1);
$pdf->Ln(10);

// Guardar el PDF
$pdf->Output('D', 'resultados_estudiantes.pdf');
