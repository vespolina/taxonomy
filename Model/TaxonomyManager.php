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
    protected $tagTaxonomyClass;
    protected $nestedTaxonomyClass;

    public function __construct($nestedTaxonomyClass, $tagTaxonomyClass) {

        $this->nestedTaxonomyClass = $nestedTaxonomyClass;
        $this->tagTaxonomyClass = $tagTaxonomyClass;
    }

    /**
     * @inheritdoc
     */
    public function createTaxonomy($name, $type)
    {
        //TODO: Factory
        $taxonomyClass = null;

        switch ($type) {

            case 'nested':

                $taxonomyClass = $this->nestedTaxonomyClass;
                break;

            case 'tags':

                $taxonomyClass = $this->tagTaxonomyClass;
                break;
        }

        if ($taxonomyClass) {

            $taxonomy = new $taxonomyClass();
            $taxonomy->setName($name);
            $taxonomy->setType($type);

            return $taxonomy;
        }

    }

    public function createTerm(TaxonomyInterface $taxonomy)
    {
        switch($taxonomy->getType) {
            case 'nested':
                break;
            case 'tags':


                break;
        }
    }

}
