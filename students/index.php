<?php
    session_start();
    include($_SERVER['DOCUMENT_ROOT'].'/ys/classes/config.php');

    //get current page name / set default page name
    if(isset($_GET['page'])){
        $current_page_name = $_GET['page'];
        unset($_GET['page']);
    }else{
        $current_page_name = 'students_overview';
    }

    $get_params_to_models_ar = array('student' => 'Students_Models_StudentModel');
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
        case 'students_overview':
            $page_content_ar[] = Students_Tables_StudentsTable::get();
            break;
        case 'add_student':
            $page_content_ar[] = Students_Forms_StudentForm::get($models_ar['student']);
            break;
        case 'presence':
            $page_content_ar[] = Students_Tables_StudentPresenceTable::get($filter_ar);
            break;
        case 'presence_history':
            $page_content_ar[] = Students_Tables_StudentPresenceHistoryTable::get($filter_ar);
            break;
        case 'old_students':
            $page_content_ar[] = Students_Tables_DeletedStudentsTable::get();
            break;
        case 'ajax_set_student_presence_value':
            if(empty($_POST)){
                die(0);
            }
            die(DB_Students_StudentPresence::setPresenceValue($_POST['student_id']));
            break;
        case 'ajax_set_student_field_value':
            if(empty($_POST)){
                die(0);
            }
            die(DB_Students_Students::update($_POST['student_id'], array($_POST['field_name'] => $_POST['field_value'])));
            break;
        case 'ajax_handle_form_post':
            if(empty($_POST)){
                die(Bootstrap::Alert('Error: geen data meegegeven', 'danger'));
            }
            $field_values_ar = [];
            foreach($_POST as $field_name => $field_value){
                if(empty($_POST[$field_name])){ continue;}
                $field_values_ar[$field_name] = trim($field_value);
            }
            $id = DB_Students_Students::store($field_values_ar);
            if($id){
                die(Bootstrap::Alert('Gelukt! De gegevens zijn successvol toegevoegd!', 'teal white-text'));
            }else{
                die(Bootstrap::Alert('Helaas! Er ging iets mis met het opslaan van de gegevens.', 'red white-text'));
            }
            break;
        case 'ajax_delete_student':
            if(!isset($_GET['student_id'])){die(false);}
            die(DB_Students_Students::delete($_GET['student_id']));
            break;
        default:
            $page_content_ar[] = ErrorPages::get404();
            break;
    }
?>


<?php
    include '../includes/header.php';
    if($show_tabmenu){
        echo Students_Tabmenu::get($current_page_name);
    }
    echo implode('', $page_content_ar);
    include '../includes/footer.php';
?>