<?php

class list_presenter
{
    /* Public variables */
    private $db;

    public $id;
    public $arr_columns;
    public $arr_values;
    public $acc_html;
    public $class;
    public $icon;
    public $last_name;


    /* - CREATE GLOBAL DATABASE ID - */
    public function __construct($arr_columns, $arr_values)
    {
        $this->arr_columns = $arr_columns;
        $this->arr_values = $arr_values;
        $this->acc_html = "";

        global $db;
        $this->db = $db;
    }

    /** ---- LIST PRESENTER ----
     * @param int $delete   (enable if you want to add the Delete option)
     * @param int $edit     (enable if you want to add the Edit option)
     * @param int $details  (enable if you want to add the Details option)
     */
    public function present_list($delete = 0,$edit = 0, $details = 0)
    {
        echo "
            <div class='container'>
                <a href='?mode=edit'><h6>Add New</h6></a>                
            </div>
            <hr>
            <div class='container'>
            <table class='table table-striped'>
                <thead class='thead-dark'>
                    <tr>";
        if ($delete || $edit || $details) {
            echo        "<th></th>";
        }
        foreach ($this->arr_columns as $key) {
            echo        "<th>$key</th>";
        }

        echo "      </tr>
                </thead>";
        // One variable after "as" only draws out the values of each Index
        foreach ($this->arr_values as $rows) {
            echo "<tr>";

            if ($delete || $edit || $details) {
                echo    "<td>";

                if ($edit) {
                    echo    "<a href='?mode=edit&id=$rows[id]'><i class='material-icons'>mode_edit</i></a>";
                }
                if ($delete) {
                    echo "<a href='?mode=delete&id=$rows[id]'><i class='material-icons'>delete</i></a>";
                }
                if ($details) {
                    echo "<a href='?mode=details&id=$rows[id]'><i class='material-icons'>visibility</i></a>";
                }
                echo    "</td>";
            }
        // Two variables after "as" gives you the index on the first and the index'es value on the second variable
            foreach ($this->arr_columns as $key => $values) {
                echo "<td>$rows[$key]</td>";
            }
            echo "</tr>";
        }

        echo "</table>";
    }

    public function details_presenter()
    {

    }
}