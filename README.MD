

install

`composer require defstudio/laravel-components`

`npm install file-saver axios`

Assets

```html
<html>
    <head>
        <!--  -->
        <x-styles/>
        <!--  -->
    </head>

    <body>
        <!--  -->

        <x-tools/>
    </body>
</html>
```

add these directives at the start of your app main .scss

```scss
@import "vendor/defstudio/laravel-components/resources/css/styles";
@import "vendor/defstudio/laravel-components/resources/css/summernote-bs4";
```

and these at the start of your main .js file

```js
require('../../vendor/defstudio/laravel-components/resources/js/tools');
require('../../vendor/defstudio/laravel-components/resources/js/summernote-bs4');
```
