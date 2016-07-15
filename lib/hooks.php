<?php

kirby()->hook('panel.site.update', function ($site) {
    autogit()->save('site.update');
});

kirby()->hook('panel.page.create', function ($page) {
    autogit()->save('page.create', $page->uri());
});

kirby()->hook('panel.page.update', function ($page) {
    autogit()->save('page.update', $page->uri());
});

kirby()->hook('panel.page.delete', function ($page) {
    autogit()->save('page.delete', $page->uri());
});

kirby()->hook('panel.page.sort', function ($page) {
    autogit()->save('page.sort', $page->uri());
});

kirby()->hook('panel.page.hide', function ($page) {
    autogit()->save('page.hide', $page->uri());
});

kirby()->hook('panel.page.move', function ($newPage, $oldPage) {
    autogit()->save('page.move', $oldPage->uri(), $newPage->uri());
});

kirby()->hook('panel.file.upload', function ($file) {
    autogit()->save('file.upload', $file->page()->uri().'/'.$file->filename());
});

kirby()->hook('panel.file.replace', function ($file) {
    autogit()->save('file.replace', $file->page()->uri().'/'.$file->filename());
});

kirby()->hook('panel.file.rename', function ($file) {
    autogit()->save('file.rename', $file->page()->uri().'/'.$file->filename());
});

kirby()->hook('panel.file.update', function ($file) {
    autogit()->save('file.update', $file->page()->uri().'/'.$file->filename());
});

kirby()->hook('panel.file.sort', function ($file) {
    autogit()->save('file.sort', $file->page()->uri().'/'.$file->filename());
});

kirby()->hook('panel.file.delete', function ($file) {
    autogit()->save('file.delete', $file->page()->uri().'/'.$file->filename());
});
