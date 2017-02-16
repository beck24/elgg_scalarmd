# elgg_stringify
Provide a global function for ensuring metadata output is a string, and potentially fixing it if not.

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

Without fixing: \Beck24\scalarmd($user, $name, false)

    canada

User md is still:

    Array
    (
        [0] => canada
        [1] => canada
    )

Now with fixing: \Beck24\scalarmd($user, $name)

    canada

User md is now:

    canada