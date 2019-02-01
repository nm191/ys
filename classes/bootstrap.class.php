<?php
    class Bootstrap{
        static public function Alert($message, $context = 'info', $include_close_button = false){
            $return_ar[] = '<div class="alert card-panel '.$context.' role="alert">';
            // if($include_close_button){$return_ar[] = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';}
            $return_ar[] = $message;
            $return_ar[] = '</div>';
            return HTML::Div(implode('', $return_ar), '', 'row');
        }
    }
?>