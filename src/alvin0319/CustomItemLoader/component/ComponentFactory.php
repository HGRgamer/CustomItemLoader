<?php

declare(strict_types=1);

namespace alvin0319\CustomItemLoader\component;

use pocketmine\utils\SingletonTrait;

final class ComponentFactory{
	use SingletonTrait;

	public static function getInstance() : ComponentFactory{
		return self::$instance;
	}

	/** @var Component[] */
	protected array $components = [];

	public function registerComponent(Component $component) : void{
		$this->components[$component->getName()] = $component;
	}

	public function getComponent(string $name) : ?Component{
		return $this->components[$name] ?? null;
	}
}