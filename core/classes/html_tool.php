<?php

class html_tool
{
    /* Public variables */
    private $db;

    public $id;
    public $text;
    public $type;
    public $link;
    public $class;
    public $icon;
    public $last_name;


    /* - CREATE GLOBAL DATABASE ID - */
    public function __construct()
    {
        global $db;
        $this->db = $db;
    }

    //INSERT BUTTON
    static function button($text, $class, $reset = false)
    {
        //If reset parameter is true, set type reset, otherwise submit
        $reset = ($reset)?"reset":"submit";
        echo "<button type='$reset' class='btn $class'>$text</button>";
    }

    /** ---- INSERT ICON ----
     * @param $icon (name of the Material Icon)
     */
    static function icon($icon)
    {
        echo "<i class='material-icons'>$icon</i>";
    }

    /** ---- CONVERSION OF TIMESTAMP TO DANISH FORMAT ----
     * @param timestamp $date    (the timestamp you want converted)
     * @param int $time     (if you want the exact hour & minute also)
     * @param int $day      (if you want the day of the week written)
     * @param int $shortened (if you want the text shortened to 3 characters)
     */
    static function date_to_local($date, $time = 0, $day = 0, $shortened = 0) {
        if ($shortened) {
            //Array of the Danish names of the months
            $dk_months = array(1=> "Jan", "Feb", "Mar", "Apr", "Maj", "Jun", "Jul", "Aug", "Sep", "Okt", "Nov", "Dec");
        }
        else {
            //Array of the Danish names of the months
            $dk_months = array(1=> "Januar", "Februar", "Marts", "April", "Maj", "Juni", "Juli", "August", "September", "Oktober", "November", "December");
        }

        //Conversion of timestamp to Danish date.month.year
        $date_str = date("j", $date) . ". " . $dk_months[date("n",$date)] . " " . date("Y", $date);

        //If the day parameter is checked
        if ($day) {
            if ($shortened) {
                //Array of the Danish names of the days
                $dk_days = array(1=> "Man", "Tir", "Ons", "Tor", "Fre", "Lør", "Søn");
                //Inserting the weekday in front of the converted $date_str
                $date_str = $dk_days[date("N", $date)] . " d." . $date_str;
            }
            else {
                //Array of the Danish names of the days
                $dk_days = array(1=> "Mandag", "Tirsdag", "Onsdag", "Torsdag", "Fredag", "Lørdag", "Søndag");
                //Inserting the weekday in front of the converted $date_str
                $date_str = $dk_days[date("N", $date)] . " den " . $date_str;
            }

        }
        //Inserting hour & minutes behind the converted $date_str
        if ($time) {
            $date_str .= date("  k\l.H:i", $date);
        }

        echo $date_str;
    }
}