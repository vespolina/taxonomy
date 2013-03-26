<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\Entity\Taxonomy;

use Vespolina\Entity\Taxonomy\TermInterface;


/**
 * @author Daniel Kucharski <daniel@xerias.be>
 */
interface TaxonomyInterface
{
    function getId();

    function setName($name);

    function getName();

    function setParent(TaxonomyInterface $parent = null);

    function getParent();

    function getLevel();

    function getPath();

    function getLockTime();
}
