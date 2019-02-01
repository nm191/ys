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

            return implode('', $return_ar);
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
            $return_ar[] = '<textarea '.implode(' ', $formatted_args_ar).'>'.(!empty($args['value']) ? $args['value']: '').'</textarea>';

            return self::Div(implode('', $return_ar), '', 'form-group');
        }

        static public function Select($args){
            if(!isset($args['options'])){
                return false;
            }

            if(!isset($args['empty_first_value'])){
                $args['empty_first_value'] = false;
            }

            $label = '';
            if(isset($args['label'])){
                $label = '<label for="'.$args['id'].'">'.$args['label'].'</label>';
                unset($args['label']);
            }
            $options_ar = array();
            foreach($args['options'] as $key => $value){
                if($args['empty_first_value'] && $key == 0){
                    $options_ar[] = '<option value=""'.($args['selected'] == $key ? 'selected' : '').   '>'.$value.'</option>';
                }else{
                    $options_ar[] = '<option value="'.$key.'"'.($args['selected'] == $key ? 'selected' : '').   '>'.$value.'</option>';
                }
                
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

        //TABLES
        static public function Table($content, $id = '', $class = ''){
            return '<table '.($id ? 'id="'.$id.'" ' : '').($class ? 'class="'.$class.'"' : '').'>'.$content.'</table>';
        }

        static public function Thead($content, $id = '', $class = ''){
            return '<thead '.($id ? 'id="'.$id.'" ' : '').($class ? 'class="'.$class.'"' : '').'>'.$content.'</thead>';
        }

        static public function Tbody($content, $id = '', $class = ''){
            return '<tbody '.($id ? 'id="'.$id.'" ' : '').($class ? 'class="'.$class.'"' : '').'>'.$content.'</tbody>';
        }

        static public function Tr($content, $id = '', $class = ''){
            return '<tr '.($id ? 'id="'.$id.'" ' : '').($class ? 'class="'.$class.'"' : '').'>'.$content.'</tr>';
        }

        static public function Td($content, $id = '', $class = ''){
            return '<td '.($id ? 'id="'.$id.'" ' : '').($class ? 'class="'.$class.'"' : '').'>'.$content.'</td>';
        }

        static public function Th($content, $id = '', $class = ''){
            return '<th '.($id ? 'id="'.$id.'" ' : '').($class ? 'class="'.$class.'"' : '').'>'.$content.'</th>';
        }

        static public function A($content, $args, $id = '', $class = ''){
            $formatted_args_ar = array();
            foreach($args as $key => $value){
                $formatted_args_ar[] = $key.'="'.$value.'"';
            }
            $return_ar[] = '<a '.($id ? 'id="'.$id.'" ' : '').($class ? 'class="'.$class.'"' : '').' '.implode(' ', $formatted_args_ar).'>'.$content.'</a>';

            return implode('', $return_ar);
        }

        static public function P($content, $id = '', $class = ''){
            return '<p '.($id ? 'id="'.$id.'" ' : '').($class ? 'class="'.$class.'"' : '').'>'.$content.'</p>';
        }

        static public function H1($content, $id = '', $class = ''){
            return '<h1 '.($id ? 'id="'.$id.'" ' : '').($class ? 'class="'.$class.'"' : '').'>'.$content.'</h1>';
        }

        static public function H2($content, $id = '', $class = ''){
            return '<h2 '.($id ? 'id="'.$id.'" ' : '').($class ? 'class="'.$class.'"' : '').'>'.$content.'</h2>';
        }

        static public function H3($content, $id = '', $class = ''){
            return '<h3 '.($id ? 'id="'.$id.'" ' : '').($class ? 'class="'.$class.'"' : '').'>'.$content.'</h3>';
        }

        static public function H4($content, $id = '', $class = ''){
            return '<h4 '.($id ? 'id="'.$id.'" ' : '').($class ? 'class="'.$class.'"' : '').'>'.$content.'</h4>';
        }

        static public function H5($content, $id = '', $class = ''){
            return '<h5 '.($id ? 'id="'.$id.'" ' : '').($class ? 'class="'.$class.'"' : '').'>'.$content.'</h5>';
        }

    }
?>