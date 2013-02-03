# JsTreeBehavior
 © 2013  [Spiros Kabasakalis](http://iws.kabasakalis.gr/)
  [The MIT License (MIT)]( http://opensource.org/licenses/MIT)
  
  ![JsTreeBehavior](https://lwuzqa.dm1.livefilestore.com/y1pZ7ydTb51qV-0JQaF5lgUl4n-DR0itJsQg2RqFRW6pSqXVeZxAi_xNPKOSFx-l4OjX5FXqCBTqYZee_PIQqlBDbq8-0iHZkBY/jstree.png?psid=1)
  
## [LIVE DEMO](http://yiilab.kabasakalis.tk/category/tree)  
  
## Overview
Tree graphic manipulation of an ActiveRecord with NestedSet Behavior using jstree plugin.
This is actually a complete rewrite of my [NestedSetAdminGUI extension](http://www.yiiframework.com/extension/nestedsetadmingui).
Instead of gii generated files for every model,I wrote a reusable behavior that provides the same functionality.I also have separated  markup from js,and the code
 is much cleaner now.Many jstree options can be set in JsTreeWidget.php file,you can add more if you wish-I did'nt include them all,there are so many.

## Setup.

- Copy the js_plugins folder in webroot folder.I don't like publishing assets.I register css and jss straight from 
  a webroot subfolder.
- Copy the widgets folder in your protected folder.It contains the JsTreeWidget class and view files.
- Copy behaviors folder containing NestedSetBehavior.php and JsTreeBehavior.php  class file in protected folder.
- Prepare the database table for your hierarchical ActiveRecord Model.
  Use the category.sql file (category table) as reference.Columns root,lft,rgt and level are essential for nestedset behavior.Apart from them you will need at least one
 column to store the label for the tree nodes,for example "name",and a primary key.You can add more columns,(like "description")
- Create the ActiveRecord class file that corresponds to category,say Category.php.Give it a nested set behavior.In Category.php :

 ~~~
 public function behaviors()
{
   return array(
       'NestedSetBehavior'=>array(
           'class'=>'application.behaviors.NestedSetBehavior',
           'leftAttribute'=>'lft',
           'rightAttribute'=>'rgt',
           'levelAttribute'=>'level',
           'hasManyRoots'=>true
           ),
   );
}
 ~~~
 
- Copy  BaseController.php file to components folder.This controller makes possible for controllers that extend from it to turn behavior inherited functions
 into actions.
- Create a controller in protected/controllers folder  that extends from BaseController.php,CategoryController  and give it a JsTreeBehavior.In CategoryController:
 ~~~
  public function behaviors()
     {
         return array(
             'jsTreeBehavior' => array('class' => 'application.behaviors.JsTreeBehavior',
                 'modelClassName' => 'Category',
                 'form_alias_path' => 'application.views.category._form',
                 'view_alias_path' => 'application.views.category.view',
                     'label_property' => 'name',
                     'rel_property' => 'name'
             )
         );
     }
 ~~~
 - modelClassName is the class name of the ActiveRecord,form_alias_path is alias path of the form view file used
 to update and create nodes in the tree with fancybox pop ups.view_alias_path is the view file path alias used to show details for a record,(property values).
 You can easily modify the example files provides to suit your own model.You will only need to change/add input fields.
 label_property is the model property that will show as label in the tree nodes.
 rel_property is the model property that will be used as value for the rel property of the li tags in the tree markup.

- Last, add an action actionTree in Category Controller that renders a tree.php file.In tree.php file render the JsTreeWidget like so
 
 ~~~
 $this->widget('application.widgets.JsTreeWidget',
                       array('modelClassName' => 'Category',
                                 'jstree_container_ID' => 'Category-wrapper',//jstree will be rendered in this div.id of your choice.
                                 'themes' => array('theme' => 'default', 'dots' => true, 'icons' => true),
                                 'plugins' => array('themes', 'html_data', 'contextmenu', 'crrm', 'dnd', 'cookies', 'ui')
                                             ));
 ?>
  ~~~
  
 Fot themes and plugins options see [jtree documentation](http://www.jstree.com/documentation)

- Make sure you include jquery.Either uncomment the relevant line in JsTreeWidget or register it somewhwere else in your code.
- Example files use bootstrap styled markup.Uncomment the relevant line that registers bootstrap.css in JsTreeWidget
   if it's not already registered somewhere else in your application.
- Example files provided.
- To manipulate the tree,navigate to category/tree.Right click on nodes to see available operations.Drag and drop nodes,delete,create,update etc.


    ##Resources
- [jsTree ](http://www.jstree.com/)
- [NestedSetBehavior](http://www.yiiframework.com/extension/nestedsetbehavior)
- [Fancybox](http://www.fancyapps.com/fancybox/)
- [Noty](http://needim.github.com/noty/)
- [Bootstrap](http://twitter.github.com/bootstrap/)
- [JQueryForm Plugin]( http://malsup.com/jquery/form/)
- [spin.js](http://fgnass.github.com/spin.js/)






