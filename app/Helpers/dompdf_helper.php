<?php

use Dompdf\Dompdf;
use Dompdf\Options;

if (!function_exists('pdf_create')) {
    function pdf_create($html, $filename = '', $stream = true, $paper = 'A4', $orientation = 'portrait')
    {
        // Create a new instance of Dompdf with custom options
        $options = new Options();
        $dompdf = new Dompdf($options);

        // Set paper size and orientation
        $dompdf->setPaper($paper, $orientation);

        // Load HTML content
        $dompdf->loadHtml($html);

        // Render HTML to PDF
        $dompdf->render();

        // Generate the file path to save the PDF
        $filePath = FCPATH . 'assets/docsurgas/' . $filename . '.pdf';

        // Save the PDF to the specified file path
        file_put_contents($filePath, $dompdf->output());

        // Save or output the PDF
        if ($stream) {
            $dompdf->stream($filename . '.pdf', ['Attachment' => 0]);
        } else {
            return $filePath;
        }
    }
}
