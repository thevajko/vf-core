<?php

namespace thevajko\vf\core;

use stdClass;
use thevajko\vf\core\interfaces\IContainerItem;
use thevajko\vf\core\interfaces\IRender;
use thevajko\vf\core\interfaces\IRouter;

/**
 * Class Render for templates rendering - view component of Vajko framework
 *
 * Class Render is used for generating template files - the view layer of Vajko framework.
 * It contains $this->data property which is object for data transportation between model and view, also it defines data structure.
 *
 * <br/>
 * <sup>
 *  This class/script is a part of Vajko framework - very simple and minimal MVC application framework for educational purposes.
 * </sup>
 *
 * @author Matej Meško <meshosk@gmail.com>
 * @license http://creativecommons.org/licenses/by-nc-sa/4.0/GNU CC BY-NC-SA 4.0
 *
 * @package thevajko\vf\core
 *
 */
class Render implements IContainerItem, IRender
{

    /**
     * @var null|stdClass Object carring data for views
     */
    public $data = null;

    /**
     * @var string Contains base URL of web-site
     */
    public $baseUrl = "";

    /**
     * @var String Name of current control - set in method containerInitialization
     */
    private $controlName;

    /**
     * @var String Name of current control - set in method containerInitialization
     */
    public $action;

    /** @var ScriptFinder $scriptFinder */
    public $scriptFinder;

    /**
     * @var string If is not empty, it overrides default template file
     */
    public $templateFile;


    public function __construct()
    {
        //create empty object to avoid php notices and warnings
        $this->data =  new stdClass();
    }


    /**
     * Method for rendering a template file with data
     *
     * Method pass to selected template file a data. Template file is automatically found.
     *
     * @param string $templateFilename
     * @param null $data
     * @param null $others
     * @return string
     * @throws \Exception
     */
    public function renderTemplate($templateFilename, $data = null, $others = null){
        //check if template file exists
        $template = $this->scriptFinder->findScript( "/".$templateFilename."/i"  );

        //if do not existst throw exception
        if (count($template) < 1) throw new \Exception("Presenter '$templateFilename' not found.", 500);

        //run template in separed method
        return $this->runTemplate(reset($template), $data, $others);
    }

    /**
     * Private method for cleaning/creating variables that are accessible in template
     *
     * @param $filename
     * @param null $data
     * @param null $others
     * @return string
     */
    private function runTemplate($filename, $data = null, $others = null){
        $render = $this;

        $control = $this->controlName;
        $action = $this->action;

        if ($others != null && is_array($others))
            extract($others);

        //start catching output
        ob_start();
            //run template
            include $filename;
        //put output into variable
        $output = ob_get_clean();
        return $output; //return variable
    }


    /**
     * This method is called when all object are loaded into container for initialization
     *
     * @param Container $container
     * @return null
     */
    public function containerInitialization(Container $container)
    {
        //load object for template finding
        $this->scriptFinder = $container->get(EnumCoreElements::scriptFinder);

        /** @var IRouter $router */
        $router = $container->get(EnumCoreElements::router);
        //set base url to template
        $this->baseUrl = $router->getBaseUrl();

        $controlNameParts = explode("\\", $router->getControllerName());
        $this->controlName = end($controlNameParts);
        $this->action = $router->getControllerAction();
    }

    /**
     * Returns data object
     * @return null|stdClass
     */
    public function getData()
    {
        return $this->data;
    }
}