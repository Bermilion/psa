# Промт: Создание модели

## Контекст
Вы создаёте модель для Laravel-приложения MarineService Manager. Приложение предназначено для управления судоремонтными работами.

## Инструкции
1. Создайте модель с именем `{ModelName}`
2. Укажите имя таблицы в БД: `{table_name}`
3. Определите fillable-поля на основе требований
4. Добавьте необходимые отношения (belongsTo, hasMany и др.)
5. Добавьте глобальные scope, если нужно
6. Используйте traits: SoftDeletes, HasFactory
7. Добавьте методы доступа (accessors) и мутаторы (mutators), если нужно

## Требования
- Следовать PSR-12
- Использовать PHPDoc
- Модель должна быть в пространстве имён `App\Models`
- Файл должен быть в `app/Models/{ModelName}.php`

## Пример
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Report
 * @package App\Models
 * @property int $id
 * @property string $title
 * @property int $customer_id
 * @property string $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 */
class Report extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'reports';

    protected $fillable = [
        'title',
        'customer_id',
        'status',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    public function customer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function creator(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
```