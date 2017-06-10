<?php
    class TrainingGenerator_Forms_TrainingForm{
        static public function get(){

            $return_ar[] = self::getForm();
            $return_ar[] = self::getJquery();
            return implode('', $return_ar);
        }

        static private function getFormElements(){  
            //name
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'text'; 
            $tmp_args_ar['label'] = 'Naam:';  
            $tmp_args_ar['name'] = 'name'; 
            $tmp_args_ar['id'] = 'name'; 
            $tmp_args_ar['class'] = 'form-control'; 
            $tmp_args_ar['required'] = 'true'; 
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Input($tmp_args_ar);

            //is_for_group_1
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'checkbox'; 
            $tmp_args_ar['label'] = 'Voor eerste groep?';  
            $tmp_args_ar['name'] = 'is_for_group_1'; 
            $tmp_args_ar['id'] = 'is_for_group_1'; 
            $tmp_args_ar['class'] = 'form-control'; 
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Input($tmp_args_ar);

            //is_for_group_2
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'checkbox'; 
            $tmp_args_ar['label'] = 'Voor tweede groep?';  
            $tmp_args_ar['name'] = 'is_for_group_2'; 
            $tmp_args_ar['id'] = 'is_for_group_2'; 
            $tmp_args_ar['class'] = 'form-control'; 
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Input($tmp_args_ar);

            //duration_in_mins
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'number'; 
            $tmp_args_ar['label'] = 'Tijd in minuten';  
            $tmp_args_ar['name'] = 'duration_in_mins'; 
            $tmp_args_ar['id'] = 'duration_in_mins'; 
            $tmp_args_ar['class'] = 'form-control'; 
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Input($tmp_args_ar);

            //theme
            $tmp_args_ar = array();
            $tmp_args_ar['label'] = 'Thema';  
            $tmp_args_ar['name'] = 'theme'; 
            $tmp_args_ar['id'] = 'theme'; 
            $tmp_args_ar['options'] = array('duur' => 'Duur', 'kracht' => 'Kracht', 'techniek' => 'Techniek'); 
            $tmp_args_ar['class'] = 'form-control'; 
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Select($tmp_args_ar);

            //supplies
            $tmp_args_ar = array();
            $tmp_args_ar['label'] = 'Benodigdheden';  
            $tmp_args_ar['name'] = 'supplies'; 
            $tmp_args_ar['id'] = 'supplies'; 
            $tmp_args_ar['class'] = 'form-control'; 
            $form_elements_ar[$tmp_args_ar['name']] = HTML::TextArea($tmp_args_ar);
            
            //description
            $tmp_args_ar = array();
            $tmp_args_ar['label'] = 'Omschrijving';  
            $tmp_args_ar['name'] = 'description'; 
            $tmp_args_ar['id'] = 'description'; 
            $tmp_args_ar['class'] = 'form-control'; 
            $form_elements_ar[$tmp_args_ar['name']] = HTML::TextArea($tmp_args_ar);
            
            //description
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'submit';
            $tmp_args_ar['name'] = 'btn_submit'; 
            $tmp_args_ar['id'] = 'btn_submit'; 
            $tmp_args_ar['class'] = 'btn btn-success'; 
            $tmp_args_ar['value'] = 'Opslaan'; 
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Input($tmp_args_ar);

            return $form_elements_ar;

        }
        
        static private function getFieldSets(){

            $fieldset_ar['Nieuwe Training'] = array(
                'name',
                'is_for_group_1',
                'is_for_group_2',
                'duration_in_mins',
                'theme',
                'supplies',
                'description',
                'btn_submit',
            );

            $form_elements_ar = self::getFormElements();

            foreach($fieldset_ar as $title => $input_names_ar){
                $legend = HTML::Legend($title);
                $elements_ar = array();
                foreach($form_elements_ar as $key => $input){
                    if(in_array($key, $input_names_ar)){
                        $elements_ar[] = $input;
                    }
                }
                $return_ar[] = HTML::Fieldset($legend.implode('', $elements_ar));
            }
            return implode('', $return_ar);
        }

        static private function getForm(){
            $fieldset_ar = self::getFieldSets();
            return HTML::Form($fieldset_ar);
        }
        
        static public function handleFormPost($posted_values = array()){
            if(empty($posted_values)){ return Bootstrap::Alert('Geen gegevens meegegeven', 'danger');}
        }
        
        static private function getJquery(){
            ob_start();
            ?>
            <script>
                $(document).ready(function(){
                    //handle formpost
                    var submit_button = $('#btn_submit');
                    submit_button.on('submit', function(e){
                        e.preventDefault();
                    });
                });
            </script>
            <?php
            return ob_get_clean();
        }
    }
?>