<?php

/**
 * Script to convert Laravel PHP translation files to JSON for Vue i18n
 */
$locales = ['en', 'pt'];
$outputDir = __DIR__ . '/../resources/js/translations';

// Create output directory if it doesn't exist
if (!is_dir($outputDir)) {
    mkdir($outputDir, 0755, true);
}

foreach ($locales as $locale) {
    $langPath = __DIR__ . '/../lang/' . $locale;

    if (!is_dir($langPath)) {
        echo "Warning: Language directory not found: $langPath\n";

        continue;
    }

    $translations = [];

    // Get all PHP files in the lang directory
    $files = glob($langPath . '/*.php');

    foreach ($files as $file) {
        $filename = basename($file, '.php');
        $content = require $file;

        if (is_array($content)) {
            $translations[$filename] = $content;
        }
    }

    // Convert to JSON and save
    $jsonFile = $outputDir . '/' . $locale . '.json';
    $json = json_encode($translations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    file_put_contents($jsonFile, $json);

    echo "Generated: $jsonFile\n";
}

echo "\nTranslation files generated successfully!\n";
