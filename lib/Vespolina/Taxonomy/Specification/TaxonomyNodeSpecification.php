<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Taxonomy\Specification;

use Vespolina\Entity\Taxonomy\TaxonomyNodeInterface;
use Vespolina\Specification\SpecificationInterface;

class TaxonomyNodeSpecification implements SpecificationInterface
{
    protected $depth;
    protected $taxonomyName;

    public function __construct($taxonomyNodeName = '')
    {
        $this->taxonomyNodeName = $taxonomyNodeName;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getTaxonomyNodeName()
    {
        return $this->taxonomyNodeName;
    }

    public function isSatisfiedBy($taxonomyNode)
    {

    }
}