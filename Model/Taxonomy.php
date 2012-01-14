<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\TaxonomyBundle\Model;

use Vespolina\TaxonomyBundle\Model\TaxonomyInterface;

/**
 * @author Daniel Kucharski <daniel@xerias.be>
 */
 abstract class Taxonomy implements TaxonomyInterface
{
    protected $numberOfTerms;
    protected $name;
    protected $terms;
    protected $type;


    public function __construct()
    {

    }

    public function addTerm(TermInterface $term, TermInterface $parentTerm = null)
    {
        if (!$path = $term->getPath())
        {
            $path = $this->slugify($term->getName());
            $term->setPath($path);
        }


        if ($parentTerm) {

        }
        else{

            $this->terms[$path] = $term;
        }
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
    public function getNumberOfTerms()
    {
        return $this->numberOfTerms;
    }

     /**
       * @inheritdoc
       */
    public function getTerms($level = null)
    {
        return $this->terms;
    }


    /**
      * @inheritdoc
      */
    public function getType()
    {
        return $this->type;
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
    public function setNumberOfTerms($numberOfTerms)
    {

        $this->numberOfTerms;
    }

     /**
      * @inheritdoc
      */
    public function setType($type)
    {

        $this->type = $type;
    }

     protected function slugify($text)
     {
         return preg_replace('/[^a-z0-9_\s-]/', '', preg_replace("/[\s_]/", "-", preg_replace('!\s+!', ' ', strtolower(trim($text)))));
     }

}