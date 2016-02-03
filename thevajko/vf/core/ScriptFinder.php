<?php

namespace thevajko\vf\core;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RecursiveRegexIterator;
use RegexIterator;
use vajko\core\interfaces\IContainerItem;

/**
 * Simple class for regex search in scripts in directory. Directory is searched recursively.
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
class ScriptFinder implements IContainerItem
{

    /**
     * @var array List of all php scripts in scripts dir
     */
    private $scriptArray = array();

    public function __construct($dirToMap)
    {
        $this->mapScripts($dirToMap);
    }

    /**
     * Find scripts in /scripts/** folder based on regular expression
     *
     * @param String $regularExpression regular expression string
     * @return array array of string, where each represent path to file
     */
    public function findScript($regularExpression){
        //run regular expression search on array
        $foundScripts = preg_grep($regularExpression, $this->scriptArray);
        //pass result
        return $foundScripts;
    }


    /**
     * Search in direcotry recursively for php files
     *
     * @param strin $scriptDir full directory path
     */
    private function mapScripts($scriptDir){
        $directory = new RecursiveDirectoryIterator($scriptDir);
        $iterator = new RecursiveIteratorIterator($directory);
        $regex = new RegexIterator($iterator, '/^.+\.php$/i', RecursiveRegexIterator::GET_MATCH);

        foreach ($regex as $scriptPath){
            $this->scriptArray[] = $scriptPath[0];
        }
    }

    /**
     * This method is called when all object are loaded into container for initialization
     *
     * @param Container $container
     * @return null
     */
    public function containerInitialization(Container $container)
    {
        // do nohing
    }
}