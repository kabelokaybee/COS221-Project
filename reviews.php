<html>
        <head>
            <title>Reviews</title>
            <link rel="stylesheet" href="css/reviews.css">
            <link rel="stylesheet" href="css/homepage.css">
        </head>
        <body>
        <!--     -->
        <style>
        /* Apply CSS styles to the button */
        button.back-button {
            background-color: red;
            color: white;
            padding: 10px 20px;
            position: fixed;
            top: 10px;
            left: 10px;
        }
        </style>

        <!-- Button HTML with "back-button" class -->
        <button class="back-button" onclick="window.location.href = 'Wines.php';">Back</button>
<?php
session_start();



// Output the back button HTML
// echo '<button onclick="window.location.href = \'' . $previousPage . '\';">Back</button>';
// Check if a wine ID is provided as a query parameter
if (isset($_GET['wine'])) {
    // Retrieve and decode the wine data from the query parameter
    $wineData = json_decode(urldecode($_GET['wine']), true);
    // Retrieve this wine's reviews
    $curl = curl_init();
    $url = "https://wheatley.cs.up.ac.za/u22491032/COS221_Website/globals/api.php";
    $data = json_encode([
        'type' => 'Review',
        'WineID' => $wineData['WineID']
    ]);
    // Set the cURL options
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    // Set the basic authorization header
    $username = 'u22491032';
    $password = 'Dycroc911$';
    curl_setopt($curl, CURLOPT_USERPWD, "$username:$password");

    // Execute the request and get the response
    $response = curl_exec($curl);
    
    // Decode the response JSON
    $responseData = json_decode($response, true);
    echo "<script>console.log(".$data.")</script>";
    
    // Check if the response contains the data property
    if (isset($responseData['data'])) {
        $comments = $responseData['data'];
        
        // Display the review page content
        echo '
        <div id="car-section"><!--Parent-->
          <div class="review-wrapper">
            <div class="review">
                <div>
                    <img class="wineimage" src="' . $wineData['Image'] . '" alt="' . $wineData['Name'] . '">
                </div>
                <div class="properties">
                    <h2>' . $wineData['Name'] . '</h2>
                    <h3>' . $wineData['Grape_Varietal'] . '</h3>
                    <p>Price: R' . $wineData['Price'] . '</p>
                    <p>Bottle Size: ' . $wineData['Bottle_Size'] . 'ml</p>
                    <p>pH: ' . $wineData['pH'] . '</p>
                    <p>Alcohol Content: ' . $wineData['Alcohol_Content'] . '%</p>
                    <p>Region: ' . $wineData['RegionName'] . ', ' . $wineData['Country'] . '</p>
                </div>
            </div>
          </div>
        </div>
            <!-- Add more review content as needed -->
            <div id="comments-section">
                <h2>Comments</h2>
                <div id="comments-list">';
        
            // Iterate over the comments and display them
            
            if(count($comments)!=0){
                foreach ($comments as $comment) {
                    echo '<div class="comment">';
                    echo '<div class="comment-author">' . $comment['Name'] .' '. $comment['Surname'] .  '</div>';
                    echo '<div class="comment-author">' . $comment['Rating'] . '</div>';
                    echo '<div class="comment-content">' . $comment['Comment'] . '</div>';
                    echo '</div>';
                }
            }else{
                echo '<div class="comment">';
                echo '<div class="comment-author">No Comments. Be the first to Comment</div>';
                echo '</div>';
            }
        
            if (isset($_SESSION['UserID'])){
                echo '<div>
                <form id="comment-form" method="POST" onsubmit=postComment(event)>
                    <textarea id="comment-text" name="comment" placeholder="Write a comment"></textarea>
                    <input type="hidden" id="wine_id" name="wine_id" value="' . $wineData['WineID'] . '">
                    <label for="rating-slider">Rating:</label>
                    <input type="range" id="rating-slider" name="rating" min="1" max="10" value="5">
                    <button type="submit">Post Comment</button>
                </form>
                </div>
                </body>
                <script>
                    function postComment(event) {
                        event.preventDefault(); // Prevent the form from submitting normally

                        var commentText = document.getElementById("comment-text").value;
                        var wineID = document.getElementById("wine_id").value;
                        var rating = document.getElementById("rating-slider").value;
                        let request = new XMLHttpRequest();
                        var commentData = {
                            type: "insertReview",
                            Comment: commentText,
                            WineID: wineID,
                            Rating: rating,
                            UserID: "'.$_SESSION['UserID'].'"
                        };
                        commentData = JSON.stringify(commentData);
                        console.log(commentData);
                        var url = "https://wheatley.cs.up.ac.za/u22491032/COS221_Website/globals/api.php";
                        request.open("POST",url,false);
                        request.setRequestHeader("Content-type", "application/json");
                        request.onreadystatechange = function(){
                            if(request.readyState==4 && request.status == 200){
                                console.log("Comment Review added");
                                location.reload();
                            }else{
                                console.log("Error:"+request.responseText.message);
                            }
                        }
                        request.send(commentData);
                    }
                </script>
                </html>';
            }
            else
            {
                $_SESSION['UserID'] = null;
                echo '<div>Login to review a wine</div>';
            }
        
        ;
    } else {
        echo '<h2>Error: Invalid response format</h2>';
        // Handle the error accordingly
    }
} else {
    echo '<h2>Error: Wine data not provided.</h2>';
}
?>