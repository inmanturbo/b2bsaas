# B2bSaas

originally a template: <https://github.com/inmantubo/b2bsaas0>

## Installation

### First create a new laravel 11 app and install jetstream

```bash
laravel new saas-app --stack=livewire --pest --jet --teams --dark --api --dev
```

### Then install inmanturbo/b2bsaas

```bash
composer require inmanturbo/b2bsaas
```

```bash
 ./vendor/bin/b2bsaas
 ```

### Then run landlord migrations

 ```bash
 php artisan migrate:fresh --path=database/migrations/landlord --database=landlord_sqlite
 ```
