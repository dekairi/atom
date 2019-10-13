<?php
if (isset($_POST['form'])) 	{
    $form		= $_POST['form'];
    $data = array();
    $data['form'] = $form;

    $date_=date("d.m.y");
    $time_=date("H:i:s");

    
    $mail_from = "vrem1209@ya.ru";
    $mail_to = "vrem1209@ya.ru";
    $mail_subject = "Заявка на обратный звонок или консультацию!";
    $mail_headers = "From: $mail_from \r\n";

    $mail_msg = "<h2>Заявка на обратный звонок или консультацию! </h2>";
    $mail_msg.= "<p><b>Дата и время заявки:</b> $date_ $time_ </p>";

    switch($form){
        case 'present-form':
            if (isset($_POST['fio'])){
                $fio = $_POST['fio'];
                $data['fio'] = $fio;
                $mail_msg.= "<p><b>ФИО:</b> $fio </p>";
            };

            if (isset($_POST['wa'])){
                    $wa = $_POST['wa'];
                    $mail_msg.= "<p><b>Номер What’s App:</b> $wa </p>";
            };
            if (isset($_POST['email'])){
                    $email = $_POST['email'];
                    $mail_msg.= "<p><b>E-mail:</b> $email </p>";
            };
            if (isset($_POST['inst'])){
                    $inst = $_POST['inst'];
                    $mail_msg.= "<p><b>Instagram:</b> $inst </p>";
            };
        break;

        case 'question-form':
            if (isset($_POST['fio'])){
                $fio = $_POST['fio'];
                $data['fio'] = $fio;
                $mail_msg.= "<p><b>ФИО:</b> $fio </p>";
            };
            if (isset($_POST['wa'])){
                $wa = $_POST['wa'];
                $mail_msg.= "<p><b>Номер What’s App:</b> $wa </p>";
        };            
        break;

        case 'payment-smm':
            $default = 10000;$inst_cost = 0;$vk_cost = 0;$tk_cost = 0;$fb_cost = 0;$ok_cost = 0;$dr_cost = 0;
            $brand_cost = 0;$promotion_cost = 0;$target_cost = 0;$fotograph_cost = 0;$videograph_cost = 0;

            $social="";$srv="";$inst = "";$vk = "";$tk = "";$fb = "";$ok = "";$dr = "";
            $brand = "";$promotion = "";$target = "";$fotograph = "";$videograph = "";

            //text
            if (isset($_POST['fio'])) {
                $fio = $_POST['fio'];
                $data['fio'] = $fio;
                $mail_msg.= "<p><b>ФИО:</b> $fio </p>";
            }
            
            if (isset($_POST['wa'])) {
                $wa = $_POST['wa'];
                $mail_msg.= "<p><b>Номер What’s App:</b> $wa </p>";
            }

            if (isset($_POST['post_count'])) {
                $post_count	= $_POST['post_count'];
                $mail_msg.= "<p><b>Приблизительное количество постов в сутки:</b> $post_count </p>";                
            }
            
            //soc
            if (isset($_POST['inst']))          {$inst		    = $_POST['inst'];
                                                 $inst_cost     = 500;
                                                 $social       .= "<li>$inst</li>";}

            if (isset($_POST['vk'])) 	        {$vk		    = $_POST['vk'];
                                                 $vk_cost       = 500;
                                                 $social       .= "<li>$vk</li>";}

            if (isset($_POST['tk'])) 	        {$tk		   = $_POST['tk'];
                                                 $tk_cost      = 500;  
                                                 $social      .= "<li>$tk</li>";}

            if (isset($_POST['fb'])) 	        {$fb		   = $_POST['fb'];
                                                 $fb_cost      = 500;  
                                                 $social      .= "<li>$fb</li>";}
                                                
            if (isset($_POST['ok'])) 	        {$ok		   = $_POST['ok'];
                                                 $ok_cost      = 500;  
                                                 $social      .= "<li>$ok</li>";}

            if (isset($_POST['dr_check'])) 	    {$dr		    = $_POST['dr_text'];
                                                 $dr_cost       = 500;  
                                                 $social       .= "<li>Другое: $dr</li>";}

            if ($social > ''){ $mail_msg.= "<p><b>Выбранные социальные сети:</b> <ul>$social</ul> </p>"; }

            //srv
            if (isset($_POST['answer'])) 	    {$answer		= $_POST['answer'];
                                                 $answer_cost   = 500;  
                                                 $srv          .= "<li>$answer</li>";}

            if (isset($_POST['brand'])) 	    {$brand		    = $_POST['brand'];
                                                 $brand_cost    = 500;  
                                                 $srv          .= "<li>$brand</li>";}

            if (isset($_POST['promotion'])) 	{$promotion		= $_POST['promotion'];
                                                 $promotion_cost= 500;  
                                                 $srv          .= "<li>$promotion</li>";}

            if (isset($_POST['target'])) 	    {$target		= $_POST['target'];
                                                 $target_cost   = 500;  
                                                 $srv          .= "<li>$target</li>";}

            if (isset($_POST['fotograph'])) 	{$fotograph		= $_POST['fotograph'];
                                                 $fotograph_cost= 500;  
                                                 $srv          .= "<li>$fotograph</li>";}

            if (isset($_POST['videograph'])) 	{$videograph	= $_POST['videograph'];
                                                 $videograph_cost= 500;  
                                                 $srv          .= "<li>$videograph</li>";}

            if ($srv > '') { $mail_msg.= "<p><b>Дополнительные услуги:</b> <ul>$srv</ul> </p>"; }

            $cpn_month = $default+$inst_cost+$vk_cost+$tk_cost+$fb_cost+$ok_cost+$dr_cost+$answer_cost+$brand_cost+$promotion_cost+$target_cost+$fotograph_cost+$videograph_cost;
            $cpn_one = round($cpn_month/20,0);

            $cost  = "<li>Ежемесячно: $cpn_month сом</li>";
            $cost .= "<li>Единоразово: $cpn_one сом</li>";

            $mail_msg.= "<p><b>Приблизительная стоимость:</b> <ul>$cost</ul> </p>";

            $data['cpn_month'] = $cpn_month;
            $data['cpn_one'] = $cpn_one;
        break;
    }
   
    mail($mail_to, $mail_subject, $mail_msg, $mail_headers . 'Content-type: text/html; charset=utf-8');

    echo json_encode($data);
}
?>