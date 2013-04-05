<?php

namespace Vespolina\Taxonomy\Manager;

use Vespolina\Entity\Taxonomy\TaxonomyNodeInterface;

interface TaxonomyManagerInterface 
{
    /**
     * @return TaxonomyNodeInterface
     */
    function createTaxonomyNode($name, TaxonomyNodeInterface $parent = null);

    /**
     * @param TaxonomyNodeInterface $taxonomyNode
     * @param bool $andFlush
     */
    function deleteTaxonomyNode(TaxonomyNodeInterface $taxonomyNode, $andFlush = true);

    /**
     * @param $id
     * @return TaxonomyNodeInterface
     */
    function find($id);

    /**
     * @param $id
     * @return TaxonomyNodeInterface
     */
    function findOneByTaxonomyNodeId($id);

    /**
     * @param $parentId
     * @return array
     */
    function findAllWithParentId($parentId);

    /**
     * @return array
     */
    function findAll();

    /**
     * @param TaxonomyNodeInterface $taxonomyNode
     * @param bool $andFlush Whether to flush the changes (default true)
     */
    function updateTaxonomyNode(TaxonomyNodeInterface $taxonomyNode, $andFlush = true);
}
