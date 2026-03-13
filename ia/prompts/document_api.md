# Промт: Документирование API

## Контекст
Вы документируете API для Laravel-приложения MarineService Manager.

## Инструкции
1. Используйте формат OpenAPI 3.0 (Swagger)
2. Документируйте все эндпоинты из контроллера
3. Укажите метод, путь, параметры, заголовки, тело запроса, ответы
4. Добавьте примеры запросов и ответов
5. Сгруппируйте эндпоинты по тегам
6. Укажите требования к аутентификации
7. Обновите документацию при изменениях

## Требования
- Использовать YAML-формат
- Файл должен быть в `api-docs/openapi.yaml`
- Все строки на русском языке
- Использовать актуальные версии схем
- Проверять валидность спецификации

## Структура
```yaml
openapi: 3.0.0
info:
  title: MarineService Manager API
  description: API для системы управления судоремонтными работами
  version: 1.0.0
servers:
  - url: https://api.marineservice.local/v1
    description: Локальное окружение
  - url: https://api.marineservice.pro/v1
    description: Продакшн
security:
  - bearerAuth: []
components:
  securitySchemes:
    bearerAuth:
      type: http
      scheme: bearer
      bearerFormat: JWT
  schemas:
    SuccessResponse:
      type: object
      properties:
        success:
          type: boolean
          example: true
        data:
          type: object
          additionalProperties: true
        message:
          type: string
          example: Операция выполнена успешно
    ErrorResponse:
      type: object
      properties:
        success:
          type: boolean
          example: false
        errors:
          type: array
          items:
            type: object
            properties:
              field:
                type: string
                example: email
              message:
                type: string
                example: Поле обязательно для заполнения
        message:
          type: string
          example: Валидация не пройдена

paths:
  /reports:
    get:
      tags:
        - Reports
      summary: Получение списка отчётов
      parameters:
        - name: status
          in: query
          description: Фильтр по статусу
          schema:
            type: string
            enum: [draft, pending, approved, archived]
        - name: customer_id
          in: query
          description: Фильтр по заказчику
          schema:
            type: integer
      responses:
        '200':
          description: Список отчётов
          content:
            application/json:
              schema:
                allOf:
                  - $ref: '#/components/schemas/SuccessResponse'
                  - type: object
                    properties:
                      data:
                        type: object
                        properties:
                          reports:
                            type: array
                            items:
                              $ref: '#/components/schemas/Report'
        '401':
          description: Неавторизован
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ErrorResponse'

    post:
      tags:
        - Reports
      summary: Создание нового отчёта
      requestBody:
        required: true
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/StoreReportRequest'
      responses:
        '201':
          description: Отчёт создан
          content:
            application/json:
              schema:
                allOf:
                  - $ref: '#/components/schemas/SuccessResponse'
                  - type: object
                    properties:
                      data:
                        type: object
                        properties:
                          report:
                            $ref: '#/components/schemas/Report'
        '422':
          description: Ошибка валидации
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ErrorResponse'

  /reports/{id}:
    get:
      tags:
        - Reports
      summary: Получение отчёта по ID
      parameters:
        - name: id
          in: path
          required: true
          schema:
            type: integer
      responses:
        '200':
          description: Данные отчёта
          content:
            application/json:
              schema:
                allOf:
                  - $ref: '#/components/schemas/SuccessResponse'
                  - type: object
                    properties:
                      data:
                        type: object
                        properties:
                          report:
                            $ref: '#/components/schemas/Report'
        '404':
          description: Отчёт не найден
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/ErrorResponse'

schemas:
  Report:
    type: object
    properties:
      id:
        type: integer
      title:
        type: string
      status:
        type: string
        enum: [draft, pending, approved, archived]
      customer_id:
        type: integer
      created_at:
        type: string
        format: date-time
      updated_at:
        type: string
        format: date-time

  StoreReportRequest:
    type: object
    required:
      - title
      - customer_id
      - status
    properties:
      title:
        type: string
        maxLength: 255
      customer_id:
        type: integer
      status:
        type: string
        enum: [draft, pending, approved, archived]
```
