<!--
 /**
  * treewidget view file
  *
  * Date: 1/29/13
  * Time: 12:00 PM
  *
  * @author: Spiros Kabasakalis <kabasakalis@gmail.com>
  * @link http://iws.kabasakalis.gr/
  * @link http://www.reverbnation.com/spiroskabasakalis
  * @copyright Copyright &copy; Spiros Kabasakalis 2013
  * @license http://opensource.org/licenses/MIT  The MIT License (MIT)
  * @version 1.0.0
  */
  -->
<div class="span8">
    <h1 class="page-header">CActiveRecord with NestedSet behavior Administration with jstree </h1>
    <div class="row well">
        <ul>
            <li>If tree is empty,start by creating one or more root nodes.</li>
            <li>Right Click on a node to see available operations.</li>
            <li>Move nodes with Drag And Drop.You can move a non-root node to root position and vice versa.</li>
            <li>Root nodes cannot be reordered.Their order is fixed by id.</li>
        </ul>
    </div>
    <div class="row">
        <input id="reload" type="button" value="Refresh" class="btn btn-large pull-left">
        <input id="add_root" type="button" value="Create Root" class="btn btn-large pull-left">
    </div>
    <div class="row">
        <!--The tree will be rendered in this div-->
        <div class="well" style="margin-top: 20px" class="row" id="<?php echo $this->jstree_container_ID;?>"></div>
    </div>
</div>