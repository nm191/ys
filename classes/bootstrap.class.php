<?php
    class Bootstrap{
        static public function Alert($message, $context = 'info', $include_close_button = false){
            $return_ar[] = '<div class="alert alert-'.$context.($include_close_button ? ' alert-dismissible' : ' ').'fade show" role="alert">';
            if($include_close_button){$return_ar[] = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';}
            $return_ar[] = $message;
            $return_ar[] = '</div>';
            return implode('', $return_ar);
        }
    }
?>