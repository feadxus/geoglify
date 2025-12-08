<?php

/**
 * Script to convert Laravel PHP translation files to JSON for Vue i18n
 */
$langDir = __DIR__ . '/../lang';
$outputDir = __DIR__ . '/../resources/js/translations';

// Create output directory if it doesn't exist
if (!is_dir($outputDir)) {
    mkdir($outputDir, 0755, true);
}

// Read all folders inside lang (each folder is a locale)
$locales = array_filter(scandir($langDir), function($dir) use ($langDir) {
    return $dir !== '.' && $dir !== '..' && is_dir($langDir . '/' . $dir);
});

// Exclude 'vendor' directory
$locales = array_filter($locales, function($dir) {
    return $dir !== 'vendor';
});

foreach ($locales as $locale) {
    $translations = [];
    $langPath = $langDir . '/' . $locale;

    // Read all PHP files in the folder
    $files = glob($langPath . '/*.php');
    foreach ($files as $file) {
        $filename = basename($file, '.php');
        $content = require $file;
        if (is_array($content)) {
            $translations[$filename] = $content;
        }
    }

    // Save as JSON
    $jsonFile = $outputDir . '/' . $locale . '.json';
    file_put_contents($jsonFile, json_encode($translations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    echo "Generated: $jsonFile\n";
}

echo "\nTranslation files generated successfully!\n";
