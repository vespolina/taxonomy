<?php

namespace Vespolina\Taxonomy\Manager;

use Vespolina\Entity\Taxonomy\TaxonomyInterface;

interface TaxonomyManagerInterface 
{
    /**
     * @return TaxonomyInterface
     */
    function createTaxonomy();

    /**
     * @param TaxonomyInterface $taxonomy
     * @param bool $andFlush
     */
    function deleteTaxonomy(TaxonomyInterface $taxonomy, $andFlush = true);

    /**
     * @param $id
     * @return TaxonomyInterface
     */
    function find($id);

    /**
     * @param $id
     * @return TaxonomyInterface
     */
    function findOneByTaxonomyId($id);

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
     * @param TaxonomyInterface $taxonomy
     * @param bool $andFlush Whether to flush the changes (default true)
     */
    function updateTaxonomy(TaxonomyInterface $taxonomy, $andFlush = true);
}
