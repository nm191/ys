<?php
    class Admin_Users_Forms_UserForm{

        static private $user = null;

        static public function get(Admin_Users_Models_UserModel &$user){
            //init variables
            self::$user = &$user;
            // dd::show(self::$user);
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
            //name
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'text'; 
            $tmp_args_ar['label'] = 'Naam:';  
            $tmp_args_ar['name'] = 'name'; 
            $tmp_args_ar['id'] = 'name'; 
            $tmp_args_ar['class'] = 'form-control'; 
            $tmp_args_ar['required'] = 'true'; 
            $tmp_args_ar['value'] = (self::$user->id ? self::$user->records_ar->name : ''); 
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Input($tmp_args_ar);

            //shorname
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'text'; 
            $tmp_args_ar['label'] = 'Initialen:';  
            $tmp_args_ar['name'] = 'short_name'; 
            $tmp_args_ar['id'] = 'short_name'; 
            $tmp_args_ar['class'] = 'form-control'; 
            $tmp_args_ar['required'] = 'true'; 
            $tmp_args_ar['value'] = (self::$user->id ? self::$user->records_ar->short_name : ''); 
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Input($tmp_args_ar);

            //password
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'password'; 
            $tmp_args_ar['label'] = 'Wachtwoord:';  
            $tmp_args_ar['name'] = 'password'; 
            $tmp_args_ar['id'] = 'password'; 
            $tmp_args_ar['class'] = 'form-control'; 
            $tmp_args_ar['required'] = 'true'; 
            // $tmp_args_ar['value'] = (self::$user->id ? self::$user->records_ar->first_name : ''); 
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Input($tmp_args_ar);

            //email
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'email'; 
            $tmp_args_ar['label'] = 'E-Mail:';  
            $tmp_args_ar['name'] = 'email'; 
            $tmp_args_ar['id'] = 'email'; 
            $tmp_args_ar['class'] = 'form-control'; 
            $tmp_args_ar['required'] = 'true'; 
            $tmp_args_ar['value'] = (self::$user->id ? self::$user->records_ar->email : ''); 
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Input($tmp_args_ar);

            //user_id
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'hidden';   
            $tmp_args_ar['name'] = 'user_id'; 
            $tmp_args_ar['id'] = 'user_id'; 
            $tmp_args_ar['class'] = 'form-control'; 
            $tmp_args_ar['value'] = (self::$user->id ? self::$user->records_ar->id : 0);
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Input($tmp_args_ar);

            return $form_elements_ar;
        }

        static private function getFieldsets(){
            $fieldset_ar['Gebruiker'] = array(
                'name',
                'short_name',
                'email',
                'password',
                'user_id',
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

                        $.ajax({
                            url: '<?= "http://".PUBLIC_ROOT."admin/users/?page=ajax_handle_form_post" ?>',
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