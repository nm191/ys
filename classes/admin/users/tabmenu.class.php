<?php
    class Admin_Users_Tabmenu{
        static public function get($current_page_name){
            $page_names_ar = self::getPageNames();
            
            foreach($page_names_ar as $page_name => $title){
                $tmp_tab_ar = array();
                $tmp_tab_ar[] = '<li class="nav-item">';
                $tmp_tab_ar[] = '<a class="nav-link'.($page_name == $current_page_name ? ' active' : '').'" href="http://'.PUBLIC_ROOT.'admin/users/?page='.$page_name.'">'.$title.'</a>';
                $tmp_tab_ar[] = '<li class="nav-item">';
                $tabs_ar[] = implode('', $tmp_tab_ar);
            }

            $return_ar[] = '<ul class="nav nav-tabs">';
            $return_ar[] = implode('', $tabs_ar);
            $return_ar[] = '</ul>';

            return implode('', $return_ar);
        }

        static private function getPageNames(){
            $page_names_ar['user_overview'] = 'Overzicht';
            $page_names_ar['add_user']      = 'Voeg gebruiker toe';

            return $page_names_ar;
        }
    }

?>