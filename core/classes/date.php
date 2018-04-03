<?php

class date
{

    /**
     * Beskrivelse af Date Selector Class
     * Klasse til at lave dato/tid selectbokse
     * Returnerer en selectboks ud fra et defineret format (day, month, year, hours, minutes)
     * Eksempel på et kald:
     * $dateObj = new DateSelector($timestamp);
     * $dateObj->dateselector([format], [name]);
     *
     * @property int $stamp Et timestamp
     *
     * @property string $strName Navn på select boksen (Ex: date_start, date_stop, birthday ...)
     * @property string $strFormat Det ønskede datoformat (Ex: day, month, year, hours, minutes)
     * @property string $accHtml String med akkumuleret html
     * @property bool $useLocalNames Bool værdi til at definere om der skal bruges lokale dag og månedsnavne (Default: TRUE)
     * @property int $minuteIntVal Minut Interval Værdi. Kan sættes til 1, 5, 15 etc. (Default: 1)
     * @property array $arrTerms Single array with dateformat value, min and max value for the given format
     * @property array $arrDay2Local Array with local daynames (Index starts at 1)
     * @property array $months Array with local monthnames (Index starts at 1)
     *
     * @author Heinz K, Tech College, Dec 2016
     * */

    public $date;
    public $strName;
    public $strFormat;
    public $accHtml;
    public $useLocalNames;
    public $minuteIntVal;
    private $arrTerms;
    //Conversion Variables
    public $months;
    public $days;
    //Parameter Variables
    public $shortened;

    /**
     *
     * @param int $date Uses a timestamp value as argument.
     */
    public function __construct($date, $shortened = 0, $language='DA') {
        $this->date = $date;
        $this->strName = "";
        $this->strFormat = "";
        $this->useLocalNames = TRUE;
        $this->minuteIntVal = 1;
        $this->accHtml = "";
        $this->shortened = $shortened;

        switch (strtoupper($language)) {

            //English language Case
            case "EN":
                //Creation of English Month names
                if ($shortened) {
                    //Array of the shortened English names of the months
                    $this->months = array(1=> "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
                    //Array of the shortened English names of the days
                    $this->days = array(1=> "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun");
                }
                else {
                    //Array of the English names of the months
                    $this->months = array(1=> "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
                    //Array of the English names of the days
                    $this->days = array(1=> "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
                }
                break;

            //Default (Danish) language Case
            default:
            //Creation of Danish Month names
            if ($shortened) {
                //Array of the shortened Danish names of the months
                $this->months = array(1=> "Jan", "Feb", "Mar", "Apr", "Maj", "Jun", "Jul", "Aug", "Sep", "Okt", "Nov", "Dec");
                //Array of the shortened Danish names of the days
                $this->days = array(1=> "Man", "Tir", "Ons", "Tor", "Fre", "Lør", "Søn");
            }
            else {
                //Array of the Danish names of the months
                $this->months = array(1=> "Januar", "Februar", "Marts", "April", "Maj", "Juni", "Juli", "August", "September", "Oktober", "November", "December");
                //Array of the Danish names of the days
                $this->days = array(1=> "Mandag", "Tirsdag", "Onsdag", "Torsdag", "Fredag", "Lørdag", "Søndag");
            }
            break;
        }
    }

    /* - DATE SELECT CONSTRUCTER - */
    public function date_selector($input_name, $time = 0, $year = 1, $day = 1, $month = 1) {
    }

    /* ---- CONVERSION OF TIMESTAMP TO DANISH FORMAT ---- */
    /**
     * Date To Local Info
     * - Converts a timestamp to Danish formats -
     * @param timestamp $date    (the timestamp you want converted)
     * @param int $time     (if you want the exact hour & minute also)
     * @param int $day      (if you want the day of the week written)
     * @param int $shortened (if you want the text shortened to 3 characters)
     */
    public function date_to_local($show_time = 0, $show_day = 0) {

        //Conversion of timestamp to Danish date.month.year
        $date_str = date("j", $this->date) . ". " . $this->months[date("n",$this->date)] . " " . date("Y", $this->date);

        //Inserting hour & minutes behind the converted $date_str
        if ($show_time) {
            $date_str .= date("  k\l.H:i", $this->date);
        }

        //If the day parameter is checked
        if ($show_day) {
            if ($this->shortened) {
                //Inserting the weekday in front of the converted $date_str
                $date_str = $this->days[date("N", $this->date)] . " d." . $date_str;
            }
            else {
                //Inserting the weekday in front of the converted $date_str
                $date_str = $this->days[date("N", $this->date)] . " den " . $date_str;
            }
        }
        //Write out the date as formated HTML
        echo $date_str;
    }




    /* -------- HEINZ DATE CLASS ---------*/
    /**
     * Beskrivelse af Date Selector Class
     * Klasse til at lave dato/tid selectbokse
     * Returnerer en selectboks ud fra et defineret format (day, month, year, hours, minutes)
     * Eksempel på et kald:
     * $dateObj = new DateSelector($timestamp);
     * $dateObj->dateselector([format], [name]);
     *
     * @property int $stamp Et timestamp
     *
     * @property string $strName Navn på select boksen (Ex: date_start, date_stop, birthday ...)
     * @property string $strFormat Det ønskede datoformat (Ex: day, month, year, hours, minutes)
     * @property string $accHtml String med akkumuleret html
     * @property bool $useLocalNames Bool værdi til at definere om der skal bruges lokale dag og månedsnavne (Default: TRUE)
     * @property int $minuteIntVal Minut Interval Værdi. Kan sættes til 1, 5, 15 etc. (Default: 1)
     * @property array $arrTerms Single array with dateformat value, min and max value for the given format
     * @property array $months Array with local monthnames (Index starts at 1)
     *
     * @author Heinz K, Tech College, Dec 2016
     * */


    /**
     * Genererer et timestamp ud fra form dato select værdier
     * Eksempel på kald:
     * $obj->birthdate = datetool::makeStamp("birthdate");
     *
     * @param string $input_name Navnet på dato feltet (birthdate, event_date etc.)
     * @return int Returnerer et timestamp
     */
    static function make_timestamp($input_name) {
        /* Sætter array med de forskellige formater */
        $arrFormats = array("day", "month", "year", "hours", "minutes");
        /* Sætter array til at fange form data */
        $arrDate = array();
        /* Loop datoformater og find dem i form vars ud fra dato feltets navn. Eks: birthdate_day, birthdate_year... */
        foreach($arrFormats as $value) {
            $arrDate[$value] = filter_input(INPUT_POST, $input_name . "_" . $value, FILTER_SANITIZE_NUMBER_INT,
                array('options' => array('default' => 0)));
        }
        /* Genererer og returnerer timestamp*/
        return mktime($arrDate["hours"],$arrDate["minutes"],0,$arrDate["month"],$arrDate["day"],$arrDate["year"]);
    }


    /**
     * Method dateSelect
     * Initializes the format and builds select and box options
     * @param string $strFormat
     * @param string $strName
     * @return string $accHtml Returns an accumulated html string with select box and options
     */
    public function dateSelect($strFormat, $strName) {
        $this->strName = $strName;
        $this->strFormat = $strFormat;
        /* Initializes $this->arrTerms */
        $this->initTerms();
        /* Sets the selectbox html */
        $this->accHtml = "<select class='form-control input-sm dateselect' name='$this->strName"."_"."$this->strFormat'>\n";
        /* If set define the minute interval */
        $freq = ($this->strFormat === "minutes") ? $this->minuteIntVal : 1;
        /* Iterates the numFloor and numCeil and builds the select option bundle */
        for($i = $this->arrTerms["numFloor"]; $i <= $this->arrTerms["numCeil"];$i+= $freq) {
            /* Get the option text */
            $strOptText = $this->getOptText($i);
            /* Pad the value with a left zero to fit a match */
            $strSelected = (str_pad($i,2,0,STR_PAD_LEFT) === $this->arrTerms["numSelected"]) ? "selected" : "";
            /* Add option tag to accHtml var */
            $this->accHtml .= "<option value=\"" . $i . "\" " . $strSelected . ">" . $strOptText . "</option>\n";
        }
        $this->accHtml .= "</select>\n";
        return $this->accHtml;
    }

    /**
     * Method getOptsText (Get Option Text)
     * Outputs a user friendly option text for the given format
     * @param var $val The numeric value of a month, hour or minute (Ex: 1, 2, 3 etc... )
     * @return var $val Returns the processed output
     */
    private function getOptText($val) {
        switch(strtoupper($this->strFormat)) {
            case "MONTH":
                if($this->useLocalNames) {
                    $val = $this->months[$val];
                } else {
                    $val = date("F", $this->date);
                }
                break;
            case "HOURS":
            case "MINUTES":
                $val = str_pad($val,2,0,STR_PAD_LEFT);
                break;
        }
        return $val;
    }
    /**
     * Method initTerms (Initialize terms)
     * Creates an array ($this->arrTerms) with the following:
     * numSelected => the selected date according to the given format (Ex: 5, 12, 2016, 03, 06)
     * numFloor => The minimum number in the format range
     * numCeil => The maximum number in the format range
     * Has no return as this method set the class member propery $this->arrTerms
     */
    private function initTerms() {
        switch(strtoupper($this->strFormat)) {
            case "DAY":
                $this->arrTerms = array(
                    "numSelected" => date("d", $this->date),
                    "numFloor" => 1,
                    "numCeil" => 31
                );
                break;
            case "MONTH":
                $this->arrTerms = array(
                    "numSelected" => date("m", $this->date),
                    "numFloor" => 1,
                    "numCeil" => 12
                );
                break;
            case "YEAR":
                $this->arrTerms = array(
                    "numSelected" => date("Y", $this->date),
                    "numFloor" => date("Y", $this->date)-100,
                    "numCeil" => date("Y", $this->date)+20
                );
                break;
            case "HOURS":
                $this->arrTerms = array(
                    "numSelected" => date("H", $this->date),
                    "numFloor" => "00",
                    "numCeil" => 23
                );
                break;
            case "MINUTES":
                $this->arrTerms = array(
                    "numSelected" => date("i", $this->date),
                    "numFloor" => "00",
                    "numCeil" => 59
                );
                break;
        }
    }
}