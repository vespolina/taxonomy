<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\TaxonomyBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Vespolina\TaxonomyBundle\Model\TermInterface;

/**
 * @author Daniel Kucharski <daniel@xerias.be>
 */
 abstract class Term implements TermInterface
{
    protected $name;
    protected $path;
    protected $properties;
    protected $terms;

    public function __construct($name)
    {

        $this->name = $name;
        $this->terms = new ArrayCollection();
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
     public function getName()
     {
        return $this->name;
     }

     /**
      * @inheritdoc
      */
     public function getPath()
     {
         return $this->path;
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
     public function getTerms()
     {
         return $this->terms;
     }

    /**
     * @inheritdoc
     */
    public function setName($name)
    {

        $this->name = $name;
    }

     /**
      * @inheritdoc
      */
     public function setPath($path)
     {

         $this->path = $path;
     }


}