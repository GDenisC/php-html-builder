# php-html-builder
HTML builder for php.

# Examples
[/examples](https://github.com/GDenisC/php-html-builder/tree/main/examples)

# Example
```php
HTMLBuilder::start()->addTag(
    HTMLTagBuilder::start('h1')
        ->setValue('Hello world!')
)->end();
```
