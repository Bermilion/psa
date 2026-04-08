#!/usr/bin/env php
<?php
// scripts/generate-color-array.php

$cssPath = __DIR__ . '/../resources/css/app.css';
$jsonPath = __DIR__ . '/../scripts/colors.json';

if (!file_exists($cssPath)) {
    fwrite(STDERR, "❌ CSS файл не найден: {$cssPath}\n");
    exit(1);
}

// Парсим CSS переменные
$content = file_get_contents($cssPath);
preg_match_all('/--color-([a-zA-Z0-9-]+)\s*:\s*([^;]+);/', $content, $matches, PREG_SET_ORDER);

$colors = [];
foreach ($matches as $match) {
    $colors[$match[1]] = trim($match[2]);
}

// Группируем цвета
$grouped = [];
foreach ($colors as $key => $value) {
    $parts = explode('-', $key, 2);
    $group = $parts[0];
    $groupName = ucfirst($parts[0]);
    $shade = $parts[1] ?? 'DEFAULT';

    if (!isset($grouped[$groupName])) {
        $grouped[$groupName] = [];
    }
    $grouped[$groupName]['bg-'. $group .'-'. $shade] = $value;
}

// Формируем данные для JSON
$data = [
    'grouped' => $grouped,
    'all' => $colors,
    'meta' => [
        'generated_at' => date('c'),
        'total_colors' => count($colors),
        'total_groups' => count($grouped),
        'source' => 'resources/css/app.css'
    ]
];

// Сохраняем JSON
file_put_contents($jsonPath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

echo "✅ Генерация палитры цветов: {$jsonPath}\n";
echo "📊 Найдено " . count($colors) . " цветов в " . count($grouped) . " группах\n";
