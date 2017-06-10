<?php
    class ErrorPages{
        static public function get404(){
            // <div class="jumbotron jumbotron-fluid">
            // <div class="container">
            //     <h1 class="display-3">Fluid jumbotron</h1>
            //     <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
            // </div>
            // </div>

            $return_ar[] = '<div class="jumbotron jumbotron-fluid">';
            $return_ar[] = '<div class="container">';
            $return_ar[] = '<h1 class="display-3">Pagina niet gevonden!</h1>';
            $return_ar[] = '<p class="lead">Oeps! De pagina is niet gevonden...</p>';
            $return_ar[] = '<p><a href="http://'.PUBLIC_ROOT.'">Ga terug naar de home pagina</a></p>';
            $return_ar[] = '</div>';
            $return_ar[] = '</div>';

            return implode('', $return_ar);
        }
    }

?>