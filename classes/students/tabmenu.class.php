<?php
    class Students_Tabmenu{
        static public function get($current_page_name){

            // <ul class="nav nav-tabs">
            //     <li class="nav-item">
            //         <a class="nav-link active" href="#">Active</a>
            //     </li>
            //     <li class="nav-item">
            //         <a class="nav-link" href="#">Link</a>
            //     </li>
            //     <li class="nav-item">
            //         <a class="nav-link" href="#">Link</a>
            //     </li>
            //     <li class="nav-item">
            //         <a class="nav-link disabled" href="#">Disabled</a>
            //     </li>
            // </ul>
            $page_names_ar = self::getPageNames();

            foreach($page_names_ar as $page_name => $title){
                $tmp_tab_ar = array();
                $tmp_tab_ar[] = '<li class="nav-item">';
                $tmp_tab_ar[] = '<a class="nav-link'.($page_name == $current_page_name ? ' active' : '').'" href="http://'.PUBLIC_ROOT.'students/?page='.$page_name.'">'.$title.'</a>';
                $tmp_tab_ar[] = '<li class="nav-item">';
                $tabs_ar[] = implode('', $tmp_tab_ar);
            }

            $return_ar[] = '<ul class="nav nav-tabs">';
            $return_ar[] = implode('', $tabs_ar);
            $return_ar[] = '</ul>';

            return implode('', $return_ar);
        }

        static private function getPageNames(){
            $page_names_ar['students_overview'] = 'Overzicht';
            $page_names_ar['add_student']      = 'Voeg leerling toe';

            return $page_names_ar;
        }
    }

?>