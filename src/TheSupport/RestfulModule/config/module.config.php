<?php
return array(
    'errors' => array(
        'post_processor' => 'json-pp',
        'show_exceptions' => array(
            'message' => true,
            'trace' => true
        )
    ),
    'di' => array(
        'instance' => array(
            'alias' => array(
                'json-pp' => 'TheSupport\RestfulModule\PostProcessor\Json',
                'jsonp-pp' => 'TheSupport\RestfulModule\PostProcessor\JsonP'
            ),
        ),
    ),
);