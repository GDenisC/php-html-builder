<?php
include_once '../htmlbuilder.php';

HTMLBuilder::start('html')->addTags(
    HTMLTagBuilder::start('head')->addTags(
        HTMLTagBuilder::start('meta')
            ->setAttr('charset', 'UTF-8'),
        HTMLTagBuilder::start('link')
            ->setAttr('rel', 'stylesheet')
            ->setAttr('href', './my_example_styles_2.css'),
        HTMLTagBuilder::start('title')
            ->setValue('My page'),
        HTMLTagBuilder::start('style')
            ->setValue(file_get_contents('./my_example_styles_1.css')),
    ),
    HTMLTagBuilder::start('body')->addTags(
        HTMLTagBuilder::start('h1')
            ->setValue('Hello world!'),
        HTMLTagBuilder::start('h2')
            ->setValue('time(): '.time()),
        HTMLTagBuilder::start('img')
            ->setAttr('src', './img.png')
            ->setAttr('alt', '.')
            ->setAttr('width', '128px')
            ->setAttr('height', '128px'),
        HTMLTagBuilder::start('br'),
        HTMLTagBuilder::start('input')
            ->setAttr('name', 'password')
            ->setAttr('type', 'password')
            ->setFull(true)
    )
)->end();
?>