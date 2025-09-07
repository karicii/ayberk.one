<?php

declare(strict_types=1);

class Router
{
    protected array $routes = [];

    public function add(string $method, string $uri, string $template): self
    {
        $this->routes[] = [
            'uri' => $uri,
            'template' => $template,
            'method' => $method
        ];
        
        return $this;
    }

    public function get(string $uri, string $template): self
    {
        return $this->add('GET', $uri, $template);
    }

    public function post(string $uri, string $template): self
    {
        return $this->add('POST', $uri, $template);
    }

    public function dispatch(string $uri, string $method): void
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                require BASE_PATH . '/templates/' . $route['template'];
                return;
            }
        }

        $this->abort();
    }

    protected function abort(int $code = 404): void
    {
        http_response_code($code);
        require BASE_PATH . "/templates/{$code}.php";
        die();
    }
}