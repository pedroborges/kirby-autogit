<?php

use Autogit\Autogit;

kirby()->hook('panel.site.update', function ($site) {
    Autogit::save('site.update');
});

kirby()->hook('panel.page.create', function ($page) {
    Autogit::save('page.create', $page->uri());
});

kirby()->hook('panel.page.update', function ($page) {
    Autogit::save('page.update', $page->uri());
});

kirby()->hook('panel.page.delete', function ($page) {
    Autogit::save('page.delete', $page->uri());
});

kirby()->hook('panel.page.sort', function ($page) {
    Autogit::save('page.sort', $page->uri());
});

kirby()->hook('panel.page.hide', function ($page) {
    Autogit::save('page.hide', $page->uri());
});

kirby()->hook('panel.page.move', function ($newPage, $oldPage) {
    Autogit::save('page.move', $oldPage->uri(), $newPage->uri());
});

kirby()->hook('panel.file.upload', function ($file) {
    Autogit::save('file.upload', "{$file->page()->uri()}/{$file->filename()}");
});

kirby()->hook('panel.file.replace', function ($file) {
    Autogit::save('file.replace', "{$file->page()->uri()}/{$file->filename()}");
});

kirby()->hook('panel.file.rename', function ($file) {
    Autogit::save('file.rename', "{$file->page()->uri()}/{$file->filename()}");
});

kirby()->hook('panel.file.update', function ($file) {
    Autogit::save('file.update', "{$file->page()->uri()}/{$file->filename()}");
});

kirby()->hook('panel.file.sort', function ($file) {
    Autogit::save('file.sort', "{$file->page()->uri()}/{$file->filename()}");
});

kirby()->hook('panel.file.delete', function ($file) {
    Autogit::save('file.delete', "{$file->page()->uri()}/{$file->filename()}");
});
