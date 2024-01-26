<?php

namespace Core\Domain\Entity\Traits;

use Exception;

trait MethodsMagicsTrait {
  public function __get($property) {
    if (isset($this->{$property})) {
      return $this->{$property};
    }

    $className = get_class($this);
    throw new Exception("The property {$property} not exists in {$className}");
  }
}
