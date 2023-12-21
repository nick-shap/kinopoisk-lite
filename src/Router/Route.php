<?php

namespace App\Router;

class Route
{

    /**
     * @param $uri
     * @param string $method
     * @param $action
     */
    public function __construct(
        private string $uri,
        private string $method,
        private $action,
    )
    {}

    public static function get(string $uri, $action): static
    {
        return new self($uri, 'GET', $action);
    }

    public static function post(string $uri, $action): static
    {
        return new self($uri, 'POST', $action);
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     */
    public function setMethod(string $method): void
    {
        $this->method = $method;
    }

    /**
     * @return mixed
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @param mixed $uri
     */
    public function setUri($uri): void
    {
        $this->uri = $uri;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $action
     */
    public function setAction($action): void
    {
        $this->action = $action;
    }
}