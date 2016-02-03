<?php

namespace thevajko\core\errorHandler;

use thevajko\vf\core\interfaces\IErrorHandler;
use thevajko\vf\core\interfaces\IRender;

/**
 * Frameworks default class for error handling. It contains very basic error output.
 *
 * <br/>
 * <sup>
 *  This class/script is a part of Vajko framework - very simple and minimal MVC application framework for educational purposes.
 * </sup>
 *
 * @author Matej Meško <meshosk@gmail.com>
 * @license http://creativecommons.org/licenses/by-nc-sa/4.0/GNU CC BY-NC-SA 4.0
 *
 * @package vajko\core\errorHandler
 *
 */
class DefaultErrorHandlerControl implements IErrorHandler
{
    var $debugMode = false;

    private $render;

    public function setDebugMode($debugMode)
    {
        $this->debugMode = $debugMode;
    }

    public function handleException(\Exception $exception)
    {
        // check debug mode
        if ($this->debugMode) {
            // if is debug enabled, show exception message
            $message = $exception->getMessage()."<br/>".$exception->getTraceAsString();
            echo "<pre>".$message."</pre>";
        } else {
            // else show 404
           $code = $exception->getCode();
            header($_SERVER['SERVER_PROTOCOL'] . ' $code Internal Server Error', true, $code);
            echo "<h1>Error 404 Not Found</h1>";
            echo "The page that you have requested could not be found.";
        }

    }

    public function setRender(IRender $render)
    {
        $this->render = $render;
    }
}