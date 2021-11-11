<?php

declare(strict_types=1);

namespace alvin0319\CustomItemLoader\component;

use pocketmine\nbt\tag\CompoundTag;
use pocketmine\utils\AssumptionFailedError;

abstract class Component{

	/**
	 * @return string the name of component
	 */
	abstract public function getName() : string;

	/**
	 * @param CompoundTag $nbt
	 * Build and add component to the NBT
	 */
	abstract public function buildComponent(CompoundTag $nbt) : void;

	final public function buildDefault() : CompoundTag{
		$nbt = CompoundTag::create()
			->setTag("components",
				CompoundTag::create()
					->setTag("item_properties", CompoundTag::create()
					)
			);
		$this->buildComponent($nbt);
		return $nbt;
	}

	/**
	 * @param CompoundTag          $nbt
	 * @param string               $expectedName
	 *
	 * @phpstan-param class-string $expectedClass
	 */
	protected function assertNull(CompoundTag $nbt, string $expectedName, string $expectedClass) : void{
		if(($tag = $nbt->getTag($expectedName)) === null || !$tag instanceof $expectedClass){
			throw new AssumptionFailedError("Expected Tag $expectedClass for $expectedName, but " . ($tag === null ? "not found" : "not instance of $expectedClass"));
		}
	}
}