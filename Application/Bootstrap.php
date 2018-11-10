<?php

namespace Application;


use Exception;

class Bootstrap
{
    /**
     * Constante con el namespace de los controladores
     */
    const NAMESPACE_CONTROLLERS = "\Controllers\\";
    /**
     * Directorio con los controladores
     */
    const DIRECTORY_CONTROLLERS = ROOT . "Controllers" . DS ;
    /**
     * Método que ejecuta la aplicación y recibe una Request
     * @param Request $request
     * @throws \Exception
     */
    public static function run(Request $request)
    {
        $pathController = self::DIRECTORY_CONTROLLERS . ucfirst($request->getController()) . ".php";
        $method = $request->getMethod();
        $args = $request->getArgs();
        if (is_readable($pathController)) {
            $fullClass = self::NAMESPACE_CONTROLLERS . ucfirst($request->getController());
            $controller = new $fullClass;
            if (is_callable(array($controller, $method))) {
                $method = $request->getMethod();
            } else {
                $method = "index";
            }
            if (isset($args)) {
                call_user_func_array(array($controller, $method), $request->getArgs());
            } else {
                call_user_func(array($controller, $method));
            }
        } else {
            throw new \Exception("Página no encontrada");
        }
    }
}