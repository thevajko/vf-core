<?php

namespace thevajko\vf\core\interfaces;

/**
 * Interface needed to be implemented in custom router object.
 *
 * <br/>
 * <sup>
 *  This class/script is a part of Vajko framework - very simple and minimal MVC application framework for educational purposes.
 * </sup>
 *
 * @author Matej Meško <meshosk@gmail.com>
 * @license http://creativecommons.org/licenses/by-nc-sa/4.0/GNU CC BY-NC-SA 4.0
 *
 * @package thevajko\vf\core\interfaces
 *
 */
interface IRouter
{
    /**
     * Method returns base url of application
     * @return string
     */
    public function getBaseUrl();

    /**
     * Returns name of controller that will be run based on URL
     * @return string
     */
    public function getControllerName();

    /**
     * Return name of method that will be run on controller
     * @return string
     */
    public function getControllerAction();

    /**
     * Retunrs array of all parameters from URL
     * @return array
     */
    public function getParams();

}