<?php
    session_start();
    include($_SERVER['DOCUMENT_ROOT'].'/ys/classes/config.php');

    //get current page name / set default page name
    if(isset($_GET['page'])){
        $current_page_name = $_GET['page'];
        unset($_GET['page']);
    }else{
        $current_page_name = 'trainings_overview';
    }

    $get_params_to_models_ar = array('exercise' => 'Trainings_Models_ExerciseModel');
    $models_ar = [];
    
    foreach($get_params_to_models_ar as $param_name => $model_name){
        if(isset($_GET[$param_name.'_id'])){
            $models_ar[$param_name] = new $model_name($_GET[$param_name.'_id']);
        }else{
            $models_ar[$param_name] = new $model_name(0);
        }
    }
    
    $filter_ar = [];
    foreach($_GET as $field_name => $field_value){
        $filter_ar[$field_name] = $field_value;
    }
    
    $show_tabmenu = true;
    switch($current_page_name){
        case 'add_exercise':
            $page_content_ar[] = Trainings_Forms_ExerciseForm::get($models_ar['exercise']);
            break;
        case 'exercises_overview':
            $page_content_ar[] = Trainings_Tables_ExercisesTable::get();
            break;
        case 'ajax_handle_exercise_form_post':
            if(empty($_POST)){
                die(Bootstrap::Alert('Error: geen data meegegeven', 'danger'));
            }
            $field_values_ar = [];
            foreach($_POST as $field_name => $field_value){
                if(empty($_POST[$field_name])){ continue;}
                $field_values_ar[$field_name] = trim($field_value);
            }
            $id = DB_Trainings_Exercises::store($field_values_ar);
            if($id){
                die(Bootstrap::Alert('Gelukt! De gegevens zijn successvol toegevoegd!', 'teal white-text'));
            }else{
                die(Bootstrap::Alert('Helaas! Er ging iets mis met het opslaan van de gegevens.', 'red white-text'));
            }
            break;
        case 'ajax_delete_training':
            if(!isset($_GET['record_id'])){die(false);}
            die(DB_Trainings_Exercises::delete($_GET['record_id']));
        default:
            $page_content_ar[] = ErrorPages::get404();
            break;
    }
?>


<?php
    include '../includes/header.php';
    if($show_tabmenu){
        echo Trainings_Tabmenu::get($current_page_name);
    }
    echo implode('', $page_content_ar);
    include '../includes/footer.php';
?>