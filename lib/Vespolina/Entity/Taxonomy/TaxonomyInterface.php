<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\Entity\Taxonomy;

use Vespolina\EntityTaxonomy\TermInterface;


/**
 * @author Daniel Kucharski <daniel@xerias.be>
 */
interface TaxonomyInterface
{

    /**
     * Add a term to this taxonomy
     *
     * @abstract
     * @param TermInterface $term
     */
    function addTerm(TermInterface $term, TermInterface $parent = null);

    /**
     * Get the taxonomy name
     * eg. Taxonomy_hierarchy
     *
     * @abstract
     * @return string
     */
    function getName();

    /**
     * Number of terms this taxonomy holds
     *
     * @abstract
     *
     */
    function getNumberOfTerms();

    function getTerms($level = null);

    /**
     * Retrieve the taxonomy type
     *
     * Possible options are:
     *  - hierarchical
     *  - tags
     *
     * @abstract
     *
     */
    function getType();

    function setName($name);

    function setType($type);
}
