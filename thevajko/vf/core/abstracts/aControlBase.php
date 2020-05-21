<?php

namespace thevajko\vf\core\abstracts;

use thevajko\vf\core\Container;
use thevajko\vf\core\interfaces\IRender;

/**
 * Abstract class for basic/common functionality addition
 *
 * Abstract class which provide field to class for vajko\core\Template and data transportation.
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
 *
 */
abstract class aControlBase
{
    /**
     * @var Container Application container object
     */
    protected $container;

    /**
     * @var IRender
     */
    protected $render;

    /**
     * @var mixed variable filled with data uset to render template
     */
    protected $templateData;

    /**
     * This is a default action for controller
     *
     * @return NULL
     */
    abstract public function defaultAction();

    /**
     * Method for creating connection and shortcuts for Template
     *
     * @param IRender $render
     */
    public function setRender(IRender $render)
    {
        $this->render = $render;
        $this->templateData = $render->getData();
    }

    /***
     *  Can be overwritten and is ran before action method.
     */
    public function beforeAction(){

    }

    /**
     * Sets application container for access to application main components
     * @param Container $container
     */
    public function setContainer(Container $container){
        $this->container = $container;
    }
}