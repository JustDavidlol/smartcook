<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="navrh3.css">
    <title>Recipe</title>
    <style>
       .button {
        display: flex;
        margin-top: 20px;
        font-family: "Fredoka", sans-serif;
        font-size: 30px;
        text-shadow:rgb(166, 117, 26) 2px 1px 2px;
        background-color: #e19e23;
        border-radius: 10px;
        position: absolute;
        border: 2px solid #ae7a1a;
        padding: 10px;
       }

       .button :hover {
        background-color: #f5ad27;
        padding: 5px;
        transition: 0.3s;
        
       }
        
       .foodborder {
        text-shadow:rgb(166, 117, 26) 2px 1px 2px;
        background-color: #e19e23;
        border-radius: 10px;
        font-family: "Fredoka", sans-serif;
        font-size: 50px;
        text-align: center;
       }
       .nameborder {
        text-shadow:rgb(166, 117, 26) 2px 1px 2px;
        background-color: #e19e23;
        border-radius: 10px;
        font-family: "Fredoka", sans-serif;
        font-size: 30px;
        text-align: center;
       }

       p {
        font-family: "JetBrains Mono-MediumItalic", Helvetica;
       }

       .tabulka {
        font-family: "JetBrains Mono-MediumItalic", Helvetica;
        background-color: #e19e23;
        border-radius: 10px;
        margin: 20px;
        padding: 20px;
        border: 2px solid #ae7a1a;
       }
       
    </style>
</head>
<body>
    <div class="recipe-container">
        <?php
        $name = isset($_GET['name']) ? $_GET['name'] : '';
        $author = isset($_GET['author']) ? $_GET['author'] : '';

        if (!empty($name) && !empty($author)) {
            echo "<div class='foodborder'>$name</div>";
            echo "<div class='nameborder'>By $author</p>";
        } else {
            echo "<p>Recipe not found.</p>";
        }
        ?>
    </div>

    <ul>
        <?php
        require_once("SmartCookClient.php");    

        try {
            $data=(new SmartCookClient)
                ->setRequestData(["recipe_id" => $_GET["id"]])
                ->sendRequest("recipe")
                ->getResponseData();
        } catch (Exception $e) {
            echo $e->getMessage();
        }   
        
        echo "<div class='tabulka'>";
        $obtiznost= array(1=>" low difficulty"," medium difficulty", "high difficulty");
        echo "<li>".$obtiznost[$data["data"]["difficulty"]]."</li>";
        echo "<li>".$data["data"]["duration"]." min</li>";
        $cena= array(1=>" cheap"," medium", " expensive");
        echo "<li>".$cena[$data["data"]["price"]]."</li>";
        echo "<li>".$data["data"]["description"]."</li>";
        echo "<li>".$data["data"]["country"]."</li>";
        echo "dish category: <ul>";
        foreach($data["data"]["dish_category"] as $i){echo "<li>".$i."</li>";}
        echo "</ul>recipe category:<ul>";
        foreach($data["data"]["recipe_category"] as $i){echo "<li>".$i."</li>";}
        echo "</ul>tolerance: <ul>";
        foreach($data["data"]["tolerance"] as $i){echo "<li>".$i."</li>";}
        echo "</ul>ingredients: <ul>";
        foreach($data["data"]["ingredient"] as $i){echo "<li>".$i["name"]."</li>";}
        echo "</ul>";
        echo "</div>";
        ?>

        
    </ul>
    <div class="button-container">
        <div class="button" onclick="goBack()"><a href="#"  style="color: black; text-decoration: none;">Back</a></div>
    </div>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
