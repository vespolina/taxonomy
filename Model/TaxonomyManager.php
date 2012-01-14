<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\TaxonomyBundle\Model;

use Symfony\Component\DependencyInjection\Container;

use Vespolina\TaxonomyBundle\Model\TaxonomyInterface;
use Vespolina\TaxonomyBundle\Model\TermInterface;
use Vespolina\TaxonomyBundle\Model\TaxonomyManagerInterface;

/**
 * @author Daniel Kucharski <daniel@xerias.be>
 */
abstract class TaxonomyManager implements TaxonomyManagerInterface
{
    protected $taxonomyClass;
    protected $termClass;

    public function __construct($taxonomyClass, $termClass) {

        $this->taxonomyClass = $taxonomyClass;
        $this->termClass = $termClass;
    }


    public function addTerm(TermInterface $term, TermInterface $parent = null)
    {

        if ($parent) {


            //TODO

        } else {

            $this->terms[$term->getPath()] = $term;
        }
    }

    /**
     * @inheritdoc
     */
    public function createTaxonomy($name, $type)
    {

        if ($taxonomyClass = $this->taxonomyClass) {

            $taxonomy = new $taxonomyClass();

            $taxonomy->setName($name);
            $taxonomy->setType($type);

            return $taxonomy;
        }
   }

    public function createTerm($name)
    {
        if ($termClass = $this->termClass) {

            $term = new $termClass($name);

            return $term;
        }
    }

}
