
# Currency Module for Laravel

Модуль для хранения и конвертации валют в Laravel-проекте.  
Позволяет:
- Управлять списком валют через админку.
- Загружать курсы валют с [freecurrencyapi.com](https://freecurrencyapi.com/) раз в сутки.
- Конвертировать суммы из одной валюты в другую через сервис.

---

## 💻 Требования

- PHP >= 8.1
- Laravel 12
- Composer
- База данных MySQL/PostgreSQL/SQLite

---

## 🚀 Установка

1. **Склонируйте проект** (или добавьте модуль в существующий Laravel-проект):

```bash
git clone https://github.com/finarato/currency-converter.git
cd currency-converter
```

2. **Установите зависимости:**

```bash
composer install
```

3. **Скопируйте `.env.example` в `.env`** и настройте подключение к базе:

```bash
cp .env.example .env
php artisan key:generate
```

4. **Внесите API key для freecurrencyapi.com в `.env` как `CURRENCY_API_KEY`:**

5. **Примените миграции для таблиц валют и курсов:**

```bash
php artisan migrate
```

6. **Команда для загрузки курсов из API (выполнять раз в сутки cron):**

```bash
php artisan currency:update-rates
```

---

## ⚙️ Использование

- Запустить локальный сервер

```bash
php artisan serve
```

### Админка

- Таблица валют: `/currency/currencies`  
  Добавление/удаление валют через интерфейс.

- Таблица курсов: `/currency`  
  Просмотр последних курсов валют.

- Конвертер валют: `/currency/convert`  
  Конвертация суммы из одной валюты в другую.

### Сервис конвертации

В коде можно использовать сервис `CurrencyConverter`:

```php
use App\Modules\Currency\Services\CurrencyConverter;

$converter = new CurrencyConverter();

$amountInRub = $converter->convert(100, 'USD', 'EUR');
```

- Сервис использует **только валюты, зарегистрированные через админку**.

---
