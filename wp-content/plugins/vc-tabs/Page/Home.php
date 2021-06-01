<?php

namespace OXI_TABS_PLUGINS\Page;

/**
 * Description of Home
 *
 * @author biplo
 */
class Home {

    use \OXI_TABS_PLUGINS\Helper\Public_Helper;
    use \OXI_TABS_PLUGINS\Helper\CSS_JS_Loader;

    /**
     * Database
     *
     * @since 3.1.0
     */
    public $database;

    public function __construct() {
        $this->database = new \OXI_TABS_PLUGINS\Helper\Database();
        $this->CSSJS_load();
        $this->Render();
    }

    public function database_data() {
        return $this->database->wpdb->get_results("SELECT * FROM " . $this->database->parent_table . " ORDER BY id DESC", ARRAY_A);
    }

    public function CSSJS_load() {
        $this->admin_css_loader();
        $this->admin_home();
        $this->admin_ajax_load();
        apply_filters('oxi-tabs-plugin/admin_menu', TRUE);
    }

    /**
     * Admin Notice JS file loader
     * @return void
     */
    public function admin_ajax_load() {
        wp_enqueue_script('oxi-tabs-home', OXI_TABS_URL . '/assets/backend/custom/home.js', false, OXI_TABS_TEXTDOMAIN);
    }

    public function Render() {
        ?>
        <div class="oxi-addons-row">
            <?php
            $this->Admin_header();
            $this->created_shortcode();
            $this->create_new();
            ?>
        </div>
        <?php
    }

    public function Admin_header() {
        ?>
        <div class="oxi-addons-wrapper">
            <div class="oxi-addons-import-layouts">
                <h1>Responsive Tabs › Home
                </h1>
                <p> Collect Responsive Tabs Shortcode, Edit, Delect, Clone or Export it. </p>
            </div>
        </div>
        <?php
    }

    public function create_new() {
        echo _('<div class="oxi-addons-row">
                        <div class="oxi-addons-col-1 oxi-import">
                            <div class="oxi-addons-style-preview">
                                <div class="oxilab-admin-style-preview-top">
                                    <a href="' . admin_url("admin.php?page=oxi-tabs-ultimate-new") . '">
                                        <div class="oxilab-admin-add-new-item">
                                            <span>
                                                <i class="fas fa-plus-circle oxi-icons"></i>  
                                                Create New tabs
                                            </span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>');

        echo _('<div class="modal fade" id="oxi-addons-style-create-modal" >
                        <form method="post" id="oxi-addons-style-modal-form">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">                    
                                        <h4 class="modal-title">Tabs Clone</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class=" form-group row">
                                            <label for="addons-style-name" class="col-sm-6 col-form-label" oxi-addons-tooltip="Give your Shortcode Name Here">Name</label>
                                            <div class="col-sm-6 addons-dtm-laptop-lock">
                                                <input class="form-control" type="text" value="" id="addons-style-name"  name="addons-style-name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" id="oxistyleid" name="oxistyleid" value="">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <input type="submit" class="btn btn-success" name="addonsdatasubmit" id="addonsdatasubmit" value="Save">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    ');
        echo '<div class="modal fade" id="oxi-addons-style-change-modal" >
                        <form method="post" id="oxi-addons-style-change-modal-form">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">                    
                                        <h4 class="modal-title">Template Changing</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <label for="addons-style-name" class="col-sm-6 col-form-label">Layouts</label>
                                            <div class="col-sm-6 addons-dtm-laptop-lock">
                                                <select id="responsive-tabs-style-future-style"  class="form-control">
                                                    <option value="style1">Style 1</option>
                                                    <option value="style2">Style 2</option>
                                                    <option value="style3">Style 3</option>
                                                    <option value="style4">Style 4</option>
                                                    <option value="style5">Style 5</option>
                                                    <option value="style6">Style 6</option>
                                                    <option value="style7">Style 7</option>
                                                    <option value="style8">Style 8</option>
                                                    <option value="style9">Style 9</option>
                                                    <option value="style10">Style 10</option>
                                                    <option value="style11">Style 11</option>
                                                    <option value="style12">Style 12</option>
                                                    <option value="style13">Style 13</option>
                                                    <option value="style14">Style 14</option>
                                                    <option value="style15">Style 15</option>
                                                    <option value="style16">Style 16</option>
                                                    <option value="style17">Style 17</option>
                                                    <option value="style18">Style 18</option>
                                                    <option value="style19">Style 19</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="alert alert-danger">
                                            Template changing will destory your current style & its can\'t restore.
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" id="oxistylechangevalue" name="oxistylechangevalue" value="">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <input type="submit" class="btn btn-success" name="addonsdatasubmit" id="addonsdatasubmit" value="Save">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    ';
    }

    public function created_shortcode() {
        $return = _(' <div class="oxi-addons-row"> <div class="oxi-addons-row table-responsive abop" style="margin-bottom: 20px; opacity: 0; height: 0px">
                        <table class="table table-hover widefat oxi_addons_table_data" style="background-color: #fff; border: 1px solid #ccc">
                            <thead>
                                <tr>
                                    <th style="width: 5%">ID</th>
                                    <th style="width: 15%">Name</th>
                                    <th style="width: 10%">Templates</th>
                                    <th style="width: 30%">Shortcode</th>
                                    <th style="width: 40%">Edit Delete</th>
                                </tr>
                            </thead>
                            <tbody>');
        foreach ($this->database_data() as $value) {
            $id = $value['id'];
            $return .= _('<tr>');
            $return .= _('<td>' . $id . '</td>');
            $return .= _('<td>' . ucwords($value['name']) . '</td>');
            $return .= _('<td>' . $this->name_converter($value['style_name']) . '</td>');
            $return .= _('<td><span>Shortcode &nbsp;&nbsp;<input type="text" onclick="this.setSelectionRange(0, this.value.length)" value="[ctu_ultimate_oxi id=&quot;' . $id . '&quot;]"></span> <br>'
                    . '<span>Php Code &nbsp;&nbsp; <input type="text" onclick="this.setSelectionRange(0, this.value.length)" value="&lt;?php echo do_shortcode(&#039;[ctu_ultimate_oxi  id=&quot;' . $id . '&quot;]&#039;); ?&gt;"></span></td>');
            $return .= _('<td> 
                        <button type="button" class="btn btn-success oxi-addons-style-clone"  style="float:left" oxiaddonsdataid="' . $id . '">Clone</button>
                        <a href="' . admin_url("admin.php?page=oxi-tabs-ultimate-new&styleid=$id") . '"  title="Edit"  class="btn btn-info" style="float:left; margin-right: 5px; margin-left: 5px;">Edit</a>
                       <form method="post" class="oxi-addons-style-delete">
                               <input type="hidden" name="oxideleteid" id="oxideleteid" value="' . $id . '">
                               <button class="btn btn-danger" style="float:left"  title="Delete"  type="submit" value="delete" name="addonsdatadelete">Delete</button>  
                       </form>
                       <form method="post" class="oxi-addons-style-change">
                               <input type="hidden" name="oxistylename" id="oxistylename" value="' . $value['style_name'] . '">
                               <input type="hidden" name="oxistylechangeid" id="oxistylechangeid" value="' . $id . '">
                               <button class="btn btn-info" style="float:left; margin-left: 5px;"  title="Template"  type="submit" value="template" name="layouts">Template</button>  
                       </form>
                </td>');
            $return .= _(' </tr>');
        }
        $return .= _('      </tbody>
                </table>
            </div>
            <br>
            <br></div>');
        echo $return;
    }

}
