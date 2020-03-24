<?php

return [
    'admin' => [
    	[
        'key' => 'master',
        'name' => 'admin::app.acl.master',
        'route' => 'admin.master.branch.index',
        'sort' => 2
    ], [
        'key' => 'master.branch',
        'name' => 'admin::app.acl.branch',
        'route' => 'admin.master.branch.index',
        'sort' => 1
    ],
    ],
    
    'customer' => [

    ]
];

?>