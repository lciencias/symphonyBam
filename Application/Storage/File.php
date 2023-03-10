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

use Zend_Cache;

/**
 *
 * File
 *
 * @category Application\Storage
 * @author guadalupe, chente
 */
class File implements Storage
{

    /**
     *
     * @var \Zend_Cache_Core
     */
    private $zendCache = null;

    /**
     * @var array
     */
    private $defaultFrontendOptions = array(
        'lifetime' => 86400,
        'automatic_serialization' => true,
    );

    /**
     * @var array
     */
    private $defaultBackendOptions = array(
        'cache_dir' => 'cache/storage',
    );

    /**
     * @param array $frontendOptions
     * @param array $backendOptions
     */
    public function __construct($frontendOptions = array(), $backendOptions = array())
    {
        $frontendOptions = array_merge($this->defaultFrontendOptions, $frontendOptions);
        $backendOptions = array_merge($this->defaultBackendOptions, $backendOptions);
        if( !is_dir($backendOptions['cache_dir']) ){
            @mkdir($backendOptions['cache_dir'], 0777, true);
        }
        $this->zendCache = Zend_Cache::factory('Core', 'File', $frontendOptions, $backendOptions);
    }

    /**
     * Save
     * @param string $key
     * @param mixed $object
     */
    public function save($key, $object){
        $this->zendCache->save($object, sha1($key));
    }

    /**
     * Load
     * @param string $key
     * @return mixed
     */
    public function load($key){
        return $this->zendCache->load(sha1($key));
    }

    /**
     * Exists
     * @param string
     * @return boolean
     */
    public function exists($key){
        return $this->zendCache->load(sha1($key)) !== false;
    }

    /**
     * Delete cache
     */
    public function removeAll(){
        $this->zendCache->clean(\Zend_Cache::CLEANING_MODE_ALL);
    }

    /**
     *
     */
    public function remove($key){
        $this->zendCache->remove(sha1($key));
    }

}