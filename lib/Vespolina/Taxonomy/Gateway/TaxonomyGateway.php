<?php

namespace Vespolina\Taxonomy\Gateway;

use Molino\MolinoInterface;
use Molino\SelectQueryInterface;
use Vespolina\Entity\Taxonomy\TaxonomyNodeInterface;
use Vespolina\Exception\InvalidInterfaceException;

abstract class TaxonomyGateway implements TaxonomyGatewayInterface
{
    protected $taxonomyNodeClass;


    public function __construct($taxonomyNodeClass)
    {
        if (!class_exists($taxonomyNodeClass) || !in_array('Vespolina\Entity\Taxonomy\TaxonomyNodeInterface', class_implements($taxonomyNodeClass))) {
            throw new InvalidInterfaceException('Please have your taxonomy node class implement Vespolina\Entity\Taxonomy\TaxonomyNodeInterface');
        }
        $this->taxonomyNodeClass = $taxonomyNodeClass;
    }

}
