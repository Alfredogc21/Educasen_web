<?php
require 'views/fpdf/fpdf.php';
session_start();

class PDF extends FPDF
{
    // Variable para controlar si ya se mostraron los textos de correctas e incorrectas
    var $mostrarTotales = true;

    // Cabecera de página
    function Header()
    {
        $this->Image('../views/imagenes/logoIECentral-removebg.png', 185, 5, 20); // logo de la empresa, moverDerecha, moverAbajo, tamañoIMG
        $this->SetFont('Arial', 'B', 19); // tipo fuente, negrita(B-I-U-BIU), tamañoTexto
        $this->Cell(45); // Movernos a la derecha
        $this->SetTextColor(0, 0, 0); // color
        // creamos una celda o fila
        $this->Cell(100, 15, utf8_decode('INSTITUCIÓN EDUCATIVA CENTRAL'), 0, 1, 'C', 0); // AnchoCelda, AltoCelda, titulo, borde(1-0), saltoLinea(1-0), posicion(L-C-R), ColorFondo(1-0)
        $this->Cell(180, 15, utf8_decode('Reporte de Calificaciones de (' . $_SESSION['nombreOpPregunta'] . ')'), 1, 1, 'C', 0);
        $this->Ln(3); // Salto de línea
        $this->SetTextColor(103); // color

        /* TITULO DE LA TABLA */
        $this->SetTextColor(0, 0, 0); // color
        $this->Cell(50); // mover a la derecha
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(100, 10, utf8_decode("Resultados de " . $_SESSION['estudiante'] . " en " . $_SESSION['materia']), 0, 1, 'C', 0);
        $this->Ln(7);

        // Mostrar los textos de correctas e incorrectas solo en la primera página
        if ($this->PageNo() == 1 && $this->mostrarTotales) {
            $this->SetFont('Arial', '', 12);

            // Ancho total disponible (ancho de la página menos los márgenes)
            $totalWidth = $this->GetPageWidth() - $this->lMargin - $this->rMargin;

            // Ancho de cada sección
            $sectionWidth = $totalWidth / 3;

            // Posicionar y dibujar cada sección
            $this->SetX($this->lMargin); // Posición a la izquierda
            $this->Cell($sectionWidth, 10, utf8_decode('Correctas: ' . $_SESSION['correctas']), 0, 0, 'L');

            $this->SetX($this->lMargin + $sectionWidth); // Posición en el centro
            $this->Cell($sectionWidth, 10, utf8_decode('Total de preguntas contestadas: ' . $_SESSION['totalPreguntas']), 0, 0, 'C');

            $this->SetX($this->lMargin + 2 * $sectionWidth); // Posición a la derecha
            $this->Cell($sectionWidth, 10, utf8_decode('Incorrectas: ' . $_SESSION['incorrectas']), 0, 1, 'R');

            $this->Ln(7);
            $this->mostrarTotales = false;
        }

        /* CAMPOS DE LA TABLA */
        $this->SetFillColor(78, 108, 176); // colorFondo
        $this->SetTextColor(255, 255, 255); // colorTexto
        $this->SetDrawColor(163, 163, 163); // colorBorde
        $this->SetFont('Arial', 'B', 11);

        // Calcular ancho de la tabla
        $cellWidth = 65; // Ancho de cada celda
        $startX = ($this->GetPageWidth() - ($cellWidth * 3)) / 2; // Posición inicial para centrar

        // Mover a la posición inicial y dibujar las celdas
        $this->SetX($startX);
        $this->Cell($cellWidth, 10, utf8_decode('ENUNCIADO DE LA PREGUNTA'), 1, 0, 'C', 1);
        $this->Cell($cellWidth, 10, utf8_decode('CALIFICACIÓN'), 1, 0, 'C', 1);
        $this->Cell($cellWidth, 10, utf8_decode('FECHA CONTESTADA'), 1, 0, 'C', 1);
        $this->Ln();
    }

    // Pie de página
    function Footer()
    {
        $this->SetY(-15); // Posición: a 1,5 cm del final
        $this->SetFont('Arial', 'I', 8); // tipo fuente, negrita(B-I-U-BIU), tamañoTexto
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); // pie de pagina(numero de pagina)

        $this->SetY(-15); // Posición: a 1,5 cm del final
        $this->SetFont('Arial', 'I', 8); // tipo fuente, cursiva, tamañoTexto
        $hoy = date('d/m/Y');
        $this->Cell(355, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
    }

    // Función para dibujar la tabla de resultados
    function ResultsTable($results)
    {
        $this->SetFont('Arial', '', 12);
        $this->SetDrawColor(163, 163, 163); // colorBorde

        // Ancho de cada celda
        $cellWidth = 65; // Ancho de cada celda
        $startX = ($this->GetPageWidth() - ($cellWidth * 3)) / 2; // Posición inicial para centrar

        foreach ($results as $row) {
            // Altura de la celda
            $cellHeight = 10;

            // Calcular la altura requerida para la celda de enunciado_pregunta
            $nbLines = $this->NbLines($cellWidth, utf8_decode($row['enunciado_pregunta']));
            $cellHeight = $nbLines * 10; // Ajustar la altura según el número de líneas

            // Comprobar si hay suficiente espacio en la página
            if ($this->GetY() + $cellHeight > $this->PageBreakTrigger) {
                $this->AddPage($this->CurOrientation);
                $this->SetX($startX);
                $this->Cell($cellWidth, 10, utf8_decode('ENUNCIADO DE LA PREGUNTA'), 1, 0, 'C', 1);
                $this->Cell($cellWidth, 10, utf8_decode('CALIFICACIÓN'), 1, 0, 'C', 1);
                $this->Cell($cellWidth, 10, utf8_decode('FECHA CONTESTADA'), 1, 0, 'C', 1);
                $this->Ln();
            }

            $startY = $this->GetY(); // Posición inicial en Y

            // Mover a la posición inicial para centrar
            $this->SetX($startX);
            // Dibujar la celda de enunciado_pregunta
            $this->MultiCell($cellWidth, 10, utf8_decode($row['enunciado_pregunta']), 1, 'C', false);

            // Guardar la altura de la celda de enunciado_pregunta
            $enunciadoHeight = $this->GetY() - $startY;

            // Calcular la altura máxima de la fila
            $maxHeight = max($cellHeight, $enunciadoHeight);

            // Dibujar las celdas de opcion_pregunta y fecha_contestada con la misma altura que enunciado_pregunta
            $this->SetXY($startX + $cellWidth, $startY);
            $this->Cell($cellWidth, $maxHeight, utf8_decode($row['nombre_validacion']), 1, 0, 'C', 0);
            $this->Cell($cellWidth, $maxHeight, utf8_decode($row['fecha_contestada']), 1, 0, 'C', 0);

            // Establecer la posición Y para la siguiente fila
            $this->SetY($startY + $maxHeight);
        }
    }

    // Función para calcular el número de líneas necesarias para el contenido de una celda
    function NbLines($w, $txt)
    {
        $cw = &$this->CurrentFont['cw'];
        if ($w == 0) {
            $w = $this->w - $this->rMargin - $this->x;
        }
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb > 0 and $s[$nb - 1] == "\n") {
            $nb--;
        }
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c == "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if ($c == ' ') {
                $sep = $i;
            }
            $l += $cw[$c];
            if ($l > $wmax) {
                if ($sep == -1) {
                    if ($i == $j) {
                        $i++;
                    }
                } else {
                    $i = $sep + 1;
                }
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            } else {
                $i++;
            }
        }
        return $nl;
    }
}

$pdf = new PDF();
$pdf->AddPage(); // aquí entran dos para parámetros (orientación, tamaño) V->portrait H->landscape tamaño (A3, A4, A5, letter, legal)
$pdf->AliasNbPages(); // muestra la pagina / y total de paginas

// Carga de datos de la sesión
$results = isset($_SESSION['resultadoCalificacion']) ? $_SESSION['resultadoCalificacion'] : [];

// Dibujar la tabla de resultados
$pdf->ResultsTable($results);

$pdf->Output('ReporteCalificaciones.pdf', 'I'); // nombreDescarga, Visor(I->visualizar - D->descargar)
?>
