<?php
/**
 *   JsTreeWidget  class file.
 *
 * @author Spiros Kabasakalis <kabasakalis@gmail.com>
 * @link http://iws.kabasakalis.gr/
 * @link http://www.reverbnation.com/spiroskabasakalis
 * @copyright Copyright &copy; 2013 Spiros Kabasakalis
 * @since 1.0
 * @license  http://opensource.org/licenses/MIT  The MIT License (MIT)
 * @version 1.0.0
 */

class JsTreeWidget extends CWidget
{

    /**
     * @var string the model class name with the NestedSetBehavior
     */
    public $modelClassName;

    /**
     * @var string the id of the div that will wrap jstree
     */
    public $jstree_container_ID = 'jstree_container';


    /**
     * @var string theme configuration
     * @link  http://www.jstree.com/documentation/themes
     */
    public $themes = array('theme' => 'default', 'dots' => true, 'icons' => true);

    /**
     * @var string plugins  configuration
     * @link http://www.jstree.com/demo
     *  If you want to disable tree manipulation (for example if rendering tree on frontend),just exclude contextmenu,crrm and dnd plugins.
     */
    public $plugins = array('themes', 'html_data', 'contextmenu', 'crrm', 'dnd', 'cookies','ui');



    public function init()
    {
        $this->register_Js_Css();
        parent::init();
    }

    private function register_Js_Css()
    {

        //assuming that we use the widget in  controller with JsTreeBehavior
        if(isset($this->controller->module)){
            $controllerID = $this->controller->module->id."/".$this->controller->id;
        }else{
            $controllerID = $this->controller->id;
        }

        //pass php variables to javascript
        $jstree_behavior_js = '(function ($) { JsTreeBehavior = ' . json_encode(array(
                'controllerID' => $controllerID,
                'container_ID' => $this->id,
                'open_nodes' => $this->getOpenNodes(),
                'themes' => $this->themes,
                'plugins' => $this->plugins,
                'urlFormat' => Yii::app()->urlManager->urlFormat,
                'csrfToken' => Yii::app()->request->csrfToken,
                'url' => array(
                    'fetchTree' => Yii::app()->createUrl($controllerID . '/fetchTree'),
                    'returnForm' => Yii::app()->createUrl($controllerID . '/returnForm'),
                    'returnView' => Yii::app()->createUrl($controllerID . '/returnView'),
                    'rename' => Yii::app()->createUrl($controllerID . '/rename'),
                    'remove' => Yii::app()->createUrl($controllerID . '/remove'),
                    'moveCopy' => Yii::app()->createUrl($controllerID . '/moveCopy'),
                ),
            )) . '; }(jQuery));';

        $baseUrl = Yii::app()->baseUrl;
		$clientScript = Yii::app()->clientScript;

        //uncomment to register jquery only if you have not already registered it somewhere else in your application
        //$clientScript->registerCoreScript('jquery');

        //uncomment to register bootstrap css if you have not already included  it (optional),or else you will have to style the html by yourself.
        //$clientScript->registerCssFile($baseUrl . '/js_plugins/bootstrap/css/bootstrap.css');
        $clientScript->registerCoreScript('cookie');
        $clientScript->registerScript(__CLASS__ . 'jstree_behavior_params', $jstree_behavior_js, CClientScript::POS_END);

        //modal dialog with noty.js
        $clientScript->registerScriptFile($baseUrl . '/js_plugins/noty/js/noty/jquery.noty.js', CClientScript::POS_END);
        $clientScript->registerScriptFile($baseUrl . '/js_plugins/noty/js/noty/layouts/center.js', CClientScript::POS_END);
        $clientScript->registerScriptFile($baseUrl . '/js_plugins/noty/js/noty/themes/default.js', CClientScript::POS_END);
        //js spinner
        $clientScript->registerScriptFile($baseUrl . '/js_plugins/spin.min.js', CClientScript::POS_END);
        //fancybox
        $clientScript->registerScriptFile($baseUrl . '/js_plugins/fancybox2/jquery.fancybox.js', CClientScript::POS_END);
        $clientScript->registerCssFile($baseUrl . '/js_plugins/fancybox2/jquery.fancybox.css');

        $clientScript->registerScriptFile($baseUrl . '/js_plugins/json2/json2.js');

        $clientScript->registerCoreScript('yiiactiveform');

        // jquery.form.js plugin http://malsup.com/jquery/form/
        $clientScript->registerScriptFile($baseUrl . '/js_plugins/ajaxform/jquery.form.js', CClientScript::POS_END);
        $clientScript->registerScriptFile($baseUrl . '/js_plugins/ajaxform/form.js', CClientScript::POS_END);
        //jstree
        $clientScript->registerScriptFile($baseUrl . '/js_plugins/jstree/jquery.jstree.js', CClientScript::POS_END);
        $clientScript->registerScriptFile($baseUrl . '/js_plugins/jstree.behavior.js', CClientScript::POS_END);
    }

    /**
     * Specify which nodes to open.Default is all but you can modify.
     * @return  string  $open_nodes  all the open nodes with node ids delimited by comma.
     */
    private function getOpenNodes()
    {
        $categories = CActiveRecord::model($this->modelClassName)->findAll(array('order' => 'lft'));
        $identifiers = array();
        foreach ($categories as $n => $category) {
            $identifiers[] = "'" . 'node_' . $category->id . "'";
        }
        $open_nodes = '[' . implode(',', $identifiers) . ']';
        return $open_nodes;
    }

    public function run()
    {
        $this->render('treewidget');
    }

}

