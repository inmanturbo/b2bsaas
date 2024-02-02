# B2bSaas

[![Latest Version on Packagist](https://img.shields.io/packagist/v/inmanturbo/b2bsaas.svg?style=flat-square)](https://packagist.org/packages/inmanturbo/b2bsaas)

[![Total Downloads](https://img.shields.io/packagist/dt/inmanturbo/b2bsaas.svg?style=flat-square)](https://packagist.org/packages/inmanturbo/b2bsaas)

originally a template: <https://github.com/inmanturbo/b2bsaas0>

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
