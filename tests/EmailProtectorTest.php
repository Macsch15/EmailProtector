<?php

namespace EmailProtector\Tests;

use EmailProtector\EmailProtector;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class EmailProtectorTest extends TestCase
{
    protected $protector;

    public function setUp(): void
    {
        $this->protector = new EmailProtector();
    }

    public function testGetPlainBase64()
    {
        $request = Request::create('/', 'GET', ['email' => 'test@example.com']);
        $request->overrideGlobals();

        $this->assertSame('dGVzdEBleGFtcGxlLmNvbQ==', $this->protector->getEncrypted());
    }

    public function testPostPlainBase64()
    {
        $request = Request::create('/', 'POST', ['email' => 'test@example.com']);
        $request->overrideGlobals();

        $this->assertSame('dGVzdEBleGFtcGxlLmNvbQ==', $this->protector->getEncrypted());
    }

    public function testGetEmailNotProvided()
    {
        $request = Request::create('/', 'GET', ['email' => null]);
        $request->overrideGlobals();

        $this->assertSame('email@example.com', $this->protector->getEncrypted());
    }

    public function testPostEmailNotProvided()
    {
        $request = Request::create('/', 'POST', ['email' => null]);
        $request->overrideGlobals();

        $this->assertSame('email@example.com', $this->protector->getEncrypted());
    }

    public function testGetOutputHtml()
    {
        $request = Request::create('/', 'GET', ['email' => 'test@example.com']);
        $request->overrideGlobals();

        $this->assertSame('&lt;script&gt;document.write(atob(&quot;dGVzdEBleGFtcGxlLmNvbQ==&quot;));&lt;/script&gt;', $this->protector->outputHtml());
    }

    public function testGetOutputHtmlEmailNotProvided()
    {
        $request = Request::create('/', 'GET', ['email' => null]);
        $request->overrideGlobals();

        $this->assertSame('&lt;script&gt;document.write(atob(&quot;email@example.com&quot;));&lt;/script&gt;', $this->protector->outputHtml());
    }

    public function testPostOutputHtml()
    {
        $request = Request::create('/', 'POST', ['email' => 'test@example.com']);
        $request->overrideGlobals();

        $this->assertSame('&lt;script&gt;document.write(atob(&quot;dGVzdEBleGFtcGxlLmNvbQ==&quot;));&lt;/script&gt;', $this->protector->outputHtml());
    }

    public function testPostOutputHtmlEmailNotProvided()
    {
        $request = Request::create('/', 'POST', ['email' => null]);
        $request->overrideGlobals();

        $this->assertSame('&lt;script&gt;document.write(atob(&quot;email@example.com&quot;));&lt;/script&gt;', $this->protector->outputHtml());
    }

    public function testGetOutputHtmlRaw()
    {
        $request = Request::create('/', 'GET', ['email' => 'test@example.com']);
        $request->overrideGlobals();

        $this->assertSame('<script>document.write(atob("dGVzdEBleGFtcGxlLmNvbQ=="));</script>', $this->protector->outputHtmlRaw());
    }

    public function testGetOutputHtmlRawEmailNotProvided()
    {
        $request = Request::create('/', 'GET', ['email' => null]);
        $request->overrideGlobals();

        $this->assertSame('<script>document.write(atob("email@example.com"));</script>', $this->protector->outputHtmlRaw());
    }

    public function testPostOutputHtmlRaw()
    {
        $request = Request::create('/', 'POST', ['email' => 'test@example.com']);
        $request->overrideGlobals();

        $this->assertSame('<script>document.write(atob("dGVzdEBleGFtcGxlLmNvbQ=="));</script>', $this->protector->outputHtmlRaw());
    }

    public function testPostOutputHtmlRawEmailNotProvided()
    {
        $request = Request::create('/', 'POST', ['email' => null]);
        $request->overrideGlobals();

        $this->assertSame('<script>document.write(atob("email@example.com"));</script>', $this->protector->outputHtmlRaw());
    }

    public function testGetOutputJquery()
    {
        $request = Request::create('/', 'GET', ['email' => 'test@example.com']);
        $request->overrideGlobals();

        $this->assertSame('&lt;script&gt;$(\'testing\').append(atob(&quot;dGVzdEBleGFtcGxlLmNvbQ==&quot;));&lt;/script&gt;', $this->protector->outputJquery('testing'));
    }

    public function testGetOutputJqueryEmailNotProvided()
    {
        $request = Request::create('/', 'GET', ['email' => null]);
        $request->overrideGlobals();

        $this->assertSame('&lt;script&gt;$(\'testing\').append(atob(&quot;email@example.com&quot;));&lt;/script&gt;', $this->protector->outputJquery('testing'));
    }

    public function testPostOutputJquery()
    {
        $request = Request::create('/', 'POST', ['email' => 'test@example.com']);
        $request->overrideGlobals();

        $this->assertSame('&lt;script&gt;$(\'testing\').append(atob(&quot;dGVzdEBleGFtcGxlLmNvbQ==&quot;));&lt;/script&gt;', $this->protector->outputJquery('testing'));
    }

    public function testPostOutputJqueryEmailNotProvided()
    {
        $request = Request::create('/', 'POST', ['email' => null]);
        $request->overrideGlobals();

        $this->assertSame('&lt;script&gt;$(\'testing\').append(atob(&quot;email@example.com&quot;));&lt;/script&gt;', $this->protector->outputJquery('testing'));
    }

    public function testGetTitledOutputHtml()
    {
        $request = Request::create('/', 'GET', ['email' => 'test@example.com', 'title' => 'My E-mail address']);
        $request->overrideGlobals();

        $this->assertSame('&lt;script&gt;document.write(atob(&quot;PGEgaHJlZj0ibWFpbHRvOnRlc3RAZXhhbXBsZS5jb20iPk15IEUtbWFpbCBhZGRyZXNzPC9hPg==&quot;));&lt;/script&gt;', $this->protector->outputHtml());
    }

    public function testGetTitledOutputHtmlEmailNotProvided()
    {
        $request = Request::create('/', 'GET', ['email' => null, 'title' => 'My E-mail address']);
        $request->overrideGlobals();

        $this->assertSame('&lt;script&gt;document.write(atob(&quot;PGEgaHJlZj0ibWFpbHRvOiI+TXkgRS1tYWlsIGFkZHJlc3M8L2E+&quot;));&lt;/script&gt;', $this->protector->outputHtml());
    }

    public function testPostTitledOutputHtml()
    {
        $request = Request::create('/', 'POST', ['email' => 'test@example.com', 'title' => 'My E-mail address']);
        $request->overrideGlobals();

        $this->assertSame('&lt;script&gt;document.write(atob(&quot;PGEgaHJlZj0ibWFpbHRvOnRlc3RAZXhhbXBsZS5jb20iPk15IEUtbWFpbCBhZGRyZXNzPC9hPg==&quot;));&lt;/script&gt;', $this->protector->outputHtml());
    }

    public function testPostTitledOutputHtmlEmailNotProvided()
    {
        $request = Request::create('/', 'POST', ['email' => null, 'title' => 'My E-mail address']);
        $request->overrideGlobals();

        $this->assertSame('&lt;script&gt;document.write(atob(&quot;PGEgaHJlZj0ibWFpbHRvOiI+TXkgRS1tYWlsIGFkZHJlc3M8L2E+&quot;));&lt;/script&gt;', $this->protector->outputHtml());
    }

    public function testGetTitledOutputHtmlRaw()
    {
        $request = Request::create('/', 'GET', ['email' => 'test@example.com', 'title' => 'My E-mail address']);
        $request->overrideGlobals();

        $this->assertSame('<script>document.write(atob("PGEgaHJlZj0ibWFpbHRvOnRlc3RAZXhhbXBsZS5jb20iPk15IEUtbWFpbCBhZGRyZXNzPC9hPg=="));</script>', $this->protector->outputHtmlRaw());
    }

    public function testGetTitledOutputHtmlRawEmailNotProvided()
    {
        $request = Request::create('/', 'GET', ['email' => null, 'title' => 'My E-mail address']);
        $request->overrideGlobals();

        $this->assertSame('<script>document.write(atob("PGEgaHJlZj0ibWFpbHRvOiI+TXkgRS1tYWlsIGFkZHJlc3M8L2E+"));</script>', $this->protector->outputHtmlRaw());
    }

    public function testPostTitledOutputHtmlRaw()
    {
        $request = Request::create('/', 'POST', ['email' => 'test@example.com', 'title' => 'My E-mail address']);
        $request->overrideGlobals();

        $this->assertSame('<script>document.write(atob("PGEgaHJlZj0ibWFpbHRvOnRlc3RAZXhhbXBsZS5jb20iPk15IEUtbWFpbCBhZGRyZXNzPC9hPg=="));</script>', $this->protector->outputHtmlRaw());
    }

    public function testPostTitledOutputHtmlRawEmailNotProvided()
    {
        $request = Request::create('/', 'POST', ['email' => null, 'title' => 'My E-mail address']);
        $request->overrideGlobals();

        $this->assertSame('<script>document.write(atob("PGEgaHJlZj0ibWFpbHRvOiI+TXkgRS1tYWlsIGFkZHJlc3M8L2E+"));</script>', $this->protector->outputHtmlRaw());
    }

    public function testGetTitledOutputJquery()
    {
        $request = Request::create('/', 'GET', ['email' => 'test@example.com', 'title' => 'My E-mail address']);
        $request->overrideGlobals();

        $this->assertSame('&lt;script&gt;$(\'testing\').append(atob(&quot;PGEgaHJlZj0ibWFpbHRvOnRlc3RAZXhhbXBsZS5jb20iPk15IEUtbWFpbCBhZGRyZXNzPC9hPg==&quot;));&lt;/script&gt;', $this->protector->outputJquery('testing'));
    }

    public function testGetTitledOutputJqueryEmailNotProvided()
    {
        $request = Request::create('/', 'GET', ['email' => null, 'title' => 'My E-mail address']);
        $request->overrideGlobals();

        $this->assertSame('&lt;script&gt;$(\'testing\').append(atob(&quot;PGEgaHJlZj0ibWFpbHRvOiI+TXkgRS1tYWlsIGFkZHJlc3M8L2E+&quot;));&lt;/script&gt;', $this->protector->outputJquery('testing'));
    }

    public function testPostTitledOutputJquery()
    {
        $request = Request::create('/', 'POST', ['email' => 'test@example.com', 'title' => 'My E-mail address']);
        $request->overrideGlobals();

        $this->assertSame('&lt;script&gt;$(\'testing\').append(atob(&quot;PGEgaHJlZj0ibWFpbHRvOnRlc3RAZXhhbXBsZS5jb20iPk15IEUtbWFpbCBhZGRyZXNzPC9hPg==&quot;));&lt;/script&gt;', $this->protector->outputJquery('testing'));
    }

    public function testPostTitledOutputJqueryEmailNotProvided()
    {
        $request = Request::create('/', 'POST', ['email' => null, 'title' => 'My E-mail address']);
        $request->overrideGlobals();

        $this->assertSame('&lt;script&gt;$(\'testing\').append(atob(&quot;PGEgaHJlZj0ibWFpbHRvOiI+TXkgRS1tYWlsIGFkZHJlc3M8L2E+&quot;));&lt;/script&gt;', $this->protector->outputJquery('testing'));
    }
}
