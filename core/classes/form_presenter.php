<?php

class form_presenter
{
    /* - GLOBAL VARIABLES - */
    private $db;
    /* Input Variables */
    public $arr_values;
    public $arr_labels;
    public $arr_form_types;
    /* Construct Variables */
    public $action;
    public $enc_type;
    public $class;
    public $html_id;
    public $acc_html;

    /* - CLASS CONSTRUCTOR - */
    /**
     * Constructor Info.
     * - Prepares variables for the form_presenter method -
     * @param $arr_values: is the values/fields that needs to be made (user table from database etc.)
     * @param $arr_labels: is the array containing the userfriendly names for the labels in the form (User Name for the user_name column etc.)
     * @param $arr_form_types: array with info needed for construction of forms and stuff
     * $arr_form_types[0]: is the input field type
     * $arr_form_types[1]: is the filter needed for writing to database
     * $arr_form_types[2]: is if the field is Required (as true/false)
     * $arr_form_types[3]: is the default value of the field, if nothing is submitted
     */
    public function __construct($arr_labels, $arr_form_types, $arr_values = false)
    {
        //If no data is already there (create new), make array with standard values
        if (!$arr_values) {
            $arr_values = array();
            foreach ($arr_form_types as $key => $value) {
                $arr_values[$key] = $arr_form_types[$key] [3];
            }
        }

        //Create Global Database
        global $db;
        $this->db = $db;

        //Values & Label Construction
        $this->arr_values = $arr_values;
        $this->arr_labels = $arr_labels;
        $this->arr_form_types = $arr_form_types;
        //Parameter Default Values
        $this->action = "save";
        $this->enc_type = false;
        $this->class = "";
        $this->html_id = "";
        $this->acc_html = "";

    }
    /* - GLOBAL VARIABLE & CONSTRUCTOR (end) - */
    /* ------------------------------------------------------------------------
    /* - FORM PRESENTER (start) - */


    /* - FORM PRESENTER - */
    /**
     * Form Presenter Info
     * - Creates the form in it's entirety (with help from other methods) -
     * - This is the main method of this class -
     * Needs $arr_values, $arr_labels & $arr_form_types from the Constructor
     */
    public function form_presenter($submit_button = "Indsend", $cancel_button = "Nulstil")
    {
        echo "<form method='post' class='$this->class form-horizontal' id='$this->html_id'>
                <input type='hidden' name='mode' value='$this->action'>";

        /**
         * $key is the array key like user_name, id, address etc.
         * $form_elements[0] is the input type
         * $form_elements[1] is the filter the input needs
         * $form_elements[2] is the if the field is required
         * $form_elements[3] is the standard value of the input field
         */
        foreach ($this->arr_form_types as $key => $form_elements)
        {
            //Use Input_field method to create the input field html
            $this->input_field($form_elements[0], $key, $this->arr_values[$key], $form_elements[2]);
        }

        html_tool::button($cancel_button, "btn-secondary", 1);
        html_tool::button($submit_button, "btn-primary");
        echo "</form>";
    }

    /* - FORM PRESENTER (end) - */
    /* ------------------------------------------------------------------------
    /* - INPUT AREA (start) - */

    /* - INPUT FIELD METHOD - */
    /**
     * Input Field Info
     * - Creates the input fields depending on the type they need -
     * @param $form_type: the type the input field need to be (text, number etc.)
     * @param $name: name/id of the input field (user_name, id etc.)
     * @param $value: the value the input field should have
     * @param bool $required: activates required if set TRUE
     */
    public function input_field($form_type, $name, $value, $required=FALSE) {
        $required = ($required==1)?" required " : 0;

        switch (strtoupper($form_type))
        {
            case "TEXTAREA":
                $input_field = "<textarea name='$name' id='$name' $required>$value</textarea>";
                break;

            case "SELECT":
                //Need to use the select_box method before this (in the module)
                $input_field = "<select class='form-control' name='$name' id='$name' $required>
                                    $value    
                                </select>";
                break;

            case "DATE":
                $timestamp = ($value > 0) ? $value : time();
                $d = new date($timestamp);
                $input_field = "<div class='form-inline'>";
                $input_field .= $d->dateSelect("day",$name);
                $input_field .= $d->dateSelect("month",$name);
                $input_field .= $d->dateSelect("year",$name);
                $input_field .= "</div>";
                break;
            case "DATETIME":
                $timestamp = ($value > 0) ? $value : time();
                $d = new date($timestamp);
                $input_field = "<div class='form-inline'>";
                $input_field .= $d->dateSelect("day",$name);
                $input_field .= $d->dateSelect("month",$name);
                $input_field .= $d->dateSelect("year",$name);
                $input_field .= $d->dateSelect("hours",$name);
                $input_field .= $d->dateSelect("minutes",$name);
                $input_field .= "</div>";
                break;

            case "HIDDEN":
                echo "<input type='$form_type' name='$name' id='$name' value='$value' $required>";
                break;

            default:
                $input_field = "<input type='$form_type' name='$name' id='$name' value='$value' $required>";
                break;

        }

        if (strtoupper($form_type) !== "HIDDEN")
        {
            $this->input_group($input_field, $name, $this->arr_labels[$name]);
        }
    }

    /* - SELECT BOX PREPARATION METHOD - */
    /**
     * Select Box Preparation Info
     * - Prepares select box options for the form -
     * @param string $db_table:  name of the table to call (user, city etc.)
     * @param string $default_label:   text on the first option (Choose City etc.)
     * @param string $value_label_key:   the name of the key where the "shown text" is like "<option>$VALUE_LABEL_KEY_HERE</option>" (default(false) is the same as $arr_value_key)
     * @param string $arr_value_key: if the value key is different from the Table Name (default (false) is the same as $db_table)
     * @param string $select: the database SELECT you wanna make (default(false) is * (select all))
     */
    public function select_box($db_table, $default_label, $value_label_key = false, $arr_value_key = false, $select = "*")
    {
        //Pull "arr_value" key from "db_table" name if they're the same
        $arr_value_key = ($arr_value_key)?$arr_value_key:$db_table;
        //Define where the option text comes from, or pull it from default key
        $value_label_key = ($value_label_key)?$value_label_key:$arr_value_key;
        //Define Default value, if it's an Update Case Form
        $default_value = ($this->arr_values[$arr_value_key])?$this->arr_values[$arr_value_key]:null;
        //Database pull of options
        $sql = "SELECT $select FROM $db_table";
        $options = $this->db->fetch_array($sql);

        //Top Option, Default text (Choose Country etc.)
        $acc_html = "<option value='0'>$default_label</option>";
        //Loop through & add options
        foreach ($options as $key => $value){
            //If the value is already the one selected, give selected attribute
            if ($value[$arr_value_key]==$default_value){
                $acc_html .= "<option value='$value[$arr_value_key]' selected>$value[$value_label_key]</option>";
            }
            //Else write a normal option
            else{
                $acc_html .= "<option value='$value[$arr_value_key]'>$value[$value_label_key]</option>";
            }

        }
        //Replace the keys' value in $arr_values, to directly write them out
        $this->arr_values[$arr_value_key] = $acc_html;
    }

    /* - INPUT GROUP METHOD - */
    /**
     * Input Group Info
     * - Wraps the input field in HTML for nicer setup -
     * All inputs here is coming from the input_field method
     * @param $input_field: The Input field itself
     * @param $name: the name/id of the input field
     * @param $label: The text supposed to be in <label>
     */
    public function input_group($input_field, $name, $label)
    {
        echo "<div class='form-group' data-group='$name'>
                    <label class='col-sm-3 control-label' for='$name'>$label</label>
                    <div class='col-sm-9 form-inline'>
                        $input_field
                    </div>
                </div>";
    }
}