<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\TaxonomyBundle\Model;

use Vespolina\TaxonomyBundle\Model\TaxonomyInterface;
use Vespolina\TaxonomyBundle\Model\TaxonomyManagerInterface;
/**
 * @author Richard Shank <develop@zestic.com>
 */
interface TaxonomyManagerInterface
{
    /**
     * Create a new Taxonomy instance
     *
     * @return Vespolina\TaxonomyBundle\Model\TaxonomyInterface
     */
    function createTaxonomy($name, $type);


    /**
     * Find a Taxonomy by its object identifier
     *
     * @param $id
     * @return Vespolina\TaxonomyBundle\Model\TaxonomyInterface
     */
    function findTaxonomyById($id);

    /**
     * Update and persist the Taxonomy
     *
     * @param Vespolina\TaxonomyBundle\Model\TaxonomyInterface $Taxonomy
     * @param Boolean $andFlush Whether to flush the changes (default true)
     */
    function updateTaxonomy(TaxonomyInterface $Taxonomy, $andFlush = true);

}
