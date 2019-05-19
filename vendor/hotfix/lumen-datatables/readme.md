## Datatables Package for Lumen 5

Librement inspiré de [Datatables Package for Laravel 4|5](https://github.com/yajra/laravel-datatables)

## Installation

1. Télécharger le service via composer (ou autre) 
```
$ composer require hotfix/lumen-datatable
```

2. Télécharger le js de [DataTable](https://datatables.net/download/index) via bower (ou autre)
```
$ bower install datatables --save
```

3. Rajouter dans le bootstrap/app.php de votre projet

```php
$app->register(Hotfix\Datatables\DatatablesServiceProvider::class);
```

## Utilisation

Voir la doc de [Laravel Datatables](http://datatables.yajrabox.com/eloquent/basic)