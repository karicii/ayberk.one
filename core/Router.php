<?php

declare(strict_types=1);

class Router
{
    protected array $routes = [];
    protected array $params = [];
    protected $matchedRouteIndex; 
    protected function add(string $method, string $uri, string $controller): self
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => strtoupper($method)
        ];
        return $this;
    }

    public function get(string $uri, string $controller): self { return $this->add('GET', $uri, $controller); }
    public function post(string $uri, string $controller): self { return $this->add('POST', $uri, $controller); }
    public function delete(string $uri, string $controller): self { return $this->add('DELETE', $uri, $controller); }
    public function patch(string $uri, string $controller): self { return $this->add('PATCH', $uri, $controller); }
    public function put(string $uri, string $controller): self { return $this->add('PUT', $uri, $controller); }

    public function dispatch(string $uri, string $method): void
    {
        if ($this->match($uri, $method)) {
            $controllerPath = BASE_PATH . '/controllers/' . $this->routes[$this->matchedRouteIndex]['controller'];
            if (file_exists($controllerPath)) {
                require $controllerPath;
                return;
            }
        }
        $this->abort();
    }
    
    protected function match(string $uri, string $method): bool
    {
        foreach ($this->routes as $index => $route) {
            if ($route['method'] !== strtoupper($method)) {
                continue;
            }

            $routeUri = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[a-zA-Z0-9_-]+)', $route['uri']);
            $routeUri = '#^' . $routeUri . '$#';

            if (preg_match($routeUri, $uri, $matches)) {
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $this->params[$key] = $value;
                    }
                }
                $this->matchedRouteIndex = $index;
                return true;
            }
        }
        return false;
    }

    public function params(string $key = null)
    {
        return $key ? ($this->params[$key] ?? null) : $this->params;
    }

    protected function abort(int $code = 404): void
    {
        http_response_code($code);
        require BASE_PATH . "/templates/{$code}.php";
        die();
    }
}