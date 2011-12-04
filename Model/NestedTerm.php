<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\TaxonomyBundle\Model;

use Vespolina\TaxonomyBundle\Model\Term;

/**
 * @author Daniel Kucharski <daniel@xerias.be>
 */
 abstract class NestedTerm extends Term
{
    protected $path;
     protected $terms;


    public function __construct($code = null, $name = null)
    {

        $this->code = $code;
        $this->name = $name;

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
    public function getPath()
    {

        return $this->name;
    }

     /**
      * @inheritdoc
      */
     public function setTerms($terms)
     {

         $this->terms = $terms;
     }


     /**
      * @inheritdoc
      */
     public function setPath($path)
     {

         $this->path = $path;
     }
}