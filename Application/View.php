<?php

namespace Application;


class View
{

    /**
     * @var
     */
    protected  $data;
    /**
     * @var
     */
    const VIEWS_PATH = ROOT."Views".DS;
    /**
     * @var
     */
    const EXTENSION_TEMPLATES = "phtml";

    /**
     * Renderiza con los datos
     * @param  string  Nombre de la plantillas
     * @return void   Renderiza la vista
     * @throws \Exception
     */
    public function render($template)
    {
        $request = new Request();
        if(!file_exists(self::VIEWS_PATH .$request->getController().DS. $template . "." . self::EXTENSION_TEMPLATES))
        {
            throw new \Exception("Error: El archivo " . self::VIEWS_PATH . $template . "." . self::EXTENSION_TEMPLATES . " no existe", 1);
        }
        ob_start();
        extract($this->data);
        include(self::VIEWS_PATH . "layouts".DS. "header". ".". self::EXTENSION_TEMPLATES);
        include(self::VIEWS_PATH .$request->getController().DS. $template . "." . self::EXTENSION_TEMPLATES);
        include(self::VIEWS_PATH . "layouts".DS. "footer". ".". self::EXTENSION_TEMPLATES);

        $str = ob_get_contents();
        ob_end_clean();
        echo $str;
    }
    /**
     * Envia un valor con nombre a la vista
     * @param string $name  [key]
     * @param mixed $value [value]
     */
    public function set($name, $value)
    {
        $this->data[$name] = $value;
    }
}