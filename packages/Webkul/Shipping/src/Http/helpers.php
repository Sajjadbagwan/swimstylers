<?php
    use Swim\Shipping\Shipping;
    
    if (! function_exists('shipping')) {
        function shipping()
        {
            return new Shipping;
        }
    }
?>