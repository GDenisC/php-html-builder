# php-html-builder
HTML builder for php.

# Examples
/examples folder

# Example
```php
HTMLBuilder::start()->addTag(
    HTMLTagBuilder::start('h1')
        ->setValue('Hello world!')
)->end();
```
