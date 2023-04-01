# php-html-builder
HTML builder for php.

# Examples
[Examples folder](https://github.com/GDenisC/php-html-builder/tree/master/examples)

```php
/* from v1.0.1: HTMLBuilder is alias for HTMLTagBuilder */
HTMLBuilder::start('html')->addTags(
    HTMLTagBuilder::start('body')->addTag(
        HTMLTagBuilder::start('title')
            ->setValue('Document')
    ),
    HTMLTagBuilder::start('body')->addTag(
        HTMLTagBuilder::start('h1')
            ->setValue('Hello world!')
    )
)->end()
```
