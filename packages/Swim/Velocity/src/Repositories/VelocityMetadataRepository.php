<?php

namespace Swim\Velocity\Repositories;

use Swim\Core\Eloquent\Repository;

class VelocityMetadataRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Swim\Velocity\Models\VelocityMetadata';
    }
}