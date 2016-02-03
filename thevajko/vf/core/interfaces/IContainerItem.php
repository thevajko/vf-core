<?php

namespace thevajko\vf\core\interfaces;

use thevajko\vf\core\Container;

/**
 * Interface used for container object initialization and set of container reference.
 *
 * <br/>
 * <sup>
 *  This class/script is a part of Vajko framework - very simple and minimal MVC application framework for educational purposes.
 * </sup>
 *
 * @author Matej Meško <meshosk@gmail.com>
 * @license http://creativecommons.org/licenses/by-nc-sa/4.0/GNU CC BY-NC-SA 4.0
 * @package vajko\core\interfaces
 */
interface IContainerItem
{
    /**
     * This method is called when all object are loaded into container for initialization
     *
     * @param Container $container
     * @return null
     */
    public function containerInitialization(Container $container);
}