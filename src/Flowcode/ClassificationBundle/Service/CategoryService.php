<?php

namespace Flowcode\ClassificationBundle\Service;

/**
 * CategoryService
 */  
class CategoryService{

	private $container;

	public function __construct($container)
	{
		$this->container = $container;
	}

	public function findByRoot($root = null)
	{
		$repo = $this->container->get('doctrine.orm.entity_manager')
				->getRepository('AmulenClassificationBundle:Category');

		$root = $repo->findBy(array("name" => $root));
		return $repo->findBy(array("root" => $root));
	}
}