<?php
error_reporting(E_ALL & ~E_NOTICE);
$title = strtoupper ($_REQUEST['title']);// Read the title from the web and capitalize it

/* If the title is empty, change it to %. Otherwise put % in the front and end of the title. % is the
wildcard character in SQL. By putting % in front and back it means we are looking for any occurrence of
that word in the title.*/
if (strlen($title) == 0){
    $title= '%';
}
else{
    $title='%'.$title. '%';
}
$sort=$_REQUEST ['sort'];

$mydb = new PDO( 'mysql:host=localhost; dbname=id21168513_12596790','id21168513_12596790','Rajitha@1975');//Connect to the database

/*The SQL statement. NOTE THE EMPTY SPACE BEFORE THE QUOTES AND THE PERIOD AT THE
END OF EACH LINE. They are important. Note the sort variable embedded in the query. This is actually
a security risk. Unfortunately, at this time, PDO does not easily allow parameters to be passed to an
order by clause.*/
$stmt=$mydb->prepare("SELECT book.isbn, title, author_first, author_last, ".
                    "listprice, discount, book.category_code, category_name ".
                    "FROM book ".
                    "inner join writes ".
                    "on book.isbn=writes.isbn ".
                    "inner join author ".
                    "on writes.authorid=author.author_id ".
                    "inner join bookcat on book.category_code=bookcat.category_code ".
                    "where upper(title) like :thetitle ".
                    "order by ".$sort.", isbn, authororder"
                    );
                    
/*Run the SQL query using title in place of the parameter thetitle. By rights, we should do this with sort, but PDO does not allow this*/
$stmt->execute([":thetitle"=>$title]);
//echo var_dump($stmt->errorInfo());->tells the error in PDO
$result=$stmt->fetchAll();//Retrieve the SQL results into a PHP variable called result
echo json_encode ($result);//Convert result to JSON and send it to whoever requested it.
?>