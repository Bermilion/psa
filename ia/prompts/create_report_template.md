# Промт: Создание шаблона отчёта

## Контекст
Вы создаёте Blade-шаблон для генерации PDF-отчёта в системе MarineService Manager.

## Инструкции
1. Создайте шаблон для отчёта `{report_type}`
2. Используйте структуру HTML5
3. Подключите Tailwind CSS
4. Добавьте все необходимые поля из описания
5. Реализуйте подстановку данных через переменные
6. Добавьте место для подписи
7. Сделайте шаблон готовым для печати

## Требования
- Использовать только Tailwind CSS для стилизации
- Шаблон должен быть в `resources/views/reports/{template_name}.blade.php`
- Использовать русский язык
- Размер страницы A4
- Поля: 2 см со всех сторон
- Шрифт: Times New Roman, 12pt
- Межстрочный интервал: 1.5
- Выравнивание текста: по ширине
- Нумерация страниц: внизу по центру

## Поля для заполнения
- Наименование организации
- Наименование судна
- Дата осмотра/работ
- Описание выявленных дефектов
- Предлагаемые работы
- Подписи: ответственный, мастер, представитель заказчика

## Пример структуры
```blade
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $report->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @page { margin: 2cm; size: A4; }
        body { font-family: 'Times New Roman', serif; font-size: 12pt; line-height: 1.5; text-align: justify; }
    </style>
</head>
<body>
    <div class="max-w-4xl mx-auto">
        <!-- Заголовок -->
        <div class="text-center mb-8">
            <h1 class="text-xl font-bold uppercase">Акт дефектации</h1>
            <p class="mt-2">№ {{ $report->number }} от {{ $report->date->format('d.m.Y') }}</p>
        </div>

        <!-- Основная информация -->
        <div class="grid grid-cols-2 gap-8 mb-8">
            <div>
                <p><strong>Судно:</strong> {{ $report->vessel->name }}</p>
                <p><strong>Заказчик:</strong> {{ $report->customer->name }}</p>
            </div>
            <div>
                <p><strong>Дата осмотра:</strong> {{ $report->inspection_date->format('d.m.Y') }}</p>
                <p><strong>Место осмотра:</strong> {{ $report->location }}</p>
            </div>
        </div>

        <!-- Описание дефектов -->
        <div class="mb-8">
            <h2 class="text-lg font-semibold border-b pb-2 mb-4">Выявленные дефекты</h2>
            <div class="whitespace-pre-line">{{ $report->defects_description }}</div>
        </div>

        <!-- Предлагаемые работы -->
        <div class="mb-8">
            <h2 class="text-lg font-semibold border-b pb-2 mb-4">Предлагаемые работы</h2>
            <div class="whitespace-pre-line">{{ $report->proposed_works }}</div>
        </div>

        <!-- Подписи -->
        <div class="grid grid-cols-3 gap-8 mt-16">
            <div class="text-center">
                <p class="border-t pt-2">Мастер</p>
            </div>
            <div class="text-center">
                <p class="border-t pt-2">Ответственный</p>
            </div>
            <div class="text-center">
                <p class="border-t pt-2">Представитель заказчика</p>
            </div>
        </div>

        <!-- Нумерация страниц -->
        <div class="page-break"></div>
        <div class="text-center text-sm mt-4">Страница 1</div>
    </div>
</body>
</html>
```