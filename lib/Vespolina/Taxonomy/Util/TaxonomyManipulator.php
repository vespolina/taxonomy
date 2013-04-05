<?php
/**
 * (c) 2012-2013 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Taxonomy\Util;

use Vespolina\Entity\Taxonomy\TaxonomyNodeInterface;
use Vespolina\Taxonomy\Gateway\TaxonomyGatewayInterface;
use Vespolina\Taxonomy\Manager\TaxonomyManagerInterface;
use Vespolina\Exception\InvalidConfigurationException;

/**
 * TaxonomyManipulator - utility methods for dealing with taxonomies
 *
 * @author Daniel Kucharski <daniel@xerias.be>
 */
class TaxonomyManipulator
{

    protected $taxonomyManager;

    /**
     * Constructor to setup the taxonomy manipulator
     *
     * @param \Vespolina\Taxonomy\Manager\TaxonomyManagerInterface $taxonomyManager
     */
    public function __construct(TaxonomyManagerInterface $taxonomyManager)
    {
        $this->taxonomyManager = $taxonomyManager;
    }

    /**
     * Create a (nested) taxonomy from a nested array
     */
    public function createTaxonomyNodesFromArray(array $data, TaxonomyNodeInterface $parent = null)
    {
        $nodes = array();
        foreach($data as $key => $value) {

            $itemNode = $this->taxonomyManager->createTaxonomyNode($key, $parent);

            //Walk through children if existent
            if (null != $value && is_array($value)) {

                $this->createTaxonomyNodesFromArray($value, $itemNode);
            }
            $nodes[] = $itemNode;
        }

        return $nodes;
    }

}
