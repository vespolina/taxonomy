<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\TaxonomyBundle\Model;

use Vespolina\TaxonomyBundle\Model\Taxonomy;

/**
 * @author Daniel Kucharski <daniel@xerias.be>
 */
 class TagTaxonomy extends Taxonomy
{

    public function __construct()
    {

        $this->setType('tags');
    }


    public function addTerm(TermInterface $term, TermInterface $parent = null)
    {

        $this->terms[$term->getCode()] = $term;
    }

    public function getTerms($level = null)
    {

        return $this->terms;
    }



}