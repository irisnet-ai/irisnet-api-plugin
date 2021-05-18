<?php
/**
 * INRule
 *
 * PHP version 5
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Irisnet API
 *
 * Artificial Intelligence (AI) for image- and video-processing in realtime. This is an interactive documentation meant to give a place were you can quickly look up the endpoints and their schemas, while also giving you the option to try things out yourself.  Listed below you'll see the available endpoints of the API that can be expanded by clicking on it. Each expanded endpoint lists the request parameter (if available) and the request body (if available). The request body can list some example bodies and the schema, explaining each model in detail. Additionally you'll find a 'Try it out' button where you can type in your custom parameters and custom body and execute that against the API. The responses section in the expanded endpoint lists the possible responses with their corresponding status codes. If you've executed an API call it will also show you the response from the server.  Underneath the endpoints you'll find the model schemas. These are the models used for the requests and responses.By clicking on the right arrow you can expand the model and it will show you a description of the model and the model parameters. For nested models you can keep clicking the right arrow to reveal further details on it.
 *
 * The version of the OpenAPI document: v1
 * 
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 4.3.1
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace OpenAPI\Client\Model;

use \ArrayAccess;
use \OpenAPI\Client\ObjectSerializer;

/**
 * INRule Class Doc Comment
 *
 * @category Class
 * @description Describes the rules applied and the count of objects found for the given classification.
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class INRule implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'INRule';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'in_class' => 'string',
        'in_group' => 'string',
        'found' => 'int',
        'min' => 'int',
        'max' => 'int'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPIFormats = [
        'in_class' => null,
        'in_group' => null,
        'found' => 'int32',
        'min' => 'int32',
        'max' => 'int32'
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'in_class' => 'inClass',
        'in_group' => 'inGroup',
        'found' => 'found',
        'min' => 'min',
        'max' => 'max'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'in_class' => 'setInClass',
        'in_group' => 'setInGroup',
        'found' => 'setFound',
        'min' => 'setMin',
        'max' => 'setMax'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'in_class' => 'getInClass',
        'in_group' => 'getInGroup',
        'found' => 'getFound',
        'min' => 'getMin',
        'max' => 'getMax'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }

    

    

    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['in_class'] = isset($data['in_class']) ? $data['in_class'] : null;
        $this->container['in_group'] = isset($data['in_group']) ? $data['in_group'] : null;
        $this->container['found'] = isset($data['found']) ? $data['found'] : null;
        $this->container['min'] = isset($data['min']) ? $data['min'] : null;
        $this->container['max'] = isset($data['max']) ? $data['max'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets in_class
     *
     * @return string|null
     */
    public function getInClass()
    {
        return $this->container['in_class'];
    }

    /**
     * Sets in_class
     *
     * @param string|null $in_class The classification of the recognized object.
     *
     * @return $this
     */
    public function setInClass($in_class)
    {
        $this->container['in_class'] = $in_class;

        return $this;
    }

    /**
     * Gets in_group
     *
     * @return string|null
     */
    public function getInGroup()
    {
        return $this->container['in_group'];
    }

    /**
     * Sets in_group
     *
     * @param string|null $in_group The group of the classification.
     *
     * @return $this
     */
    public function setInGroup($in_group)
    {
        $this->container['in_group'] = $in_group;

        return $this;
    }

    /**
     * Gets found
     *
     * @return int|null
     */
    public function getFound()
    {
        return $this->container['found'];
    }

    /**
     * Sets found
     *
     * @param int|null $found The count of how many instances of the classification object were found.
     *
     * @return $this
     */
    public function setFound($found)
    {
        $this->container['found'] = $found;

        return $this;
    }

    /**
     * Gets min
     *
     * @return int|null
     */
    public function getMin()
    {
        return $this->container['min'];
    }

    /**
     * Sets min
     *
     * @param int|null $min The minimum allowed instances of the classification object.
     *
     * @return $this
     */
    public function setMin($min)
    {
        $this->container['min'] = $min;

        return $this;
    }

    /**
     * Gets max
     *
     * @return int|null
     */
    public function getMax()
    {
        return $this->container['max'];
    }

    /**
     * Sets max
     *
     * @param int|null $max The maximum allowed instances of the classification object.
     *
     * @return $this
     */
    public function setMax($max)
    {
        $this->container['max'] = $max;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     *
     * @param integer $offset Offset
     * @param mixed   $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


