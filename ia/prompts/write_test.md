# Промт: Написание теста

## Контекст
Вы пишете тест для Laravel-приложения MarineService Manager.

## Инструкции
1. Определите тип теста: Feature или Unit
2. Создайте тест с именем `{TestName}Test`
3. Тест должен быть в пространстве имён `Tests\Feature` или `Tests\Unit`
4. Файл должен быть в `tests/Feature/{FeatureName}/{TestName}Test.php` или `tests/Unit/{UnitName}/{TestName}Test.php`
5. Используйте методы `setUp` и `tearDown` при необходимости
6. Создайте необходимые фабрики для тестовых данных
7. Проверьте основные сценарии: позитивные, негативные, граничные

## Требования
- Следовать PSR-12
- Использовать методы `assert` для проверок
- Тест должен быть независимым
- Использовать транзакции или миграции для очистки БД
- Покрыть все ветвления логики

## Пример (Feature-тест)
```php
<?php

namespace Tests\Feature\Reports;

use App\Models\Customer;
use App\Models\Report;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReportManagementTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    /** @test */
    public function authorized_user_can_create_report(): void
    {
        $customer = Customer::factory()->create();

        $response = $this->postJson('/api/v1/reports', [
            'title' => 'Тестовый акт',
            'customer_id' => $customer->id,
            'status' => 'draft'
        ]);

        $response->assertStatus(201)
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.report.title', 'Тестовый акт');

        $this->assertDatabaseHas('reports', [
            'title' => 'Тестовый акт',
            'customer_id' => $customer->id,
            'status' => 'draft'
        ]);
    }

    /** @test */
    public function validation_fails_when_required_fields_are_missing(): void
    {
        $response = $this->postJson('/api/v1/reports', []);

        $response->assertStatus(422)
            ->assertJsonPath('success', false)
            ->assertJsonValidationErrors(['title', 'customer_id', 'status']);
    }

    /** @test */
    public function user_can_view_report_list(): void
    {
        Report::factory()->count(3)->create();

        $response = $this->getJson('/api/v1/reports');

        $response->assertStatus(200)
            ->assertJsonPath('success', true)
            ->assertJsonCount(3, 'data.reports.data');
    }
}
```

## Пример (Unit-тест)
```php
<?php

namespace Tests\Unit\Services;

use App\Services\PdfGenerator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PdfGeneratorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_generates_pdf_from_view(): void
    {
        $generator = new PdfGenerator();
        $html = '<h1>Test</h1><p>Content</p>';

        $result = $generator->fromHtml($html)->output();

        $this->assertIsString($result);
        $this->assertStringContainsString('%PDF-', substr($result, 0, 10));
    }
}
```