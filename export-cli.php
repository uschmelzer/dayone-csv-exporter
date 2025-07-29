<?php
// Read CSV file and create individual text files in a subdirectory
function createTextFilesFromCSV($csvFile) {
    // Check if CSV file exists
    if (!file_exists($csvFile)) {
        die("CSV file not found: $csvFile\n");
    }
    
    // Create output directory
    $outputDir = 'output';
    if (!is_dir($outputDir)) {
        if (!mkdir($outputDir, 0755, true)) {
            die("Cannot create output directory: $outputDir\n");
        }
        echo "Created output directory: $outputDir\n";
    }
    
    // Open CSV file
    $handle = fopen($csvFile, 'r');
    if (!$handle) {
        die("Cannot open CSV file: $csvFile\n");
    }
    
    // Read header line
    $headers = fgetcsv($handle, 0, ';');
    if (!$headers) {
        die("Cannot read CSV headers\n");
    }
    
    // Find column indices
    $dateIndex = array_search('date', $headers);
    $textIndex = array_search('text', $headers);
    
    if ($dateIndex === false || $textIndex === false) {
        die("Required columns 'date' and 'text' not found in CSV\n");
    }
    
    $lineNumber = 0;
    $filesCreated = 0;
    
    // Process each line
    while (($data = fgetcsv($handle, 0, ';')) !== false) {
        $lineNumber++;
        
        // Skip empty lines
        if (empty($data[$dateIndex]) || empty($data[$textIndex])) {
            continue;
        }
        
        // Extract date part (YYYY-MM-DD) from timestamp
        $timestamp = $data[$dateIndex];
        $date = date('Y-m-d', strtotime($timestamp));
        
        // Get text preview respecting word boundaries
        $text = $data[$textIndex];
        $maxLength = 30;
        $textPreview = substr($text, 0, $maxLength);
        
        // If we cut in the middle of a word, extend to the end of that word
        if (strlen($text) > $maxLength && !preg_match('/\s$/', $textPreview)) {
            // Find the last space in the preview
            $lastSpace = strrpos($textPreview, ' ');
            if ($lastSpace !== false) {
                $textPreview = substr($textPreview, 0, $lastSpace);
            }
        }
        
        // Normalize text like WordPress slug
        $textPreview = strtolower($textPreview);
        
        // Normalize German umlauts
        $umlautMap = [
            'ä' => 'ae', 'ö' => 'oe', 'ü' => 'ue',
            'Ä' => 'ae', 'Ö' => 'oe', 'Ü' => 'ue',
            'ß' => 'ss'
        ];
        $textPreview = strtr($textPreview, $umlautMap);
        
        // Allow spaces, letters, numbers, and hyphens
        $textPreview = preg_replace('/[^a-z0-9\s\-]/', '', $textPreview);
        // Convert multiple spaces/hyphens to single spaces
        $textPreview = preg_replace('/[\s\-]+/', ' ', $textPreview);
        $textPreview = trim($textPreview);
        
        // If text preview is empty after cleaning, use a default
        if (empty($textPreview)) {
            $textPreview = 'entry';
        }
        
        // Create filename with full path using space-dash-space separator
        $filename = $outputDir . '/' . $date . ' - ' . $textPreview . '.txt';
        
        // Create YAML front matter metadata
        $metadata = "---\ndate: $date\n---\n\n";
        $content = $metadata . $text;
        
        // Write text content to file
        if (file_put_contents($filename, $content) !== false) {
            $filesCreated++;
            echo "Created: $filename\n";
        } else {
            echo "Error creating file: $filename\n";
        }
    }
    
    fclose($handle);
    echo "\nTotal files created: $filesCreated\n";
    echo "Files saved in directory: $outputDir\n";
}

// Run the script
$csvFile = 'input.csv';
createTextFilesFromCSV($csvFile);
?> 