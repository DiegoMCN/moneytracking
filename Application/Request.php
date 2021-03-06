<?php

namespace Application;


class Request
{
    /**
     * Propiedad con el controlador de la solicitud
     * @var string
     */
    private $_controller;
    /**
     * Propiedad con el método de la solicitud
     * @var string
     */
    private $_method;
    /**
     * Propiedad con los argumentos de la solicitud
     * @var array
     */
    private $_args;
    /**
     * Request constructor.
     */
    public function __construct()
    {
        $url = $this->parseUrl();
        $url = array_filter($url);
        $this->_controller = strtolower(array_shift($url));
        $this->_method = strtolower(array_shift($url));
        $this->_args = $url;
        $this->verifyUrl();
    }
    /**
     * Método para verificar la URL
     */
    private function verifyUrl(): void
    {
        if (!$this->_controller) {
            $this->_controller = DEFAULT_CONTROLLER;
        }
        if (!$this->_method) {
            $this->_method = "index";
        }
        if (!$this->_args) {
            $this->_args = [];
        }
    }
    /**
     * Método para parsear la url y dividirlo en un array
     * @return array
     */
    private function parseUrl(): array
    {
        if (isset($_GET['url'])) {
            $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
            return $url = explode("/", $url);
        }
        return [];
    }
    /**
     * Método get de controladores
     * @return string
     */
    public function getController(): string
    {
        return $this->_controller;
    }
    /**
     * Método get de Métodos
     * @return string
     */
    public function getMethod(): string
    {
        return $this->_method;
    }
    /**
     * Método get de argumentos
     * @return array
     */
    public function getArgs(): array
    {
        return $this->_args;
    }
}
