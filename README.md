# elgg_scalarmd
Provide a global function for ensuring metadata output is a string, and potentially fixing it if not.

This is useful for situations where you are expecting a string, and only a string, and an accidental
array return would break things.  An example might be a webservices response that requires a string.

This is a workaround for https://github.com/Elgg/Elgg/issues/4268 where frequently updated metadata
can accidentally duplicate into an array.  This function ensures a scalar return for the metadata value
and will reset the entity metadata to a scalar value by default.

# Caveats

This works for metadata that does not depend on access or ownership, as a simple key/value pair (eg. most metadata usage)
If the metadata *does* depend on access or ownership do not use this function on it or you will surely
lose data.

# Usage

Scenario:

    $entity->country = [
        'canada',
        'canada
    ];

$entity->country is now:

    Array
    (
        [0] => canada
        [1] => canada
    )

Without fixing: \Beck24\scalarmd($entity, 'country', false)

    canada

$entity->country is still:

    Array
    (
        [0] => canada
        [1] => canada
    )

Now with fixing: \Beck24\scalarmd($entity, 'country')

    canada

$entity->country is now:

    canada