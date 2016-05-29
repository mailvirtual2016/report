
<?php 
    //<!--СТАНДАРТНЫЙ НАБОР ПРИ СТАРТЕ-->
    include_once("mainstart.php"); 
    include_once("connectbook.php");  
    $comment = $_POST['comment'];
    $search  = $_POST['search'];

   // МЕТКА ПО КОТОРОЙ ВЫВОДИМ КНИГИ
   if (isset($_GET['id']))
   {  $tip = $_GET['id'];  }
   if ($tip == '') { $tip = 'main'; }

   // Удаляем ненужные символы 
   $comment =  str_replace("'", "", $comment);
   $search  =  str_replace("'", "", $search);
   $tip     =  str_replace("'", "", $tip);


   $comment =  str_replace('"', '', $comment);
   $search  =  str_replace('"', '', $search);
   $tip     =  str_replace('"', '', $tip);

   

    // Если указали коментарий 
    if (isset($_POST['comment']))
    {
        if ($comment <> '')
	{
        	$query = "INSERT INTO comment (name,tip) VALUES ('".$comment."','" .$tip. "')";
		$res = mysql_query($query) ;
		if ($res == 'true')   { include_once("protokol_ok.php"); }  else { include_once("protokol_error.php");}	  // Протокол выявления ошибок
	}
    }






  
?> 

<!DOCTYPE html>
<html lang="ru">
<head>
    <?php $title = 'Библиотека';         ?> 
    <?php echo '<title>'.$title.'</title>' ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<!--ОТСЛЕЖИВАНИЕ ЗАГРУЗКИ СТРАНИЦЫ YANDEX, GOOGLE-->
<?php $protokol = 'Баблиотека'; include_once("analyticstracking.php") ?>
        <!--НАЧАЛО ШАПКИ-->
        <!--КОНЕЦ ШАПКИ-->
        <!--НАЧАЛО ОСНОВНОГО БЛОКА-->
	<?php 
            


        // Муравьиная дорожка
	echo ( '<a href="books.php">'.'БИБЛИОТЕКА'.'</a>');
        $userstable = "books";



	// Выводим список книг по пораметру вывода -->>
	echo ('<BR>');
	echo ('<BR>');
        
        if ($res == 'true')   { include_once("protokol_ok.php"); }  else { include_once("protokol_error.php");}
  	$userstable = "books";
  	$query = "SELECT * FROM $userstable WHERE vi_label_in = '".$tip."'";
        $res = mysql_query($query) ; 
	if ($res == 'true')   { include_once("protokol_ok.php"); }  else { include_once("protokol_error.php");}	  // Протокол выявления ошибок
        while ($row=mysql_fetch_array($res)) 
        {
        	if ($row[vi_label_out] == '')
		{
			echo ($row[vi_name]);
		}
		else
		{
			echo ( '<a href="books.php?id='.$row[vi_label_out].'">'.$row[vi_name].'</a>');
			echo ( '<BR>');
		}
       }
	// Выводим список книг по пораметру вывода <<--



	// Блок получения коментарий и поиска -->>
	echo ('<form action="books.php?id='.$tip.'"  method="post" >');
?>  
	<BR>
        коментарий
	<textarea  name = "comment" rows="14" ></textarea>	
	<BR>
        <BR>	
        Поиск
	<input  name = "search"   type="text" >
	<BR>
	<button>OK</button>
	</form>

<?php
	// выводим коментарии по данному блоку
	echo ( '<BR>');               
        echo 'Комментарий';
	echo '<BR>';
	$userstable = "comment";
	$query = "SELECT * FROM $userstable WHERE tip = '".$tip."'";
        $res = mysql_query($query) ;
	if ($res == 'true')   { include_once("protokol_ok.php"); }  else { include_once("protokol_error.php");}	  // Протокол выявления ошибок 
	$nomer = 0;
        while ($row=mysql_fetch_array($res)) 
        {
		$nomer = $nomer +1;
		echo ( $nomer.')  '.$row[name]);
		echo ( '<BR>');       }

	// БЛОК ПОИСКА

		echo ( '<BR>');       
		echo ( '<BR>');       


	if (isset($_POST['search']))
	{
	if ($search <> '')
	{
	echo '<BR>';
	echo '<BR>';
        echo 'Результат поиска';
	echo '<BR> ';
	$userstable = "books";
	$query = "SELECT * FROM $userstable WHERE vi_name Like '%".$search."%'";
        $res = mysql_query($query) ; 
	if ($res == 'true')   { include_once("protokol_ok.php"); }  else { include_once("protokol_error.php");}	  // Протокол выявления ошибок
	$nomer = 0;
	echo ( '<BR>');
        while ($row=mysql_fetch_array($res)) 
        {
		$nomer = $nomer +1;
		echo ( $nomer.'<a href="books.php?id='.$row[vi_label_out].'">'.$row[vi_name].'</a>');
		echo ( '<BR>');       }
	}
	}



?> 



        <!--Блок получения коментарий и поиска <<-- -->


        <!--КОНЕЦ  ОСНОВНОГО БЛОКА-->
        <!--НАЧАЛО ПОДВАЛ-->
	<!--КОНЕЦ ПОДВАЛ-->
        <script src="script/jquery-1.10.2.min.js"></script>
</body>
</html>














	



