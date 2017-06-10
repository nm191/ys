<?php
    class HTML{

        //FORMS
        static public function Input($args){
            $label = '';
            if(isset($args['label'])){
                $label = '<label for="'.$args['id'].'">'.$args['label'].'</label>';
                unset($args['label']);
            }

            foreach($args as $key => $value){
                $formatted_args_ar[] = $key.'="'.$value.'"';
            }

            $return_ar[] = $label;
            $return_ar[] = '<input '.implode(' ', $formatted_args_ar).'>';

            return self::Div(implode('', $return_ar), '', 'form-group');
        }

        static public function TextArea($args){
             $label = '';
            if(isset($args['label'])){
                $label = '<label for="'.$args['id'].'">'.$args['label'].'</label>';
                unset($args['label']);
            }

            foreach($args as $key => $value){
                $formatted_args_ar[] = $key.'="'.$value.'"';
            }

            $return_ar[] = $label;
            $return_ar[] = '<textarea '.implode(' ', $formatted_args_ar).'></textarea>';

            return self::Div(implode('', $return_ar), '', 'form-group');
        }

        static public function Select($args){
            if(!isset($args['options'])){
                return false;
            }

            $label = '';
            if(isset($args['label'])){
                $label = '<label for="'.$args['id'].'">'.$args['label'].'</label>';
                unset($args['label']);
            }
            $options_ar = array();
            foreach($args['options'] as $key => $value){
                $options_ar[] = '<option value="'.$key.'">'.$value.'</option>';
            }
            unset($args['options']);

            foreach($args as $key => $value){
                $formatted_args_ar[] = $key.'="'.$value.'"';
            }

            $return_ar[] = $label;
            $return_ar[] = '<select '.implode(' ', $formatted_args_ar).'>'.implode('', $options_ar).'</select>';

            return self::Div(implode('', $return_ar), '', 'form-group');
        }

        static public function Fieldset($content, $id = '', $class = ''){
            return '<fieldset '.($id ? 'id="'.$id.'" ' : '').($class ? 'class="'.$class.'"' : '').'>'.$content.'</fieldset>';
        }

        static public function Legend($content, $id = '', $class = ''){
            return '<legend '.($id ? 'id="'.$id.'" ' : '').($class ? 'class="'.$class.'"' : '').'>'.$content.'</legend>';
        }

        static public function Form($content, $id = '', $class = ''){
            return '<form '.($id ? 'id="'.$id.'" ' : '').($class ? 'class="'.$class.'"' : '').'>'.$content.'</form>';
        }

        //DIVS
        static public function Div($content, $id = '', $class = ''){
            return '<div '.($id ? 'id="'.$id.'" ' : '').($class ? 'class="'.$class.'"' : '').'>'.$content.'</div>';
        }
    }
?>