<?php
/**
 * tree view  file
 * Renders the JsTreeWidget
 *
 * @author Spiros Kabasakalis <kabasakalis@gmail.com>
 * @link http://iws.kabasakalis.gr/
 * @link http://www.reverbnation.com/spiroskabasakalis
 * @copyright Copyright &copy; 2013 Spiros Kabasakalis
 * @since 1.0
 * @license  http://opensource.org/licenses/MIT  The MIT License (MIT)
 * @version 1.0.0
 */
$this->widget('application.widgets.JsTreeWidget',
                               array('modelClassName' => 'Category',
                                           'jstree_container_ID' => 'Category-wrapper',
                                           'themes' => array('theme' => 'default', 'dots' => true, 'icons' => true),
                                           'plugins' => array('themes', 'html_data', 'contextmenu', 'crrm', 'dnd', 'cookies', 'ui')
                                            ));
?>
