<?php

namespace Vespolina\Taxonomy\Gateway;

use Molino\MolinoInterface;
use Molino\SelectQueryInterface;
use Vespolina\Entity\Taxonomy\TaxonomyNodeInterface;
use Vespolina\Exception\InvalidInterfaceException;

class TaxonomyMemoryGateway implements TaxonomyGatewayInterface
{
    protected $taxonomyNodeClass;
    protected $nodes;    // Root nodes

    public function __construct( $taxonomyNodeClass)
    {
        if (!class_exists($taxonomyNodeClass) || !in_array('Vespolina\Entity\Taxonomy\TaxonomyNodeInterface', class_implements($taxonomyNodeClass))) {
            throw new InvalidInterfaceException('Please have your taxonomy node class implement Vespolina\Entity\Taxonomy\TaxonomyNodeInterface');
        }
        $this->taxonomyNodeClass = $taxonomyNodeClass;
        $this->nodes = array();
    }

    /**
     * @param \Vespolina\Entity\Taxonomy\TaxonomyNodeInterface $taxonomyNode
     */
    public function deleteTaxonomyNode(TaxonomyNodeInterface $taxonomyNode, $andFlush = false)
    {
    }

    /**
     * @param \Molino\SelectQueryInterface $query
     * @return \Vespolina\Entity\Taxonomy\TaxonomyNodeInterface
     */
    public function findTaxonomyNode(SelectQueryInterface $query = null)
    {
        return $query->one();
    }

    /**
     * @param \Molino\SelectQueryInterface $query
     * @return \Vespolina\Entity\Taxonomy\TaxonomyNodeInterface
     */
    public function findTaxonomyNodes(SelectQueryInterface $query)
    {
        return $this->nodes;
    }

    /**
     * @param \Vespolina\Entity\Taxonomy\TaxonomyNodeInterface $taxonomy
     */
    public function persistTaxonomyNode(TaxonomyNodeInterface $taxonomyNode, $andFlush = false)
    {
    }

    /**
     * @param \Vespolina\Entity\Taxonomy\TaxonomyNodeInterface $taxonomy
     */
    public function updateTaxonomyNode(TaxonomyNodeInterface $taxonomyNode, $andFlush = false)
    {
        $this->nodes[] = $taxonomyNode;
    }

    public function flush()
    {

    }
}
