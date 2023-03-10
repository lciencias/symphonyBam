<?php
/**
 * PCS Mexico
 *
 * Symphony Help Desk
 *
 * @copyright Copyright (c) PCS Mexico (http://pcsmexico.com)
 * @author    guadalupe, chente, $LastChangedBy$
 * @version   2
 */

namespace Application\Storage;

/**
 *
 * Storage
 *
 * @category Application\Storage
 * @author guadalupe, chente
 */
interface Storage
{

    /**
     * Save
     * @param string $key
     * @param mixed $object
     */
    public function save($key, $object);

    /**
     * Load
     * @param string $key
     * @return mixed
     */
    public function load($key);

    /**
     * Exists
     * @param string
     * @return boolean
     */
    public function exists($key);

    /**
     * Delete cache
     */
    public function removeAll();

    /**
     *
     */
    public function remove($key);

}