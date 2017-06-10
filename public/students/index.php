<?php
    include '../includes/header.php';

    //get current page name / set default page name
    if(isset($_GET['page'])){
        $current_page_name = $_GET['page'];
    }else{
        $current_page_name = 'students_overview';
    }

    $show_tabmenu = true;
    switch($current_page_name){
        case 'students_overview':
            $page_content_ar[] = 'Genereer training';
            break;
        case 'add_student':
            $page_content_ar[] = Students_Forms_StudentForm::get();
            break;
        default:
            $page_content_ar[] = ErrorPages::get404();
            break;
    }

    if($show_tabmenu){
        echo Students_Tabmenu::get($current_page_name);
    }
    echo implode('', $page_content_ar);
?>


<?php
    include '../includes/footer.php';
?>