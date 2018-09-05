<?php

namespace Enum;

use ReflectionClass;

/**
 * @author Gabriel Polverini <polverini.gabriel@gmail.com>
 */
abstract class AbstractEnum
{
    private static $constCache = null;

    /**
     * Obtiene una lista con las constantes definidas.
     *
     * @throws \ReflectionException
     *
     * @return mixed
     */
    protected static function getConstants()
    {
        if (self::$constCache == null) {
            self::$constCache = [];
        }
        $calledClass = get_called_class();
        if (!array_key_exists($calledClass, self::$constCache)) {
            $reflect = new ReflectionClass($calledClass);
            self::$constCache[$calledClass] = $reflect->getConstants();
        }
        return self::$constCache[$calledClass];
    }

    /**
     * Comprueba si el nombre dado corresponde a un elemento enumerado.
     *
     * @param string $name
     * @param bool $strict
     *
     * @throws \ReflectionException
     *
     * @return bool
     */
    public static function isValidName($name, $strict = false)
    {
        $constants = self::getConstants();
        if ($strict) {
            return array_key_exists($name, $constants);
        }
        $keys = array_map('strtolower', array_keys($constants));

        return in_array(strtolower($name), $keys);
    }

    /**
     * Comprueba si el valor dado corresponde a un elemento enumerado.
     *
     * @param string $value
     *
     * @throws \ReflectionException
     *
     * @return bool
     */
    public static function isValidValue($value)
    {
        $values = array_values(self::getConstants());

        return in_array($value, $values, true);
    }

    /**
     * Obtiene un valor en base a un nombre dado.
     *
     * @param string $name
     *
     * @throws \ReflectionException
     *
     * @return mixed
     */
    public static function getByName($name)
    {
        $name = strtoupper($name);
        $values = self::getConstants();

        return in_array($name, array_keys($values)) ? $values[$name] : null;
    }

    /**
     * Obtiene el nombre en base a un valor dado.
     *
     * @param string $value
     *
     * @throws \ReflectionException
     *
     * @return string
     */
    public static function getName($value)
    {
        $values = self::getConstants();
        $index = array_search($value, array_values($values));

        return $index !== false ? array_keys($values)[$index] : null;
    }
}
