<?php

    use Swim\Velocity\Velocity;

    if (! function_exists('velocity')) {
        function velocity()
        {
            return app()->make(Velocity::class);
        }
    }
?>