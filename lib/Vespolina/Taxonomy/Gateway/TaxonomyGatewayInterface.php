<?php

namespace Vespolina\Taxonomy\Gateway;

use Molino\SelectQueryInterface;
use Vespolina\Entity\Taxonomy\TaxonomyNodeInterface;

/**
 * @author Richard Shank <develop@zestic.com>
 */
interface TaxonomyGatewayInterface
{
    /**
     * Delete a TaxonomyNode that has been persisted and optionally flush that link.
     * Systems that allow for a delayed flush can use the $andFlush parameter, other
     * systems would disregard the flag. The success of the process is returned.
     *
     * @param \Vespolina\Entity\Taxonomy\TaxonomyNodeInterface $TaxonomyNode
     *
     * @param boolean $andFlush
     */
    function deleteTaxonomyNode(TaxonomyNodeInterface $TaxonomyNode, $andFlush = false);

    /**
     * Flush any changes to the gateway
     */
    function flush();

    /**
     * Persist a TaxonomyNode that has been created and optionally flush that link.
     * Systems that allow for a delayed flush can use the $andFlush parameter, other
     * systems would disregard the flag. The success of the process is returned.
     *
     * @param Vespolina\Entity\Taxonomy\TaxonomyNodeInterface $taxonomyNode
     *
     * @param boolean $andFlush
     */
    function persistTaxonomyNode(TaxonomyNodeInterface $taxonomyNode, $andFlush = false);

    /**
     * Update a TaxonomyNode that has been persisted and optionally flush that link.
     * Systems that allow for a delayed flush can use the $andFlush parameter, other
     * systems would disregard the flag. The success of the process is returned.
     *
     * @param Vespolina\Entity\Taxonomy\TaxonomyNodeInterface $TaxonomyNode
     *
     * @param boolean $andFlush
     */
    function updateTaxonomyNode(TaxonomyNodeInterface $TaxonomyNode, $andFlush = false);
}
