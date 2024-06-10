<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="navrh3.css">
    <title>SmartCook</title>
</head>
<body>

    <div class="box"><div class="rectangle"></div></div>
    <div class="image"><img class="food" src="food.png"></div>
    <div class="label"><div class="text-wrapper">Smart</div></div>
    <div class="label1"><div class="text-wrapper1">Cook</div></div>
    <div class="circle"><div class="ellipse"></div></div>
    <div class="circle1"><div class="ellipse1"></div></div>

    <div class="container1">
        <table>
            <tr>
            <th>Difficulty</th>
            <th>Category</th>
            <th>Recipe Category</th>
            <th>Price</th>
            <th>Tolerance</th>
            </tr>
            <tr>
            <td>
                <select name="difficulty" id="difficulty">
                <option value="easy">Easy</option>
                <option value="medium">Medium</option>
                <option value="hard">Hard</option>
                </select>
            </td>
            <td>
                <select name="recipe-category" id="recipe-category">
                <option value="breakfast">Breakfast</option>
                <option value="soup">Soup</option>
                <option value="main course">Main Course</option>
                <option value="dessert">Dessert</option>
                <option value="dinner">Dinner</option>
                </select>
            </td>
            <td>
                <select name="category" id="category">
                    <option value="soup">Soup</option>
                    <option value="meat">Meat</option>
                    <option value="meatfree">Meatfree</option>
                    <option value="dessert">Dessert</option>
                    <option value="sauce">Sauce</option>
                    <option value="pasta">Pasta</option>
                    <option value="salad">Salad</option>
                    <option value="sweet food">Sweet Food</option>
                    <option value="drink">Drink</option>
                </select>
            </td>
            <td>
                <select name="price" id="price">
                <option value="cheap">Cheap</option>
                <option value="medium">Medium</option>
                <option value="expensive">Expensive</option>
                </select>
            </td>
            <td>
                <select name="tolerance" id="tolerance">
                    <option value="vegetarian">Vegetarian</option>
                    <option value="vegan">Vegan</option>
                    <option value="nuts">Nuts</option>
                    <option value="gluten">Gluten</option>
                    <option value="lactose">Lactose</option>
                    <option value="spicy">Spicy</option>
                    <option value="alcohol">Alcohol</option>
                    <option value="sea food">Sea food</option>
                    <option value="mushrooms">Mushrooms</option>
                </select>
            </td>
            </tr>
        </table>
    </div>

<?php
    require_once("SmartCookClient.php");

    $request_data = [
        "attributes" => ["id", "name", "author"],
        "filter" => [
            "author" => [],
            "dish_category" => [],
        ]
    ];

    try {
        $client = new SmartCookClient();
        $response = $client->setRequestData($request_data)->sendRequest("recipes")->getResponseData();

        echo "<div class='recipe-container' style='display: flex; flex-wrap: wrap; justify-content: space-around;'>"; 
        foreach ($response['data'] as $recipe) {
            echo "<div class='recipe-box' onclick='showRecipe(\"{$recipe['name']}\", \"{$recipe['author']}\", \"{$recipe['id']}\")'>"; 
            echo "<h2>" . $recipe['name'] . "</h2>";
            echo "<p>Author: " . $recipe['author'] . "</p>";
            echo "</div>";
        }
        echo "</div>";

    } catch (Exception $e) {
        echo $e->getMessage();
    }
?>

<footer>
    <p>2024 Smartcook</p>
</footer>

<style>
    h2 {
        font-weight: bolder;
        font-family: "Fredoka", sans-serif;
        font-size: 30px;
        text-shadow:rgb(166, 117, 26) 2px 1px 2px;
    }

    p {
        font-family: "Fredoka", sans-serif;
    }

    .recipe-box {
            background-color: #e19e23;
            padding: 20px;
            margin: 10px;
            border-radius: 10px;
            width: calc(20% - 20px); 
            text-align: center;
        }
    .recipe-container :hover {
        background-color: #f5ad27; transition: 0.3s;
    }

        .label .text-wrapper {
    position: fixed;
    width: 154px;
    top: 0;
    left: 120px;
    font-family: "JetBrains Mono-MediumItalic", Helvetica;
    font-weight: 500;
    font-style: italic;
    color: #ffffff;
    font-size: 36px;
    letter-spacing: 0;
    line-height: normal;
    text-shadow: 2px 1px 2px rgb(0, 0, 0);
}



  
  .label1 .text-wrapper1 {
    position: fixed;
    width: 132px;
    top: 30px;
    left: 100px;
    font-family: "Josefin Slab-SemiBoldItalic", Helvetica;
    font-weight: 600;
    font-style: italic;
    color: #ffffff;
    font-size: 36px;
    letter-spacing: 0;
    line-height: normal;
    text-shadow: 2px 1px 2px rgb(0, 0, 0);

}

    
</style>

</body>
</html>


