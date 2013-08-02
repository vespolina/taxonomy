<?php

namespace Vespolina\Taxonomy\Specification;

use Vespolina\Entity\Taxonomy\TaxonomyNodeInterface;
use Vespolina\Specification\SpecificationInterface;

class TaxonomyNodeSpecification implements SpecificationInterface
{
    protected $depth;
    protected $taxonomyName;

    public function __construct($taxonomyName = '')
    {
        $this->taxonomyName = $taxonomyName;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getTaxonomyName()
    {
        return $this->taxonomyName;
    }

    public function isSatisfiedByEntity($taxonomyNode)
    {

    }
}