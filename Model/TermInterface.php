<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\TaxonomyBundle\Model;

/**
 * @author Daniel Kucharski <daniel@xerias.be>
 */
interface TermInterface
{
    /**
     * Add a term property
     *
     * @abstract
     * @param $name
     * @param $value
     */
    function addProperty($name, $value);

    /**
     * Get the taxonomy name
     * eg. product_hierarchy
     *
     * @abstract
     * @return string
     */
    function getName();

    function getPath();

    /**
     * Retrieve all properties
     *
     * @abstract
     *
     */
    function getProperties();

    function setName($name);

    function setPath($path);

}
