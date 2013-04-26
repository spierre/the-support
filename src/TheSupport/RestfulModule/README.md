# Convenient REST Controllers

Note: only json output now

### make your module extend RestfulModule and merge config's

    class Module extends \TheSupport\RestfulModule\Module {

    public function getConfig()
    {
        return array_merge(
            parent::getConfig(),
            include __DIR__ . '/config/module.config.php'
        );
    }

`this is an example module config with routes defined`

    return array(
        'controllers' => array(
            'invokables' => array(
                'index' => 'Application\Controller\IndexController',
            )
        ),
        'router' => array(
            'routes' => array(
                'ws' => array(
                    'type' => 'Segment',
                    'options' => array(
                        'route' => '/ws/:controller[.:format][/:id]',
                        'constraints' => array(
                            'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            'format' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            'id' => '[a-zA-Z0-9_-]*'
                        ),
                        'defaults' => array(
                            'format' => 'json'
                        ),
                    ),
                ),
            ),
        ),
    );

### Optional: check out if it works

Create controller within your module which extends example controller:

    class IndexController extends \TheSupport\RestfulModule\Controller\IndexController {
    }

then by calling (assuming module is ws and the routes are defined accordingly):

    curl -i -H "XDEBUG_SESSION=PHPSTORM" -X POST example.localhost/ws/index/

assuming that your routes are ok, and planets arragnement is auspicious you'll see sth like

    {
    "name": "YourResource",
    "id": 123,
    "what-is-that": "This it your 1st resource serverd by your app",
    "note": "please remember - it is just an example.",
    "info": "no matter what ID you are using use you get this resource... sry"
    }

Note: inheriting from  \TheSupport\RestfulModule\Controller\IndexController is not required - just a shortcut
to an example. In your day-by-day work you should inherit from Zend\Mvc\Controller\AbstractRestfulController
