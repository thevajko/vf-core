<?php

namespace thevajko\vf\core;

use thevajko\vf\core\interfaces\IContainerItem;

/**
 * Class for loading configuration file and access to this settings
 *
 * Class loads JSON formatted file and parse it to object. In JSON file are allowed comments starting with "//".
 *
 * <br/>
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
class Configurator implements IContainerItem
{

    /**
     * @var mixed|null Holds de-serialized json object with settings
     */
    public $data = null;

    /**
     * Configurator constructor.
     * @param string $jsonFilePath Path to file with configuration. Currently acceptable data format is JSON
     * @throws \Exception
     */
    public function __construct($jsonFilePath)
    {
        //check if file exists
        if (!file_exists($jsonFilePath)){
            throw new \Exception("Configuration file '$jsonFilePath' not found.",500);
        }
        //load text file
        $jsonData = file_get_contents($jsonFilePath);
        //remove coments
        $jsonData = preg_replace('/\/\/(.*)/',"",$jsonData);
        //deserialize data into object
        $this->data = json_decode($jsonData);
    }


    /**
     * @param string $configurationString Load data from config.json. Attributes must be spared by "." char
     * @return mixed|null
     * @throws \Exception
     */
    public function get($configurationString){

        //parse string into atributes
        $attributes = explode(".", $configurationString);

        //get data object
        $currentLevel = $this->data;

        foreach ($attributes as $attribute) {
            //iterate between attributes
            //first check if attribute exists
            if (isset($currentLevel->$attribute)){
                //if exists get attribute value
                $currentLevel = $currentLevel->$attribute;
            } else {
                //if not exists raise exception
                throw new \Exception("Configurator error: configuration '$configurationString' not found.",500);
            }
        }
        //return value
        return $currentLevel;
    }

    /**
     * This method is called when all object are loaded into container for initialization
     *
     * @param Container $container
     * @return null
     */
    public function containerInitialization(Container $container)
    {
        //do nothing.
    }
}