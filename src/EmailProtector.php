<?php
namespace EmailProtector;

use Symfony\Component\HttpFoundation\Request;

class EmailProtector
{
    /**
     * Get Request Object
     *
     * @return \Symfony\Component\HttpFoundation\Request
     */
    private function getRequest(): Request
    {
        return Request::createFromGlobals();
    }

    /**
     * Get request method
     *
     * @return string
     */
    private function getRequestMethod(): string
    {
        return $this
            ->getRequest()
            ->server
            ->get('REQUEST_METHOD') === 'POST' ? 'request' : 'query';
    }

    /**
     * Get Email from request
     *
     * @return string
     */
    private function getEmail(): ?string
    {
        return $this
            ->getRequest()
            ->{$this->getRequestMethod()}
            ->filter('email', null, FILTER_VALIDATE_EMAIL) ?: null;
    }

    /**
     * Get Title from request
     *
     * @return string
     */
    private function getTitle(): ?string
    {
        return $this
            ->getRequest()
            ->{$this->getRequestMethod()}
            ->get('title') ?: null;
    }

    /**
     * Add link to email
     *
     * @param string $title
     * @return string
     */
    private function makeUrl(string $title): string
    {
        return sprintf('<a href="mailto:%s">%s</a>', $this->getEmail(), $title);
    }

    /**
     * Encrypt email and title (if exists)
     *
     * @return string
     */
    public function getEncrypted(): string
    {
        $emailRaw = $this->getEmail();

        if ($this->getTitle() !== null) {
            $emailRaw = $this->makeUrl($this->getTitle());
        }

        return base64_encode($emailRaw) ?: 'email@example.com';
    }

    /**
     * Output HTML code
     *
     * @return string
     */
    public function outputHtml(): string
    {
        return htmlspecialchars(
            sprintf('<script>document.write(atob("%s"));</script>', $this->getEncrypted())
        );
    }

    /**
     * Output HTML code unescaped
     *
     * @return string
     */
    public function outputHtmlRaw(): string
    {
        return sprintf('<script>document.write(atob("%s"));</script>', $this->getEncrypted());
    }

    /**
     * Output as jQuery
     *
     * @param string $element 
     * @return string
     */
    public function outputJquery(string $element): string
    {
        return htmlspecialchars(
            sprintf('<script>$(\'%s\').append(atob("%s"));</script>', $element, $this->getEncrypted())
        );
    }
}
