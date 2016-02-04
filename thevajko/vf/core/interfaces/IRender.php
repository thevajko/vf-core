<?php

namespace thevajko\vf\core\interfaces;

/**
 * Interface for creating custom rendering object.
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
interface IRender
{
    /**
     * Method for rendering a template file with data
     *
     * Method pass to selected template file a data. Template file is automatically found.
     *
     * @param string $templateFilename Full path to template or its name
     * @param mixed $data Data to be carried into template file for render
     * @return string Resulting HTML code
     * @throws \Exception In case of problems exception is thrown
     */
    public function renderTemplate($templateFilename, $data = null);

    /**
     * Method that returns variable that carries data from controller to view
     *
     * @return mixed
     */
    public function getData();
}