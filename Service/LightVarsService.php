<?php


namespace Ling\Light_Vars\Service;


use Ling\Bat\BDotTool;
use Ling\Light_Vars\Exception\LightVarsException;

/**
 * The LightVarsService class.
 */
class LightVarsService
{

    /**
     * This property holds the vars for this instance.
     * @var array
     */
    private $vars;


    /**
     * Builds the LightVarsService instance.
     */
    public function __construct()
    {
        $this->vars = [];
    }


    /**
     * Sets a value in the container.
     *
     * dotKey: @page(the bdot path) where the value should be stored.
     *
     *
     * @param string $dotKey
     * @param mixed $value
     */
    public function setVar(string $dotKey, mixed $value)
    {
        BDotTool::setDotValue($dotKey, $value, $this->vars);
    }


    /**
     * Returns the variable value associated to the given key.
     *
     * If the value is not found, either:
     * - the default value is returned if throwEx is false
     * - an exception is thrown if throwEx is true
     *
     *
     *
     *
     * @param string $dotKey
     * @param null $default
     * @param bool $throwEx
     * @return mixed
     * @throws \Exception
     */
    public function getVar(string $dotKey, $default = null, bool $throwEx = false): mixed
    {
        $isFound = false;
        $res = BDotTool::getDotValue($dotKey, $this->vars, $default, $isFound);
        if (false === $isFound && true === $throwEx) {
            throw new LightVarsException("LightVarsService: variable not found with key: $dotKey.");
        }
        return $res;

    }

}