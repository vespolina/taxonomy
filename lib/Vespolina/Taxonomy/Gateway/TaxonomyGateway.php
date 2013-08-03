<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
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
