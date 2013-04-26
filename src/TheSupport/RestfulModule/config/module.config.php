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
                'json-pp' => 'TheSupport\RestfulModule\PostProcessor\Json'
            ),
        ),
    ),
//    'controllers' => array(
//        'invokables' => array(
//            'index' => 'RestfulModule\Controller\IndexController',
//        )
//    ),
//    'router' => array(
//        'routes' => array(
//            'ws' => array(
//                'type' => 'Segment',
//                'options' => array(
//                    'route' => '/ws/:controller[.:format][/:id]',
//                    'constraints' => array(
//                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                        'format' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                        'id' => '[a-zA-Z0-9_-]*'
//                    ),
//                    'defaults' => array(
//                        'format' => 'json'
//                    ),
//                ),
//            ),
//        ),
//    ),
);