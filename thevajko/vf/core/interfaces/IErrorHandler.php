<?php

namespace thevajko\vf\core\interfaces;

/**
 * Interface for building own error handler
 *
 * <br/>
 * <sup>
 *  This class/script is a part of Vajko framework - very simple and minimal MVC application framework for educational purposes.
 * </sup>
 *
 * @author Matej Meško <meshosk@gmail.com>
 * @license http://creativecommons.org/licenses/by-nc-sa/4.0/GNU CC BY-NC-SA 4.0
 *
 * @package vajko\core\interfaces
 *
 */
interface IErrorHandler {

    /**
     * @param bool $debugMode Set if is full debug information allowed to display
     * @return null
     */
    public function setDebugMode($debugMode);

    /**
     * Set render for template rendering. This template is new instance
     *
     * @param IRender $render
     * @return null
     */
    public function setRender(IRender $render);

    /**
     * This methos is used to consume exceptions
     * @param \Exception $exception
     * @return null
     */
    public function handleException(\Exception $exception);
}