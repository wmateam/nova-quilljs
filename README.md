# Laravel Nova Quilljs editor Field

# Note

Note This package has been forked from [ek0519/nova-quilljs](https://github.com/ek0519/nova-quilljs) and contains some features about uploading image from clipboard.

A Laravel Nova implementation of the [Quill editor for Vue.js](https://github.com/surmon-china/vue-quill-editor)

[![Latest Stable Version](https://poser.pugx.org/wmateam/nova-quilljs/v/stable)](https://packagist.org/packages/wmateam/nova-quilljs)
[![Total Downloads](https://poser.pugx.org/wmateam/nova-quilljs/downloads)](https://packagist.org/packages/wmateam/nova-quilljs)
[![License](https://poser.pugx.org/wmateam/nova-quilljs/license)](https://packagist.org/packages/wmateam/nova-quilljs)
[![Monthly Downloads](https://poser.pugx.org/wmateam/nova-quilljs/d/monthly)](https://packagist.org/packages/wmateam/nova-quilljs)
[![Daily Downloads](https://poser.pugx.org/wmateam/nova-quilljs/d/daily)](https://packagist.org/packages/wmateam/nova-quilljs)
## What's new (20200708)?

Thanks for [Gabrijel Gavranović](https://github.com/gavro)'s PR, add file upload max size **setting**.


## Installation

Install via composer
```sh
composer require wmateam/nova-quilljs
```

## Modify quill's height and width

### **fullWidth(value)**
Boolean

### **height(value)**
Number (unit px)
```php
use Wmateam\NovaQuilljs\NovaQuilljs;

NovaQuilljs::make('content')
        ->withFiles('public')
        ->fullWidth(false) (option, default full-width)
        ->height(500) (option, default 300px)
        ->rules('required'),
```

## **resize** and **align** image

I add this module https://github.com/Fandom-OSS/quill-blot-formatter , thanks for https://github.com/Fandom-OSS

## Image upload size

### **maxFileSize(size)**  
size : Number, default 2(MB)  
**example**
```php
use Wmateam\NovaQuilljs\NovaQuilljs;

NovaQuilljs::make('content')
        ->withFiles('public')
        ->maxFileSize(3)
        ->rules('required'),
```

## Image upload

This Nova field provides native attachments driver which works similar to [Trix File Uploads](https://nova.laravel.com/docs/2.0/resources/fields.html#trix-field).

To use this attachments driver, publish and run the migration(also publish quilljs config to set [toolbar](https://quilljs.com/docs/modules/toolbar/)):

```sh
php artisan vendor:publish --provider="Wmateam\NovaQuilljs\FieldServiceProvider"
php artisan migrate
```

Then, allow users to upload images, just like with Trix field, chaining the withFiles method onto the field's definition. When calling this method, you should pass the name of the filesystem disk that images should be stored on(in this example, we use **public**, please use this command `php artisan storage:link` ):

```php
use Wmateam\NovaQuilljs\NovaQuilljs;

NovaQuilljs::make('content')
        ->withFiles('public')
        ->placeholder('please enter here')
        ->rules('required'),

```

## Customizing Tooltips

![](https://i.imgur.com/kSNwoUO.png)

In default, tooltip was disabled, if you want to use, in **Resource** add **->tooltip(true)**

```php
NovaQuilljs::make(__('Content'), 'content')
                ->withFiles('public')
                ->tooltip(true)
```

**in config/tooltip.php** 

You can use favorite description of tooltip.

```php
<?php

return [
        ['Choice' =>'.ql-bold','title' =>'bold'],
        ['Choice' =>'.ql-italic','title' =>'italic'],
        ['Choice' =>'.ql-underline','title' =>'underline'],
        ['Choice' =>'.ql-header','title' =>'header'],
        ['Choice' =>'.ql-strike','title' =>'strike'],
        ['Choice' =>'.ql-blockquote','title' =>'blockquote'],
        ['Choice' =>'.ql-code-block','title' =>'code-block'],
        ['Choice' =>'.ql-size','title' =>'font-size'],
        ['Choice' =>'.ql-list[value="ordered"]','title' =>'order list'],
        ['Choice' =>'.ql-list[value="bullet"]','title' =>'bulleted list'],
        ['Choice' =>'.ql-header[value="1"]','title' =>'h1'],
        ['Choice' =>'.ql-header[value="2"]','title' =>'h2'],
        ['Choice' =>'.ql-align','title' =>'align'],
        ['Choice' =>'.ql-color','title' =>'color'],
        ['Choice' =>'.ql-background','title' =>'background'],
        ['Choice' =>'.ql-image','title' =>'image'],
        ['Choice' =>'.ql-video','title' =>'video'],
        ['Choice' =>'.ql-link','title' =>'link'],
        ['Choice' =>'.ql-formula','title' =>'formula'],
        ['Choice' =>'.ql-clean','title' =>'clean'],
        ['Choice' =>'.ql-indent[value="-1"]','title' =>'indent left'],
        ['Choice' =>'.ql-indent[value="+1"]','title' =>'indent right'],
        ['Choice' =>'.ql-header .ql-picker-label','title' =>'header size'],
        ['Choice' =>'.ql-header .ql-picker-item[data-value="1"]','title' =>'H1'],
        ['Choice' =>'.ql-header .ql-picker-item[data-value="2"]','title' =>'H2'],
        ['Choice' =>'.ql-header .ql-picker-item[data-value="3"]','title' =>'H3'],
        ['Choice' =>'.ql-header .ql-picker-item[data-value="4"]','title' =>'H4'],
        ['Choice' =>'.ql-header .ql-picker-item[data-value="5"]','title' =>'H5'],
        ['Choice' =>'.ql-header .ql-picker-item[data-value="6"]','title' =>'H6'],
        ['Choice' =>'.ql-header .ql-picker-item:last-child','title' =>'normal'],
        ['Choice' =>'.ql-size .ql-picker-item[data-value="small"]','title' =>'small'],
        ['Choice' =>'.ql-size .ql-picker-item[data-value="large"]','title' =>'large'],
        ['Choice' =>'.ql-size .ql-picker-item[data-value="huge"]','title' =>'xlarge'],
        ['Choice' =>'.ql-size .ql-picker-item:nth-child(2)','title' =>'normal'],
        ['Choice' =>'.ql-align .ql-picker-item:first-child','title' =>'align left'],
        ['Choice' =>'.ql-align .ql-picker-item[data-value="center"]','title' =>'align center'],
        ['Choice' =>'.ql-align .ql-picker-item[data-value="right"]','title' =>'align right'],
        ['Choice' =>'.ql-align .ql-picker-item[data-value="justify"]','title' =>'justify']
];
```

## Customizing Quilljs Toolbar

If you want to change toolbar's setting, you can change quilljs.php in config folder, referrence quilljs's web site https://quilljs.com/docs/modules/toolbar

```php
return [
    ["bold", "italic", "underline", "strike"],
    ["blockquote", "code-block"],
    [ ['header'=> 1 ], ['header'=> 2]],
    [['list'=> "ordered" ], ['list'=> "bullet" ]],
    [[ 'script'=> "sub" ], [ 'script'=> "super" ]],
    [[ 'indent'=> "-1" ], [ 'indent'=> "+1" ]],
    [[ 'direction'=> "rtl" ]],
    [[ 'size'=> ["small", false, "large", "huge"] ]],
    [[ 'header'=> [1, 2, 3, 4, 5, 6, false] ]],
    [[ 'color'=> [] ], [ 'background'=> [] ]],
    [[ 'font'=> [] ]],
    [[ 'align'=> [] ]],
    ["clean"],
    ["link", "image", "video"]
];
```

## Video embed

Only support **Youtube** **Facebook**，default size in Nova was **width 800px** and **height 450px**，define in css
```css
.ql-video{
  width: 800px;
  height: 450px;
}
```


### Youtube

* Example url https://www.youtube.com/watch?v=rgHqK6Dge4w

![](https://i.imgur.com/qNYYk91.png)

### Facebook

* Example Url https://www.facebook.com/standnewshk/videos/272770540314346/UzpfSTEzODQ4NjU1NDY6MTAyMjEzMDE0MDExMDk2MDM/

![](https://i.imgur.com/lqDj6Y4.png)


