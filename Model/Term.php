<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\TaxonomyBundle\Model;

use Vespolina\TaxonomyBundle\Model\TermInterface;

/**
 * @author Daniel Kucharski <daniel@xerias.be>
 */
 abstract class Term implements TermInterface
{
    protected $code;
    protected $name;
    protected $properties;


    public function __construct($code, $name = null)
    {

        $this->code = $code;
        $this->name = $name;
    }

     /**
      * @inheritdoc
      */
    public function addProperty($name, $value)
    {
        if (!$this->properties) {

            $this->properties = array();
        }

        $this->properties[$name] = $value;
    }

     /**
      * @inheritdoc
      */
     public function getCode()
     {

         return $this->code;
     }


    /**
     * @inheritdoc
     */
     public function getName()
     {

        return $this->name;
     }

     /**
      * @inheritdoc
      */
     public function getProperties()
     {

         return $this->properties;
     }

     /**
      * @inheritdoc
      */
     public function setCode($code)
     {

         $this->code = $code;
     }

    /**
     * @inheritdoc
     */
    public function setName($name)
    {

        $this->name = $name;
    }


}