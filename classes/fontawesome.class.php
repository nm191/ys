<?php
    class FontAwesome{
        static public function Icon($icon_name, $size = 1, $fixed_width = false, $animation = false){
            return '<i class="fa fa-'.$icon_name.($fixed_width ? ' fa-fw' : ' ').($animation ? ' fa-'.$animation : ' ').' fa-'.$size.'x"></i>';
        }
    }
?>