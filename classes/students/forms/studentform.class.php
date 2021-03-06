<?php
    class Students_Forms_StudentForm{

        static private $student = null;

        static public function get(Students_Models_StudentModel &$student){
            //init variables
            self::$student = &$student;

            // var_dump(self::$student);
            $return_ar[] = HTML::Div('','','alert_container');
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
            $tmp_args_ar['label'] = 'Voornaam';  
            $tmp_args_ar['name'] = 'first_name'; 
            $tmp_args_ar['id'] = 'first_name'; 
            $tmp_args_ar['class'] = 'form-control'; 
            $tmp_args_ar['required'] = 'true'; 
            $tmp_args_ar['value'] = (self::$student->id ? self::$student->records_ar->first_name : ''); 
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Div(HTML::Input($tmp_args_ar), '', 'input-field');

            //last_name
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'text'; 
            $tmp_args_ar['label'] = 'Achternaam';  
            $tmp_args_ar['name'] = 'last_name'; 
            $tmp_args_ar['id'] = 'last_name'; 
            $tmp_args_ar['class'] = 'form-control'; 
            $tmp_args_ar['required'] = 'true'; 
            $tmp_args_ar['value'] = (self::$student->id ? self::$student->records_ar->last_name : '');
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Div(HTML::Input($tmp_args_ar), '', 'input-field');

            //date_of_birth
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'date'; 
            $tmp_args_ar['label'] = 'Geboortedatum';  
            $tmp_args_ar['name'] = 'date_of_birth'; 
            $tmp_args_ar['id'] = 'date_of_birth'; 
            $tmp_args_ar['class'] = 'form-control'; 
            // $tmp_args_ar['required'] = 'true'; 
            $tmp_args_ar['value'] = (self::$student->id ? self::$student->records_ar->date_of_birth : '');
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Input($tmp_args_ar);

            //street_name
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'text'; 
            $tmp_args_ar['label'] = 'Straatnaam';  
            $tmp_args_ar['name'] = 'street_name'; 
            $tmp_args_ar['id'] = 'street_name'; 
            $tmp_args_ar['class'] = 'form-control'; 
            // $tmp_args_ar['required'] = 'true'; 
            $tmp_args_ar['value'] = (self::$student->id ? self::$student->records_ar->street_name : '');
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Div(HTML::Input($tmp_args_ar), '', 'input-field');

             //house_number
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'text'; 
            $tmp_args_ar['label'] = 'Huisnummer';  
            $tmp_args_ar['name'] = 'house_number'; 
            $tmp_args_ar['id'] = 'house_number'; 
            $tmp_args_ar['class'] = 'form-control'; 
            // $tmp_args_ar['required'] = 'true'; 
            $tmp_args_ar['value'] = (self::$student->id ? self::$student->records_ar->house_number : '');
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Div(HTML::Input($tmp_args_ar), '', 'input-field');

             //zipcode
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'text'; 
            $tmp_args_ar['label'] = 'Postcode';  
            $tmp_args_ar['name'] = 'zipcode'; 
            $tmp_args_ar['id'] = 'zipcode'; 
            $tmp_args_ar['class'] = 'form-control'; 
            // $tmp_args_ar['required'] = 'true'; 
            $tmp_args_ar['value'] = (self::$student->id ? self::$student->records_ar->zipcode : '');
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Div(HTML::Input($tmp_args_ar), '', 'input-field');

             //place
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'text'; 
            $tmp_args_ar['label'] = 'Plaats';  
            $tmp_args_ar['name'] = 'place'; 
            $tmp_args_ar['id'] = 'place'; 
            $tmp_args_ar['class'] = 'form-control'; 
            // $tmp_args_ar['required'] = 'true'; 
            $tmp_args_ar['value'] = (self::$student->id ? self::$student->records_ar->place : '');
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Div(HTML::Input($tmp_args_ar), '', 'input-field');

             //group_id
            $tmp_args_ar = array();
            $tmp_args_ar['label'] = 'Groep';  
            $tmp_args_ar['name'] = 'group_id'; 
            $tmp_args_ar['id'] = 'group_id'; 
            $tmp_args_ar['class'] = 'form-control'; 
            $tmp_args_ar['required'] = 'true'; 
            $tmp_args_ar['empty_first_value'] = true; 
            $tmp_args_ar['selected'] = (self::$student->id ? self::$student->records_ar->group_id : '');
            $tmp_args_ar['options'] = array(0 => 'Selecteer...') + DB_Students_Groups::getList();
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Div(HTML::Select($tmp_args_ar), '', 'input-field');

            //contest_group
            $tmp_args_ar = array();
            // $tmp_args_ar['label'] = 'Wedstrijdgroep?';  
            $tmp_args_ar['type'] = 'checkbox';  
            $tmp_args_ar['name'] = 'contest_group'; 
            $tmp_args_ar['id'] = 'contest_group'; 
            $tmp_args_ar['class'] = 'form-control'; 
            $tmp_args_ar['value'] = 1; 
            if(self::$student->id && self::$student->records_ar->contest_group == 1){
                $tmp_args_ar['checked'] = true;
            }
            // $tmp_args_ar['checked'] = (self::$student->id && self::$student->records_ar->contest_group == 1 ? self::$student->records_ar->contest_group : false);
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Div('<label for="contest_group">'.HTML::Input($tmp_args_ar).'<span>Wedstrijd Groep?</label><br>', '', 'input-field');

            //contest_group
            $tmp_args_ar = array();
            // $tmp_args_ar['label'] = 'Huur Materiaal?';  
            $tmp_args_ar['type'] = 'checkbox';  
            $tmp_args_ar['name'] = 'has_rental_equipment'; 
            $tmp_args_ar['id'] = 'has_rental_equipment'; 
            $tmp_args_ar['class'] = 'form-control'; 
            $tmp_args_ar['value'] = 1; 
            if(self::$student->id && self::$student->records_ar->has_rental_equipment == 1){
                $tmp_args_ar['checked'] = true;
            }
            // $tmp_args_ar['checked'] = (self::$student->id && self::$student->records_ar->has_rental_equipment == 1 ? self::$student->records_ar->has_rental_equipment :  false);
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Div('<label for="has_rental_equipment">'.HTML::Input($tmp_args_ar).'<span>Huur Materiaal?</label><br>', '', 'input-field');

            //first_name_dad
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'text'; 
            $tmp_args_ar['label'] = 'Voornaam vader';  
            $tmp_args_ar['name'] = 'first_name_dad'; 
            $tmp_args_ar['id'] = 'first_name_dad'; 
            $tmp_args_ar['class'] = 'form-control'; 
            // $tmp_args_ar['required'] = 'true'; 
            $tmp_args_ar['value'] = (self::$student->id ? self::$student->records_ar->first_name_dad : '');
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Div(HTML::Input($tmp_args_ar), '', 'input-field');

            //last_name_dad
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'text'; 
            $tmp_args_ar['label'] = 'Achternaam vader';  
            $tmp_args_ar['name'] = 'last_name_dad'; 
            $tmp_args_ar['id'] = 'last_name_dad'; 
            $tmp_args_ar['class'] = 'form-control'; 
            // $tmp_args_ar['required'] = 'true'; 
            $tmp_args_ar['value'] = (self::$student->id ? self::$student->records_ar->last_name_dad : '');
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Div(HTML::Input($tmp_args_ar), '', 'input-field');

            //email_dad
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'text'; 
            $tmp_args_ar['label'] = 'Email vader';  
            $tmp_args_ar['name'] = 'email_dad'; 
            $tmp_args_ar['id'] = 'email_dad'; 
            $tmp_args_ar['class'] = 'form-control'; 
            // $tmp_args_ar['required'] = 'true'; 
            $tmp_args_ar['value'] = (self::$student->id ? self::$student->records_ar->email_dad : '');
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Div(HTML::Input($tmp_args_ar), '', 'input-field');

            //telephone_dad
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'text'; 
            $tmp_args_ar['label'] = 'Telefoonnummer vader';  
            $tmp_args_ar['name'] = 'telephone_dad'; 
            $tmp_args_ar['id'] = 'telephone_dad'; 
            $tmp_args_ar['class'] = 'form-control'; 
            // $tmp_args_ar['required'] = 'true'; 
            $tmp_args_ar['value'] = (self::$student->id ? self::$student->records_ar->telephone_dad : '');
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Div(HTML::Input($tmp_args_ar), '', 'input-field');

            //first_name_mom
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'text'; 
            $tmp_args_ar['label'] = 'Voornaam moeder';  
            $tmp_args_ar['name'] = 'first_name_mom'; 
            $tmp_args_ar['id'] = 'first_name_mom'; 
            $tmp_args_ar['class'] = 'form-control'; 
            // $tmp_args_ar['required'] = 'true'; 
            $tmp_args_ar['value'] = (self::$student->id ? self::$student->records_ar->first_name_mom : '');
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Div(HTML::Input($tmp_args_ar), '', 'input-field');

            //last_name_mom
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'text'; 
            $tmp_args_ar['label'] = 'Achternaam moeder';  
            $tmp_args_ar['name'] = 'last_name_mom'; 
            $tmp_args_ar['id'] = 'last_name_mom'; 
            $tmp_args_ar['class'] = 'form-control'; 
            // $tmp_args_ar['required'] = 'true'; 
            $tmp_args_ar['value'] = (self::$student->id ? self::$student->records_ar->last_name_mom : '');
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Div(HTML::Input($tmp_args_ar), '', 'input-field');

            //email_mom
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'text'; 
            $tmp_args_ar['label'] = 'Email moeder';  
            $tmp_args_ar['name'] = 'email_mom'; 
            $tmp_args_ar['id'] = 'email_mom'; 
            $tmp_args_ar['class'] = 'form-control'; 
            // $tmp_args_ar['required'] = 'true'; 
            $tmp_args_ar['value'] = (self::$student->id ? self::$student->records_ar->email_mom : '');
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Div(HTML::Input($tmp_args_ar), '', 'input-field');

            //telephone_mom
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'text'; 
            $tmp_args_ar['label'] = 'Telefoonnummer moeder';  
            $tmp_args_ar['name'] = 'telephone_mom'; 
            $tmp_args_ar['id'] = 'telephone_mom'; 
            $tmp_args_ar['class'] = 'form-control'; 
            // $tmp_args_ar['required'] = 'true'; 
            $tmp_args_ar['value'] = (self::$student->id ? self::$student->records_ar->telephone_mom : '');
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Div(HTML::Input($tmp_args_ar), '', 'input-field');

            //registration_date
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'date'; 
            $tmp_args_ar['label'] = 'Inschrijfdatum';  
            $tmp_args_ar['name'] = 'registration_date'; 
            $tmp_args_ar['id'] = 'registration_date'; 
            $tmp_args_ar['class'] = 'form-control'; 
            // $tmp_args_ar['required'] = 'true'; 
            $tmp_args_ar['value'] = (self::$student->id ? self::$student->records_ar->registration_date : '');
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Input($tmp_args_ar);

            //allergies
            $tmp_args_ar = array();
            $tmp_args_ar['label'] = 'Allergieen';  
            $tmp_args_ar['name'] = 'allergies'; 
            $tmp_args_ar['id'] = 'allergies'; 
            $tmp_args_ar['class'] = 'form-control materialize-textarea'; 
            $tmp_args_ar['value'] = (self::$student->id ? self::$student->records_ar->allergies : '');
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Div(HTML::TextArea($tmp_args_ar), '', 'input-field');

            //medicine
            $tmp_args_ar = array();
            $tmp_args_ar['label'] = 'Medicijnen';  
            $tmp_args_ar['name'] = 'medicine'; 
            $tmp_args_ar['id'] = 'medicine'; 
            $tmp_args_ar['class'] = 'form-control materialize-textarea'; 
            $tmp_args_ar['value'] = (self::$student->id ? self::$student->records_ar->medicine : '');
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Div(HTML::TextArea($tmp_args_ar), '', 'input-field');

            //medicine
            $tmp_args_ar = array();
            $tmp_args_ar['label'] = 'Overige opmerkingen';  
            $tmp_args_ar['name'] = 'remark'; 
            $tmp_args_ar['id'] = 'remark'; 
            $tmp_args_ar['class'] = 'form-control materialize-textarea'; 
            $tmp_args_ar['value'] = (self::$student->id ? self::$student->records_ar->remark : '');
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Div(HTML::TextArea($tmp_args_ar), '', 'input-field');

             //student_id
             $tmp_args_ar = array();
             $tmp_args_ar['type'] = 'hidden';   
             $tmp_args_ar['name'] = 'student_id'; 
             $tmp_args_ar['id'] = 'student_id'; 
             $tmp_args_ar['class'] = 'form-control'; 
             $tmp_args_ar['value'] = (self::$student->id ? self::$student->records_ar->id : 0);
             $form_elements_ar[$tmp_args_ar['name']] = HTML::Input($tmp_args_ar);

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
                'place',
                'group_id',
                'contest_group',
                'has_rental_equipment',
                'registration_date'
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
                'medicine',
                'remark',
                'student_id'
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
                        var data  = $(this).serializeArray();

                        var serialized = $('input:checkbox').map(function() {
                            return { name: this.name, value: this.checked ? this.value : 0 };
                            });

                        var data = $.merge(data, serialized);

                        $.ajax({
                            url: '<?= "http://".PUBLIC_ROOT."students/?page=ajax_handle_form_post" ?>',
                            type: 'POST',
                            data : data
                        }).done(function(result){
                            var container = $('.alert_container'); 
                                container.html(result);
                                container.show();
                                $('html, body').animate({ scrollTop: 0 }, 'fast');
                        });
                    });
                });
            </script>
            <?php
            return ob_get_clean();
        }
    }
?>