<?php
/*
 * Q: is format faster?
 *
 * format: 14 or 6 (one time)
 * without format: 0
 *
 * A: no
 */

include_once '../htmlbuilder.php';

$time = floor(microtime(true) * 1000);

// v1.0.1: HTMLBuilder is alias of HTMLTagBuilder
HTMLBuilder::start('html')->toggleFormat()->addTags(
    HTMLTagBuilder::start("head")->toggleFormat()->addTags(
        HTMLTagBuilder::start("title")->toggleFormat()->setValue("Test page")
    ),
    HTMLTagBuilder::start("body")->toggleFormat()->addTags(
        HTMLTagBuilder::start("h1")->toggleFormat()->setValue("Hello world!")
    )
)->end();

echo "Milliseconds time: ".(string)(floor(microtime(true) * 1000) - $time);

?>