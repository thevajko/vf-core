<?php

namespace thevajko\vf\core;

use thevajko\vf\core\interfaces\IContainerItem;
/**
 * Class presenting simple container object for all needed application object. Inserted object must implement IContainerItem interface
 *
 * Class presenting simple container object for collection all objects needed by application. It provides method for adding them
 * to bag and for getting them out. Each added object must have string identificator. After adding all needed items, it is
 * possible to call initialization method. In this method are called all object in container.
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
class Container
{
    /**
     * @var array Array of all items in container
     */
    private $bag = array();


    /**
     * This method makes initialization of all objects in container.
     */
    public function initializeCall(){
        foreach ( $this->bag as $item){
            // check if item has needed method
            if (method_exists($item, "containerInitialization")){
                //call item initialization
                /** @var IContainerItem $item */
                $item->containerInitialization($this);
            }
        }
    }

    /**
     * Method for adding object into container
     * @param IContainerItem $object
     * @param String $name object identificator
     */
    public function add(IContainerItem $object, $name){
        //pot item in the bag
        $this->bag[$name] = $object;
    }

    /**
     * @param $objectIdentification
     * @return null
     * @throws \Exception
     */
    public function get($objectIdentification){
        //first check if item with set identificator exists
        if (array_key_exists($objectIdentification, $this->bag)){
            //if do, return it
            return $this->bag[$objectIdentification];
        }
        //else throw exception. Somewere is error or typo
        throw new \Exception("Object with identificator '$objectIdentification' was not found in container bag.", 500);
    }
}