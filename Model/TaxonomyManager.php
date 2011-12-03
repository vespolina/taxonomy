<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\TaxonomyBundle\Model;

use Symfony\Component\DependencyInjection\Container;

use Vespolina\TaxonomyBundle\Model\TaxonomyInterface;
use Vespolina\TaxonomyBundle\Model\TermInterface;
use Vespolina\TaxonomyBundle\Model\TaxonomyManagerInterface;

/**
 * @author Daniel Kucharski <daniel@xerias.be>
 */
abstract class TaxonomyManager implements TaxonomyManagerInterface
{
    protected $container;

    public function __construct(Container $container) {

        $this->container = $container;
    }


    public function createTerm(TaxonomyInterface $taxonomy)
    {


        switch($taxonomy->getType) {
            case 'hierarchy':
                break;
            case 'tags':


                break;
        }
    }

}
