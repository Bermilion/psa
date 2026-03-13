# Промт: Создание API-контроллера

## Контекст
Вы создаёте API-контроллер для Laravel-приложения MarineService Manager.

## Инструкции
1. Создайте контроллер с именем `{ControllerName}Controller`
2. Контроллер должен быть в пространстве имён `App\Http\Controllers\Api\V1`
3. Файл должен быть в `app/Http/Controllers/Api/V1/{ControllerName}Controller.php`
4. Используйте API-ресурсные методы: index, show, store, update, destroy
5. Валидация — через FormRequest
6. Авторизация — через middleware и метод authorize
7. Возвращайте JSON-ответы в соответствии со стандартами

## Требования
- Следовать PSR-12
- Использовать PHPDoc
- Все методы должны возвращать стандартизированные ответы
- Использовать транзакции для операций записи
- Обрабатывать исключения

## Пример
```php
<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Report\StoreReportRequest;
use App\Http\Requests\Api\V1\Report\UpdateReportRequest;
use App\Http\Resources\ReportResource;
use App\Models\Report;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * @group Reports
 * API для управления отчётами
 */
class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Report::class, 'report');
    }

    /**
     * @response 200 {
     *   "success": true,
     *   "data": {
     *     "reports": [
     *       {
     *         "id": 1,
     *         "title": "Акт дефектации",
     *         "status": "draft"
     *       }
     *     ],
     *     "message": "Список отчётов получен"
     *   }
     * }
     */
    public function index(Request $request): JsonResponse
    {
        $reports = Report::query()
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->get('status'));
            })
            ->when($request->filled('customer_id'), function ($query) use ($request) {
                $query->where('customer_id', $request->get('customer_id'));
            })
            ->paginate(15);

        return response()->json([
            'success' => true,
            'data' => [
                'reports' => ReportResource::collection($reports)
            ],
            'message' => 'Список отчётов получен'
        ]);
    }

    /**
     * @urlParam report required ID отчёта
     * @response 200 {
     *   "success": true,
     *   "data": {
     *     "report": {
     *       "id": 1,
     *       "title": "Акт дефектации",
     *       "status": "draft"
     *     }
     *   }
     * }
     * @response 404 {
     *   "success": false,
     *   "errors": [],
     *   "message": "Отчёт не найден"
     * }
     */
    public function show(Report $report): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                'report' => new ReportResource($report)
            ],
            'message' => 'Отчёт получен'
        ]);
    }

    /**
     * @bodyParam title string required Название отчёта
     * @bodyParam customer_id integer required ID заказчика
     * @bodyParam status string required Статус: draft, pending, approved, archived
     * @response 201 {
     *   "success": true,
     *   "data": {
     *     "report": {
     *       "id": 1,
     *       "title": "Новый акт",
     *       "status": "draft"
     *     }
     *   }
     * }
     * @response 422 {
     *   "success": false,
     *   "errors": [
     *     {
     *       "field": "title",
     *       "message": "Поле обязательно."
     *     }
     *   ],
     *   "message": "Валидация не пройдена"
     * }
     */
    public function store(StoreReportRequest $request): JsonResponse
    {
        $report = DB::transaction(function () use ($request) {
            return Report::create($request->validated());
        });

        return response()->json([
            'success' => true,
            'data' => [
                'report' => new ReportResource($report)
            ],
            'message' => 'Отчёт создан'
        ], 201);
    }

    /**
     * @urlParam report required ID отчёта
     * @bodyParam title string Название отчёта
     * @bodyParam customer_id integer ID заказчика
     * @bodyParam status string Статус: draft, pending, approved, archived
     * @response 200 {
     *   "success": true,
     *   "data": {
     *     "report": {
     *       "id": 1,
     *       "title": "Обновлённый акт",
     *       "status": "draft"
     *     }
     *   }
     * }
     */
    public function update(UpdateReportRequest $request, Report $report): JsonResponse
    {
        DB::transaction(function () use ($report, $request) {
            $report->update($request->validated());
        });

        return response()->json([
            'success' => true,
            'data' => [
                'report' => new ReportResource($report->fresh())
            ],
            'message' => 'Отчёт обновлён'
        ]);
    }

    /**
     * @urlParam report required ID отчёта
     * @response 200 {
     *   "success": true,
     *   "data": [],
     *   "message": "Отчёт удалён"
     * }
     */
    public function destroy(Report $report): JsonResponse
    {
        DB::transaction(function () use ($report) {
            $report->delete();
        });

        return response()->json([
            'success' => true,
            'data' => [],
            'message' => 'Отчёт удалён'
        ]);
    }
}
```