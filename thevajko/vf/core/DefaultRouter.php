<?php

namespace thevajko\vf\core;

use thevajko\vf\core\interfaces\IContainerItem;
use thevajko\vf\core\interfaces\IRouter;

/**
 * Class used to process HTTP request.
 *
 * This is a default application router. It detect base url, and check input params from clean URL. This router supports clean URL
 * with undeclared amount of parameters
 *
 * <br/>
 * <sup>
 *  This class/script is a part of Vajko framework - very simple and minimal MVC application framework for educational purposes.
 * </sup>
 *
 * @author Matej Meško <meshosk@gmail.com>
 * @license http://creativecommons.org/licenses/by-nc-sa/4.0/GNU CC BY-NC-SA 4.0
 *
 * @package vajko\core
 */
class DefaultRouter implements IRouter, IContainerItem
{
    /**
     * @var string name of controller
     */
    private $control;
    /**
     * @var string base url
     */
    private $baseUrl;
    /**
     * @var array with all parameters from url
     */
    private $params;
    /**
     * @var string name of action
     */
    private $action;

    /**
     * This method is called when all object are loaded into container for initialization
     *
     * @param Container $container
     * @return null
     */

    public function containerInitialization(Container $container)
    {
        // Split server 'REQUEST_URI' on "?" char. So on next steps we will work only with parameters from URL not from GET
        $cleanAndHttpParams = explode("?",$_SERVER['REQUEST_URI']);

        // split server 'SCRIPT_NAME' into field
        $scriptPathFragments = explode("/",str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']));
        // Last two field items contains main run file "index.php" and hidden dir "www" in which is request redirected by apache
        array_pop($scriptPathFragments); //remove "index.php"
        array_pop($scriptPathFragments); //remove redirect "www" directory

        // Build up base url with requested SCHEME (it may be HTTP or HTTPS) server name.
        // Rest of path is build from existing directory structure which is common for server and access from web.
        // NOTE: Some mess can be made, if in some upper directory is also redirection through .htaccess
        $this->baseUrl = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME'].implode("/", $scriptPathFragments);

        // Break params from url to array
        $this->params = explode("/",reset($cleanAndHttpParams));

        // Clean params from existing directory structure
        for( $i = 0; $i < count($scriptPathFragments) ; $i++){
            array_shift($this->params);
        }

        // Check strings, so they are safe to use in application
        $this->checkArray($this->params);

        // Now router tries to define which router is called and which action -> method will run
        // As first we need config for default controller and action
        /** @var Configurator $config */
        $config = $container->get(EnumCoreElements::config);

        // get un-filtered name of controller from request. If is present as part of url, name is corrected from URL state to class correct name
        // e.g. url name of controller 'some-my-control' to class type SomeMyControl
        $this->control = (isset($this->params[0]) && !empty($this->params[0]) ? $this->transformNameFromUrl($this->params[0])."Control" : $config->get("www.defaultControlClass"));

        // process action name from URL
        $this->action = $this->transformNameFromUrl((isset($this->params[1]) && !empty($this->params[1]) ?$this->params[1] : "Default"));
    }


    /**
     * Checks all array values
     * @param $array
     */
    public function checkArray($array){
        foreach ($array as &$value){
            $value =$this->checkString($value);
        }
    }

    /**
     * @param string $unsafeString This method makes from inout string a safe, anti-injection string
     *
     * @return string Safe string
     */
    public function checkString($unsafeString){

        //basic striping - remove tags and whitespaces on begining and end
        $safeString =  strip_tags(trim($unsafeString));
        $safeString = escapeshellcmd ( $safeString);
        return $safeString;
    }

    /**
     * Change string with words spared by space or dash to first letter uppercase. the-some-example => TheSomeExample
     *
     * @param $string
     * @return string
     */
    public function transformNameFromUrl($string){
        // Parse string
        $words =  preg_split("/[- ]/", $string);
        $out = "";
        foreach($words as $word) // for each array item
            if (!empty($word)) //check if is string empty
                $out .= ucfirst($word); // if is not empty, make first letter uppercase and add it to output string
        return $out; //return
    }
    /**
     * Returns name of controller that will be run based on URL
     * @return string
     */
    public function getControllerName()
    {
        return $this->control;
    }

    /**
     * Return name of method that will be run on controller
     * @return string
     */
    public function getControllerAction()
    {
        return $this->action;
    }

    /**
     * Retunrs array of all parameters from URL
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Method returns base url of application
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }
}