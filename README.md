Generator
=========

Laravel 4 and Angular artisan generator

Install threw composer:
```
composer require pep/generator
```

Add the following line to the providers array in config/app.php
```
'Pep\Generator\GeneratorServiceProvider',
```

Available generators:
```
generate
  generate:controller      Generate a new controller.
  generate:migration       Generate a new migration.
  generate:model           Generate a new model.
  generate:seed            Generate a new seed.
  generate:ng:controller   Generate a new angular controller.
  generate:ng:directive    Generate a new angular directive.
  generate:ng:factory      Generate a new angular factory.
  generate:ng:filter       Generate a new angular filter.
  generate:ng:service      Generate a new angular service.
  generate:ng:structure    Generate angular directory structure (needed for generating other angular elements).
```

More generators will follow soon!
