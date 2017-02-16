<?php

namespace Beck24;

/**
 * 
 * @param \ElggEntity $entity
 * @param string $name
 * @param boolean $fix
 * @return string | null
 */
function scalarmd($entity, $name, $fix = true) {
	if (!elgg_instanceof($entity)) {
		return null;
	}
	
	$value = $entity->$name;
	
	if (is_scalar($value)) {
		return $value;
	}
	
	if (is_array($value)) {
		$value = $value[count($value) - 1];
		if (!$fix) {
			// specifically requested to not fix it, so return the last value
			// which *has* to be scalar unless something is really messed with the elgg API
			return $value;
		}
		
		// we need to fix it
		// ignore access to make sure we can write
		$ia = elgg_set_ignore_access();
		$entity->$name = $value;
		elgg_set_ignore_access($ia);
		
		return $value;
	}
	
	// not scalar or an array?  WTF?
	return null;
}