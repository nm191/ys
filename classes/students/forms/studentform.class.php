<?php
    class Students_Forms_StudentForm{

        static public function get(){
            $return_ar[] = self::getForm();
            $return_ar[] = self::getJquery();

            return implode('', $return_ar);
        }

        static private function getForm(){
            $fieldset_ar = self::getFieldSets();
            return HTML::Form($fieldset_ar.self::getSubmitButton(), 'new_student_form', '');
        }

        static private function getSubmitButton(){
            //submit
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'submit';
            $tmp_args_ar['name'] = 'btn_submit'; 
            $tmp_args_ar['id'] = 'btn_submit'; 
            $tmp_args_ar['class'] = 'btn btn-success'; 
            $tmp_args_ar['value'] = 'Opslaan'; 
            return HTML::Input($tmp_args_ar);
        }

        static private function getFormElements(){
            //first_name
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'text'; 
            $tmp_args_ar['label'] = 'Voornaam:';  
            $tmp_args_ar['name'] = 'first_name'; 
            $tmp_args_ar['id'] = 'first_name'; 
            $tmp_args_ar['class'] = 'form-control'; 
            $tmp_args_ar['required'] = 'true'; 
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Input($tmp_args_ar);

            //last_name
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'text'; 
            $tmp_args_ar['label'] = 'Achternaam:';  
            $tmp_args_ar['name'] = 'last_name'; 
            $tmp_args_ar['id'] = 'last_name'; 
            $tmp_args_ar['class'] = 'form-control'; 
            $tmp_args_ar['required'] = 'true'; 
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Input($tmp_args_ar);

            //date_of_birth
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'date'; 
            $tmp_args_ar['label'] = 'Geboorte datum:';  
            $tmp_args_ar['name'] = 'date_of_birth'; 
            $tmp_args_ar['id'] = 'date_of_birth'; 
            $tmp_args_ar['class'] = 'form-control'; 
            $tmp_args_ar['required'] = 'true'; 
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Input($tmp_args_ar);

            //street_name
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'text'; 
            $tmp_args_ar['label'] = 'Straatnaam:';  
            $tmp_args_ar['name'] = 'street_name'; 
            $tmp_args_ar['id'] = 'street_name'; 
            $tmp_args_ar['class'] = 'form-control'; 
            $tmp_args_ar['required'] = 'true'; 
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Input($tmp_args_ar);

             //house_number
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'text'; 
            $tmp_args_ar['label'] = 'Huisnummer:';  
            $tmp_args_ar['name'] = 'house_number'; 
            $tmp_args_ar['id'] = 'house_number'; 
            $tmp_args_ar['class'] = 'form-control'; 
            $tmp_args_ar['required'] = 'true'; 
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Input($tmp_args_ar);

             //zipcode
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'text'; 
            $tmp_args_ar['label'] = 'Postcode:';  
            $tmp_args_ar['name'] = 'zipcode'; 
            $tmp_args_ar['id'] = 'zipcode'; 
            $tmp_args_ar['class'] = 'form-control'; 
            $tmp_args_ar['required'] = 'true'; 
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Input($tmp_args_ar);

             //place
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'text'; 
            $tmp_args_ar['label'] = 'Plaats:';  
            $tmp_args_ar['name'] = 'place'; 
            $tmp_args_ar['id'] = 'place'; 
            $tmp_args_ar['class'] = 'form-control'; 
            $tmp_args_ar['required'] = 'true'; 
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Input($tmp_args_ar);

            //first_name_dad
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'text'; 
            $tmp_args_ar['label'] = 'Voornaam vader:';  
            $tmp_args_ar['name'] = 'first_name_dad'; 
            $tmp_args_ar['id'] = 'first_name_dad'; 
            $tmp_args_ar['class'] = 'form-control'; 
            $tmp_args_ar['required'] = 'true'; 
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Input($tmp_args_ar);

            //last_name_dad
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'text'; 
            $tmp_args_ar['label'] = 'Achternaam vader:';  
            $tmp_args_ar['name'] = 'last_name_dad'; 
            $tmp_args_ar['id'] = 'last_name_dad'; 
            $tmp_args_ar['class'] = 'form-control'; 
            $tmp_args_ar['required'] = 'true'; 
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Input($tmp_args_ar);

            //email_dad
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'text'; 
            $tmp_args_ar['label'] = 'Email vader:';  
            $tmp_args_ar['name'] = 'email_dad'; 
            $tmp_args_ar['id'] = 'email_dad'; 
            $tmp_args_ar['class'] = 'form-control'; 
            $tmp_args_ar['required'] = 'true'; 
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Input($tmp_args_ar);

            //telephone_dad
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'text'; 
            $tmp_args_ar['label'] = 'Telefoonnummer vader:';  
            $tmp_args_ar['name'] = 'telephone_dad'; 
            $tmp_args_ar['id'] = 'telephone_dad'; 
            $tmp_args_ar['class'] = 'form-control'; 
            $tmp_args_ar['required'] = 'true'; 
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Input($tmp_args_ar);

            //first_name_mom
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'text'; 
            $tmp_args_ar['label'] = 'Voornaam moeder:';  
            $tmp_args_ar['name'] = 'first_name_mom'; 
            $tmp_args_ar['id'] = 'first_name_mom'; 
            $tmp_args_ar['class'] = 'form-control'; 
            $tmp_args_ar['required'] = 'true'; 
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Input($tmp_args_ar);

            //last_name_mom
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'text'; 
            $tmp_args_ar['label'] = 'Achternaam moeder:';  
            $tmp_args_ar['name'] = 'last_name_mom'; 
            $tmp_args_ar['id'] = 'last_name_mom'; 
            $tmp_args_ar['class'] = 'form-control'; 
            $tmp_args_ar['required'] = 'true'; 
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Input($tmp_args_ar);

            //email_mom
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'text'; 
            $tmp_args_ar['label'] = 'Email moeder:';  
            $tmp_args_ar['name'] = 'email_mom'; 
            $tmp_args_ar['id'] = 'email_mom'; 
            $tmp_args_ar['class'] = 'form-control'; 
            $tmp_args_ar['required'] = 'true'; 
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Input($tmp_args_ar);

            //telephone_mom
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'text'; 
            $tmp_args_ar['label'] = 'Telefoonnummer moeder:';  
            $tmp_args_ar['name'] = 'telephone_mom'; 
            $tmp_args_ar['id'] = 'telephone_mom'; 
            $tmp_args_ar['class'] = 'form-control'; 
            $tmp_args_ar['required'] = 'true'; 
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Input($tmp_args_ar);

            //allergies
            $tmp_args_ar = array();
            $tmp_args_ar['label'] = 'Allergieen';  
            $tmp_args_ar['name'] = 'allergies'; 
            $tmp_args_ar['id'] = 'allergies'; 
            $tmp_args_ar['class'] = 'form-control'; 
            $form_elements_ar[$tmp_args_ar['name']] = HTML::TextArea($tmp_args_ar);

            //medicine
            $tmp_args_ar = array();
            $tmp_args_ar['label'] = 'Medicijnen';  
            $tmp_args_ar['name'] = 'medicine'; 
            $tmp_args_ar['id'] = 'medicine'; 
            $tmp_args_ar['class'] = 'form-control'; 
            $form_elements_ar[$tmp_args_ar['name']] = HTML::TextArea($tmp_args_ar);

            return $form_elements_ar;
        }

        static private function getFieldsets(){
            $fieldset_ar['Leerling'] = array(
                'first_name',
                'last_name',
                'date_of_birth',
                'street_name',
                'house_number',
                'zipcode',
                'place'
            );

            $fieldset_ar['Ouders/Verzorgers'] = array(
                'first_name_dad',
                'last_name_dad',
                'email_dad',
                'telephone_dad',
                'first_name_mom',
                'last_name_mom',
                'email_mom',
                'telephone_mom',
            );

            $fieldset_ar['Bijzonderheden'] = array(
                'allergies',
                'medicine'
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
        
        static private function getJquery(){
            ob_start();
            ?>
            <script>
                $(document).ready(function(){
                    //handle_form_post
                    var form = $('#new_student_form');
                    form.on('submit', function(e){
                        e.preventDefault();
                        console.log('submitted');
                    });
                });
            </script>
            <?php
            return ob_get_clean();
        }
    }
?>