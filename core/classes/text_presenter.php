<?php
/**
 * Presenter for admin text & html snippets
 * @copyright (c) 2016, Heinz K, Tech College
 */
class text_presenter {
    /**
     * Metode til at vise panel i toppen af CMS modul sider
     * @param string $module_name Modulets navn (Eks: Brugere, Events, Produkter... )
     * @param string $module_mode Modulets mode (Eks: Oversigt, Rediger, Opret ny...)
     * @param array $button_panel_array Array med knapper (Eks: .... ingen eksempler :(  )
     * @return string
     */
    static function present_panel($module_name = "Modul", $module_mode = "Oversigt", $button_panel_array = array()) {
        $acc_html = ""; /* Accumulated html string */

        /* Indsætter titler */
        $acc_html .= '<div class="header__main">' .
            '  <div class="pull-left">' .
            '   <h1>' . $module_name . '</h1>' .
            '   <h2>' . $module_mode . '</h2>' .
            '  </div>';

        /* Bygger knap panel */
        if(count($button_panel_array) > 0) {
            $acc_html .= '<div class="pull-right">';
            foreach ($button_panel_array as $button) {
                $acc_html .= $button;
            }
            $acc_html .= '</div>';
        }

        $acc_html .= '</div>';

        return $acc_html;
    }
}