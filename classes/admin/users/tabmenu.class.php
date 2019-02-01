<?php
    class Admin_Users_Tabmenu{
        static public function get($current_page_name){
            $page_names_ar = self::getPageNames();
            
            foreach($page_names_ar as $page_name => $title){
                $tmp_tab_ar = array();
                $tmp_tab_ar[] = '<li class="tab">';
                $tmp_tab_ar[] = '<a class="teal-text'.($page_name == $current_page_name ? ' active' : '').'" href="http://'.PUBLIC_ROOT.'admin/users/?page='.$page_name.'">'.$title.'</a>';
                $tmp_tab_ar[] = '</li>';
                $tabs_ar[] = implode('', $tmp_tab_ar);
            }

            $return_ar[] = '<ul class="tabs z-depth-1">';
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