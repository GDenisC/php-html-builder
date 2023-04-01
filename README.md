# php-html-builder
HTML builder for php.

# Examples
[/examples](https://github.com/GDenisC/php-html-builder/tree/main/examples)

# Example
```php
// from v1.0.1: HTMLBuilder is alias for HTMLTagBuilder
HTMLBuilder::start('body')->addTag(
    HTMLTagBuilder::start('h1')
        ->setValue('Hello world!')
)->end();
```
