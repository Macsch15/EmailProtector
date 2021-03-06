## E-mail Protector [![Build Status](https://travis-ci.org/Macsch15/EmailProtector.svg?branch=master)](https://travis-ci.org/Macsch15/EmailProtector) [![StyleCI](https://github.styleci.io/repos/138799977/shield?branch=master)](https://github.styleci.io/repos/138799977?branch=master)

E-mail protector uses base64 encoding to secure raw e-mail address against SPAM bots.

![zrzut ekranu 2018-06-30 o 01 44 24](https://user-images.githubusercontent.com/1592053/42124864-9c358f76-7c62-11e8-9de3-e9bbb03cb583.png)

![zrzut ekranu 2018-06-30 o 01 45 07](https://user-images.githubusercontent.com/1592053/42124869-aec443f8-7c62-11e8-9517-a625f9a0dcf2.png)

## How to use
Downloading with composer
```
composer require macsch15/emailprotector
```

Install dependencies
```
composer install
```

EmailProtector object has 4 methods that you can use.

#### getEncrypted()
```php
    /**
     * Encrypt email and title (if exists)
     *
     * @return string
     */
    public function getEncrypted() : string
    {
```

Returns raw base64 encoded e-mail address.

#### outputHtml()
```php
    /**
     * Output HTML code
     *
     * @return string
     */
    public function outputHtml() : string
    {
```

Returns HTML code (escaped through PHP's htmlspecialchars()) ready to paste on website.
Example result:
```
<script>document.write(atob("PGEgaHJlZj0ibWFpbHRvOm1haWxAZXhhbXBsZS5jb20iPk15IEUtbWFpbCBhZGRyZXNzPC9hPg=="));</script>
```

#### outputHtmlRaw()
```php
    /**
     * Output HTML code unescaped
     *
     * @return string
     */
    public function outputHtmlRaw() : string
    {
```

Returns **unescaped** HTML code.

#### outputJquery(string $element)
```php
    /**
     * Output as jQuery
     *
     * @param string $element 
     * @return string
     */
    public function outputJquery(string $element) : string
    {
```
Returns HTML code to use with jQuery.
Example result:
```
<script>$('exampleElement').append(atob("PGEgaHJlZj0ibWFpbHRvOm1haWxAZXhhbXBsZS5jb20iPk15IEUtbWFpbCBhZGRyZXNzPC9hPg=="));</script>
```

## Requirements
- PHP >= 7.2

## Author
**Maciej Schmidt**
- [Homepage](http://www.macsch15.pl/ "Homepage")
- [Twitter](https://twitter.com/Macsch15 "Twitter")
- [Donate with PayPal](https://www.paypal.me/MaciejSchmidt "Donate with PayPal")

## MIT Licence

Copyright (c) 2018 Maciej Schmidt

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions: The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
