<?php
    class Trainings_Forms_ExerciseForm{

        const FORM_NAME = 'exercise_form';

        static private $exercise = null;

        static public function get(Trainings_Models_ExerciseModel &$exercise){
            //init variables
            self::$exercise = &$exercise;

            // var_dump(self::$exercise);
            $return_ar[] = HTML::Div('','','alert_container');
            $return_ar[] = self::getForm();
            $return_ar[] = self::getJquery();

            return implode('', $return_ar);
        }

        static private function getForm(){
            $fieldset_ar = self::getFieldSets();
            return HTML::Form($fieldset_ar.self::getSubmitButton(), self::FORM_NAME, '');
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
            //name
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'text'; 
            $tmp_args_ar['label'] = 'Opdracht Naam';  
            $tmp_args_ar['name'] = 'name'; 
            $tmp_args_ar['id'] = 'name'; 
            $tmp_args_ar['class'] = 'form-control'; 
            $tmp_args_ar['required'] = 'true'; 
            $tmp_args_ar['value'] = (self::$exercise->id ? self::$exercise->records_ar->$tmp_args_ar['name']: ''); 
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Div(HTML::Input($tmp_args_ar), '', 'input-field');

            //theme_id
            $tmp_args_ar = array();
            $tmp_args_ar['label'] = 'Thema';  
            $tmp_args_ar['name'] = 'theme_id'; 
            $tmp_args_ar['id'] = 'theme_id'; 
            $tmp_args_ar['class'] = 'form-control'; 
            $tmp_args_ar['required'] = 'true'; 
            $tmp_args_ar['empty_first_value'] = true; 
            $tmp_args_ar['selected'] = (self::$exercise->id ? self::$exercise->records_ar->$tmp_args_ar['name'] : 0);
            $tmp_args_ar['options'] = array(0 => 'Selecteer...') + DB_Trainings_Themes::getList();
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Div(HTML::Select($tmp_args_ar), '', 'input-field');

            //exercise_type_id
            $tmp_args_ar = array();
            $tmp_args_ar['label'] = 'Soort';  
            $tmp_args_ar['name'] = 'exercise_type_id'; 
            $tmp_args_ar['id'] = 'exercise_type_id'; 
            $tmp_args_ar['class'] = 'form-control'; 
            $tmp_args_ar['required'] = 'true'; 
            $tmp_args_ar['empty_first_value'] = true; 
            $tmp_args_ar['selected'] = (self::$exercise->id ? self::$exercise->records_ar->$tmp_args_ar['name'] : '');
            $tmp_args_ar['options'] = array(0 => 'Selecteer...') + DB_Trainings_ExerciseTypes::getList();
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Div(HTML::Select($tmp_args_ar), '', 'input-field');

            //length
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'number'; 
            $tmp_args_ar['label'] = 'Duur (minuten)';  
            $tmp_args_ar['name'] = 'length'; 
            $tmp_args_ar['id'] = 'length'; 
            $tmp_args_ar['class'] = 'form-control'; 
            $tmp_args_ar['required'] = 'true'; 
            $tmp_args_ar['value'] = (self::$exercise->id ? self::$exercise->records_ar->$tmp_args_ar['name'] : '');
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Div(HTML::Input($tmp_args_ar), '', 'input-field');

            //sets
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'number'; 
            $tmp_args_ar['label'] = 'Aantal sets';  
            $tmp_args_ar['name'] = 'sets'; 
            $tmp_args_ar['id'] = 'sets'; 
            $tmp_args_ar['class'] = 'form-control'; 
            $tmp_args_ar['value'] = (self::$exercise->id ? self::$exercise->records_ar->$tmp_args_ar['name'] : '');
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Div(HTML::Input($tmp_args_ar), '', 'input-field');

            //reps
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'number'; 
            $tmp_args_ar['label'] = 'Aantal reps';  
            $tmp_args_ar['name'] = 'reps'; 
            $tmp_args_ar['id'] = 'reps'; 
            $tmp_args_ar['class'] = 'form-control'; 
            $tmp_args_ar['value'] = (self::$exercise->id ? self::$exercise->records_ar->$tmp_args_ar['name'] : '');
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Div(HTML::Input($tmp_args_ar), '', 'input-field');
            
            //description
            $tmp_args_ar = array();
            $tmp_args_ar['label'] = 'Omschrijving';  
            $tmp_args_ar['name'] = 'description'; 
            $tmp_args_ar['id'] = 'description'; 
            $tmp_args_ar['class'] = 'form-control materialize-textarea'; 
            $tmp_args_ar['value'] = (self::$exercise->id ? self::$exercise->records_ar->$tmp_args_ar['name'] : '');
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Div(HTML::TextArea($tmp_args_ar), '', 'input-field');

            //equipment
            $tmp_args_ar = array();
            $tmp_args_ar['label'] = 'Benodigdheden';  
            $tmp_args_ar['name'] = 'equipment'; 
            $tmp_args_ar['id'] = 'equipment'; 
            $tmp_args_ar['class'] = 'form-control materialize-textarea'; 
            $tmp_args_ar['value'] = (self::$exercise->id ? self::$exercise->records_ar->$tmp_args_ar['name'] : '');
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Div(HTML::TextArea($tmp_args_ar), '', 'input-field');

            //record_id
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'hidden';   
            $tmp_args_ar['name'] = 'record_id'; 
            $tmp_args_ar['id'] = 'record_id'; 
            $tmp_args_ar['class'] = 'form-control'; 
            $tmp_args_ar['value'] = (self::$exercise->id ? self::$exercise->id : 0);
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Input($tmp_args_ar);

            return $form_elements_ar;
        }

        static private function getFieldsets(){
            $fieldset_ar['Opdracht'] = array(
                'name',
                'theme_id',
                'exercise_type_id',
                'length',
                'sets',
                'reps',
                'description',
                'equipment'
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
                    var form = $('#<?= self::FORM_NAME ?>');
                    form.on('submit', function(e){
                        e.preventDefault();
                        var data  = $(this).serializeArray();

                        var serialized = $('input:checkbox').map(function() {
                            return { name: this.name, value: this.checked ? this.value : 0 };
                            });

                        var data = $.merge(data, serialized);

                        $.ajax({
                            url: '<?= "http://".PUBLIC_ROOT."trainings/?page=ajax_handle_exercise_form_post" ?>',
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