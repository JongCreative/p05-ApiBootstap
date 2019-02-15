<?php

$curl = curl_init();
$search_string = $_POST['Search'];
//$search_string = 'beans';

$apiURL = 'https://api.edamam.com/search?app_id=cfca78b9&app_key=79da0322fff417e5a405406191c0b605&q=' . $search_string . '&to=9';

//echo '<br/><br/>';
//var_dump($apiURL);
//echo '<hr/>';

curl_setopt($curl, CURLOPT_URL, $apiURL);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec ($curl); 


//echo '<br/><br/>';
//var_dump($result);
//echo '<br/><br/>';

//convert json value to string
$recipeObject = json_decode($result);
//array inception begins here!
// close cURL resource, and free up system resources
curl_close($curl);

//hits in this api means all recipes found
//within the hit [0]array (there is only one) 
//var_dump($recipeObject -> hits[0] -> recipe -> image);
//echo '<hr/>';

//$ingredientLines = json_encode($recipeObject -> hits[0] -> recipe -> ingredientLines);
//echo '<article class="wrapper-apiCard">';
//echo '<h3> will this work? </h3>';
//var_dump ($ingredientLines);
//echo '<hr/>';
//echo '</article>';


/* 
for($i = 0; $i < count($recipeObject -> hits); $i++) {
    echo '<article class="apiCard-wrapper">';
    echo '<section>';
    echo '<img src="'. $recipeObject -> hits[$i] -> recipe -> image .'"/>';
    echo '<br /><br/>';
    echo '</section>';
    echo '</article>';
} */

//same as above but more neat & readable, 
//name each $recipeObject result as $recipe
/* if (!isset($_POST['submit'])) {
    foreach ($recipeObject -> hits as $recipe) {
        echo '<article class="w3ls-add-grids wrapper-apiCard">';
        echo '<section class="apiCard card-head">';
        echo '<div class="card-head1 card-head1-2">';
        echo '<h3>' . $recipe -> recipe -> label . '</h3>';
        foreach ($recipe -> recipe -> ingredientLines as $ingredientsALL) {
            echo $ingredientsALL;
        };
        echo '<hr/></div>';
//        echo '<div class="card-head1 card-head2-2">';
//        echo '<h3>NEEDS TO BE dynamic: </h3>'. $ingredientLines;
//        echo '</div>';
        echo '</section>';
        echo '<section class="apiCard card-body">';
        echo '<img src="'. $recipe -> recipe -> image .'"/>';
        echo '<h6>see recipe now<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></h6>';
        echo '</section>';
        echo '</article>';
        
    }
} else {
    echo 'let us know what youre looking for';
}

?> */

/* foreach ($recipeObject -> hits as $recipe) {
    echo '<div class="w3ls-add-grids wrapper-apiCard" style="background-image: url('. $recipe -> recipe -> image .')">';
    echo '<a href="menu.php"> ';
    echo '<h4>mMmmm.. <span><br>' . $recipe -> recipe -> label . '</span></h4>';
    echo '<h6>see recipe now Now <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></h6>';
    echo '</a>';
    echo '</div>';
} */
foreach ($recipeObject -> hits as $recipe) {
    echo '<div class="w3ls-add-grids" style="background-image: url('. $recipe -> recipe -> image .')">';
    echo '<a href="singleRecipe.php?recipe_id=' . $recipe -> recipe -> uri . '"> ';
    echo '<h4>mMmmm.. <span><br>' . $recipe -> recipe -> label . '</span></h4>';
    echo '<h6>Get me the recipe! <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></h6>';
    echo '</a>';
    echo '<p>' ;
    foreach($recipe -> recipe -> ingredientLines as $ingredientsALL){
        echo $ingredientsALL;
    };
    echo '</p>';
    echo '</div>';
}

?>