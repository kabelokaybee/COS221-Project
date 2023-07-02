<?php
    class API_Wines{
        private static $instance = null;
        public $conn;
        public static function getInstance(){
            if(self::$instance === null){
                self::$instance = new self();
            }
            return self::$instance;
        } 
        private function __construct() {
            $servername = "wheatley.cs.up.ac.za";
            $username = "u22492616";
            $password = "SP2ZUCDHYQNAQQKYBZ4XIP7CFRWJEO33";
            $db_name = "u22492616_COS221";
            $this->conn = mysqli_connect($servername, $username, $password, $db_name);
        }
        public function __destruct() {
            mysqli_close($this->conn);
        }
        public function response($success,$message="",$data=""){
            if($success === false){
                header("HTTP/1.1 400 Error");
                header("Content-Type: application/json");
                echo json_encode([
                    "success" => $success,
                    "timestamp" => time(),
                    "message" => $message,
                    "data" => $data
                ]);
            }else{
                header("HTTP/1.1 200 OK");
                header("Content-Type: application/json");
            
                echo json_encode([
                    "success" => $success,
                    "timestamp" => time(),
                    "message" => $message,
                    "data" => $data
                ]);
            }
            
        } 
        //Get Wines function
        public function getWines($data) {
            //Searching of getWines
            $sql = "SELECT Wine.WineID, Wine.Name, Grape_Varietal.VarietalName as Grape_Varietal, Wine.Price, Wine.Bottle_Size, Quality.pH, Quality.Alcohol_Content, Region.RegionName, Region.Country, Wine.Image 
                    FROM Wine INNER JOIN Quality ON Wine.WineID = Quality.WineID 
                    INNER JOIN Winery ON Wine.WIneryID = Winery.WineryID 
                    INNER JOIN Grape_Varietal ON Wine.VarietalID = Grape_Varietal.VarietalID 
                    INNER JOIN Region ON Winery.RegionID = Region.RegionID ";
            if((isset($data->search))){
                $sql .= " Where Wine.Name LIKE '%" .$data->search->Name ."%'"; 
            }
            
            
            if((isset($data->sort))){
                $sql .= " Order by " .$data->sort ." ";
            }
            if((isset($data->order))){
                $sql .= $data->order;
            }
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows>0){
                $this->response(true,"Wines found",$result->fetch_all(MYSQLI_ASSOC));
                exit();
            }else{
                $this->response(true,"No Wines found");
                exit();
            }
        }
        public function getRose($data){
            $sql = "SELECT Wine.Name, Grape_Varietal.VarietalName as Grape_Varietal, Wine.Price, Wine.Bottle_Size, Quality.pH, Quality.Alcohol_Content, Region.RegionName, Region.Country, Rose_Wine.Percentage_Red, Rose_Wine.Percentage_White, Wine.Image 
                    FROM Wine 
                    INNER JOIN Quality ON Wine.WineID = Quality.WineID 
                    INNER JOIN Winery ON Wine.WIneryID = Winery.WineryID 
                    INNER JOIN Grape_Varietal ON Wine.VarietalID = Grape_Varietal.VarietalID 
                    INNER JOIN Rose_Wine ON Wine.WineID = Rose_Wine.WineID 
                    INNER JOIN Region ON Winery.RegionID = Region.RegionID ";
            if((isset($data->search->Name))){
                $sql .= " Where Wine.Name LIKE '%" .$data->search->Name ."%'"; 
            }
            
            
            if((isset($data->sort))){
                $sql .= " Order by " .$data->sort ." ";
            }
            if((isset($data->order))){
                $sql .= $data->order;
            }
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows>0){
                $this->response(true,"Wines found",$result->fetch_all(MYSQLI_ASSOC));
                exit();
            }else{
                $this->response(true,"No Wines found");
                exit();
            }
        }
        public function getRed($data){
            $sql = "SELECT Wine.Name, Grape_Varietal.VarietalName as Grape_Varietal, Wine.Price, Wine.Bottle_Size, Quality.pH, Quality.Alcohol_Content, Region.RegionName, Region.Country, Red_Wine.Tannin, Wine.Image 
                    FROM Wine 
                    INNER JOIN Quality ON Wine.WineID = Quality.WineID 
                    INNER JOIN Winery ON Wine.WIneryID = Winery.WineryID 
                    INNER JOIN Grape_Varietal ON Wine.VarietalID = Grape_Varietal.VarietalID 
                    INNER JOIN Red_Wine ON Wine.WineID = Red_Wine.WineID 
                    INNER JOIN Region ON Winery.RegionID = Region.RegionID ";
            if((isset($data->search->Name))){
                $sql .= " Where Wine.Name LIKE '%" .$data->search->Name ."%'"; 
            }
            
            
            if((isset($data->sort))){
                $sql .= " Order by " .$data->sort ." ";
            }
            if((isset($data->order))){
                $sql .= $data->order;
            }
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows>0){
                $this->response(true,"Wines found",$result->fetch_all(MYSQLI_ASSOC));
                exit();
            }else{
                $this->response(true,"No Wines found");
                exit();
            }
        }
        public function getWhite($data){
            $sql = "SELECT Wine.Name, Grape_Varietal.VarietalName as Grape_Varietal, Wine.Price, Wine.Bottle_Size, Quality.pH, Quality.Alcohol_Content, Region.RegionName, Region.Country, White_Wine.Shade, Wine.Image 
                    FROM Wine 
                    INNER JOIN Quality ON Wine.WineID = Quality.WineID 
                    INNER JOIN Winery ON Wine.WIneryID = Winery.WineryID 
                    INNER JOIN Grape_Varietal ON Wine.VarietalID = Grape_Varietal.VarietalID 
                    INNER JOIN White_Wine ON Wine.WineID = White_Wine.WineID INNER JOIN Region ON Winery.RegionID = Region.RegionID ";
            if((isset($data->search->Name))){
                $sql .= " Where Wine.Name LIKE '%" .$data->search->Name ."%'"; 
            }
            
            
            if((isset($data->sort))){
                $sql .= " Order by " .$data->sort ." ";
            }
            if((isset($data->order))){
                $sql .= $data->order;
            }
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows>0){
                $this->response(true,"Wines found",$result->fetch_all(MYSQLI_ASSOC));
                exit();
            }else{
                $this->response(true,"No Wines found");
                exit();
            }
        }
        public function getDessert($data){
            $sql = "SELECT Wine.Name, Grape_Varietal.VarietalName as Grape_Varietal, Wine.Price, Wine.Bottle_Size, Quality.pH, Quality.Alcohol_Content, Region.RegionName, Region.Country, Dessert_Wine.Style, Wine.Image 
                    FROM Wine 
                    INNER JOIN Quality ON Wine.WineID = Quality.WineID 
                    INNER JOIN Winery ON Wine.WIneryID = Winery.WineryID 
                    INNER JOIN Grape_Varietal ON Wine.VarietalID = Grape_Varietal.VarietalID 
                    INNER JOIN Dessert_Wine ON Wine.WineID = Dessert_Wine.WineID INNER JOIN Region ON Winery.RegionID = Region.RegionID ";
            if((isset($data->search->Name))){
                $sql .= " Where Wine.Name LIKE '%" .$data->search->Name ."%'"; 
            }
            
            
            if((isset($data->sort))){
                $sql .= " Order by " .$data->sort ." ";
            }
            if((isset($data->order))){
                $sql .= $data->order;
            }
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows>0){
                $this->response(true,"Wines found",$result->fetch_all(MYSQLI_ASSOC));
                exit();
            }else{
                $this->response(true,"No Wines found");
                exit();
            }
        }
        public function getSparkling($data){
            $sql = "SELECT Wine.Name, Grape_Varietal.VarietalName as Grape_Varietal, Wine.Price, Wine.Bottle_Size, Quality.pH, Quality.Alcohol_Content, Region.RegionName, Region.Country, Sparkling_Wine.Carbon_Content, Wine.Image 
                    FROM Wine 
                    INNER JOIN Quality ON Wine.WineID = Quality.WineID 
                    INNER JOIN Winery ON Wine.WIneryID = Winery.WineryID 
                    INNER JOIN Grape_Varietal ON Wine.VarietalID = Grape_Varietal.VarietalID 
                    INNER JOIN Sparkling_Wine ON Wine.WineID = Sparkling_Wine.WineID 
                    INNER JOIN Region ON Winery.RegionID = Region.RegionID ";
            if((isset($data->search->Name))){
                $sql .= " Where Wine.Name LIKE '%" .$data->search->Name ."%'"; 
            }
            
            
            if((isset($data->sort))){
                $sql .= " Order by " .$data->sort ." ";
            }
            if((isset($data->order))){
                $sql .= $data->order;
            }
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows>0){
                $this->response(true,"Wines found",$result->fetch_all(MYSQLI_ASSOC));
                exit();
            }else{
                $this->response(true,"No Wines found");
                exit();
            }
        }

        public function login($data){
            $stmt = $this->conn->prepare('SELECT * FROM User Where Email = ?');
            $stmt->bind_param('s', $data->username);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows>0){
                $this->response(true,"User logged In");
                exit();
            }else{
                $this->response(true,"User not found");
                exit();
            }
        } 
        //Get winery ID
        public function getWineryID($data){
            $stmt = $this->conn->prepare('SELECT WineryID FROM Winery Where WineryName = ?');
            $stmt->bind_param('s', $data->name);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows>0){
                $this->response(true,"Winery ID found",$result->fetch_all(MYSQLI_ASSOC));
                exit();
            }else{
                $this->response(true,"Winery ID not found");
                exit();
            }
        }
        public function getVarietalID($data){
            $stmt = $this->conn->prepare('SELECT VarietalID FROM Grape_Varietal Where VarietalName = ?');
            $stmt->bind_param('s', $data->name);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows>0){
                $this->response(true,"Varietal ID found",$result->fetch_all(MYSQLI_ASSOC));
                exit();
            }else{
                $this->response(true,"Varietal ID not found");
                exit();
            }
        }
        public function VarietalID($value){
            $stmt = $this->conn->prepare('SELECT VarietalID FROM Grape_Varietal Where VarietalName = ?');
            $stmt->bind_param('s', $value);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows>0){
                return $result->fetch_all(MYSQLI_ASSOC);
            }else{
                return "Doesn't exist";
            }
        }
        public function getRegionID($value){
            $stmt = $this->conn->prepare('SELECT RegionID FROM Region Where RegionName = ?');
            $stmt->bind_param('s', $value);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows>0){
                return $result->fetch_all(MYSQLI_ASSOC);
            }else{
                return "Doesn't exist";
            }
        }
        public function getWineries($data){
            //Searching of getWines
            $sql = "SELECT Winery.WineryName,Winery.Image,Region.RegionName, Region.Country, Winery.Winemaker, Winery.ProductionSize, Grape_Varietal.VarietalName 
                    FROM Winery 
                    INNER JOIN Region ON Winery.RegionID = Region.RegionID 
                    INNER JOIN Grape_Varietal ON Winery.VarietalID = Grape_Varietal.VarietalID;";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows>0){
                $this->response(true,"Wineries found",$result->fetch_all(MYSQLI_ASSOC));
                exit();
            }else{
                $this->response(true,"No Wineries found");
                exit();
            }
        }
        public function getRegions($data){
            $sql = "SELECT RegionName,Climate,Country,Image FROM Region Order by RegionName ";
            if(isset($data->order)){
                $sql .= $data->order." ";
            }
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows>0){
                $this->response(true,"Regions retrieved",$result->fetch_all(MYSQLI_ASSOC));
                exit();
            }else{
                $this->response(true,"Something went wrong");
                exit();
            }
        }
        public function Review($data){
            $sql = "SELECT User.Name, User.Surname, Reviews.Rating, Reviews.Comment 
            FROM User 
            INNER JOIN Reviews ON User.UserID = Reviews.userID WHERE Reviews.WineID = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('s', $data->WineID);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows>0){
                $this->response(true,"Reviews retrieved",$result->fetch_all(MYSQLI_ASSOC));
                exit();
            }else{
                $this->response(true,"No reviews",[]);
                exit();
            }

        }
        public function addReviews($data) {
            $sql ="SELECT * FROM Reviews WHERE userID = ? AND WineID =? ";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('ss', $data->UserID,$data->WineID);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows>0){
                $sql = "UPDATE Reviews SET Comment =?,Rating =? WHERE userID = ? AND WineID =?";
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param('siss', $data->Comment,$data->Rating,$data->UserID,$data->WineID);
                $stmt->execute();
                // $result = $stmt->get_result();
                if($stmt){
                    $this->response(true,"Review updated",$result->fetch_all(MYSQLI_ASSOC));
                    exit();
                }else{
                    $this->response(false,"Something went wrong");
                    exit();
                }

            }else{
                $sql = "INSERT INTO Reviews (WineID,UserID,Rating,Comment) VALUES (?,?,?,?)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param('ssis', $data->WineID,$data->UserID,$data->Rating,$data->Comment);
                $stmt->execute();
                // $result = $stmt->get_result();
                if($stmt){
                    $this->response(true,"Review added",$result->fetch_all(MYSQLI_ASSOC));
                    exit();
                }else{
                    $this->response(false,"Something went wrong");
                    exit();
                }
            }
        }
        public function AdminLogin($data){
            $stmt = $this->conn->prepare('SELECT * FROM Admin_User Where AdminID = ? AND Password = ? AND Email = ?');
            $stmt->bind_param('sss', $data->adminID,$data->password,$data->username);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows>0){
                $this->response(true,"User logged In");
                exit();
            }else{
                $this->response(false,"Please Enter correct user details");
                exit();
            }

        } 
        public function generateWineID() {
            $prefix = 'W';
            $id = 1;
            $existingIDs = [];
            $stmt = $this->conn->prepare('SELECT WineID FROM Wine');
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $existingIDs[] = $row['WineID'];
                }
            }
            // Find the next available ID
            while (in_array($prefix . str_pad($id, 3, '0', STR_PAD_LEFT), $existingIDs)) {
                $id++;
            }
            // Generate the unique WineID
            $wineID = $prefix . str_pad($id, 3, '0', STR_PAD_LEFT);
            return $wineID;
        }
        private function checkWineExists($value){
            $sql = "SELECT * FROM Wine WHERE Wine.Name = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('s', $value);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows>0){
                return true;
            }else{
                return false;
            }
        }
        private function checkWineryExists($value){
            $sql = "SELECT * FROM Winery WHERE Winery.WineryName = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('s', $value);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows>0){
                return true;
            }else{
                return false;
            }
        }
        private function checkWineID($value){
            $sql = "SELECT * FROM Wine WHERE Wine.WineID = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('s', $value);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows>0){
                return true;
            }else{
                return false;
            }
        }
        public function updateWines($data){
            if($data->price == "" && $data->image == ""){
                $this->response(false,"Missing values");
            }else if($data->image != "" && $data->price != ""){
                $sql = "UPDATE Wine SET Price = ?, Image = ? WHERE WineID = ?";
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param('dss', $data->price,$data->image,$data->wineID);
            }else if($data->image != "" && $data->price == ""){
                $sql = "UPDATE Wine SET Image = ? WHERE WineID = ?";
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param('ss', $data->image,$data->wineID);
            }else if($data->image == "" && $data->price != ""){
                $sql = "UPDATE Wine SET Price = ? WHERE WineID = ?";
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param('ds', $data->price,$data->wineID);
            }
            $stmt->execute();
            $affectedRows = $stmt->affected_rows;
            if ($affectedRows > 0) {
                $this->response(true,"Wine updated");
                exit();
            }else{
                $this->response(false,"Something went wrong");
                exit();
            }
        }
        public function deleteWines($data){
            $sql = "DELETE t1, t2, t3 
                    FROM Wine t1 JOIN Quality t2 ON t1.WineID = t2.WineID JOIN ";
            if(isset($data->wineType)){
                switch(strtolower($data->wineType)){
                    case "red wine":
                        $sql .= "Red_Wine t3 ON t1.WineID = t3.WineID WHERE t1.WineID = ?";
                        break;
                    case "white wine":
                        $sql .= "White_Wine t3 ON t1.WineID = t3.WineID WHERE t1.WineID = ?";
                        break;
                    case "rose wine":
                        $sql .= "Rose_Wine t3 ON t1.WineID = t3.WineID WHERE t1.WineID = ?";
                        break;
                    case "sparkling wine":
                        $sql .= "Sparkling_Wine t3 ON t1.WineID = t3.WineID WHERE t1.WineID = ?";
                        break;
                    case "dessert wine":
                        $sql .= "Dessert_Wine t3 ON t1.WineID = t3.WineID WHERE t1.WineID = ?";
                        break;
                    default:
                        $this->response(false,"Invalid wine type");
                        break;
                }
            }else{
                $this->response(false,"Missing Wine type");
            }
            if(!$this->checkWineID($data->wineID)){
                $this->response(false,"Invalid wine type");
                exit;
            }
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('s', $data->wineID);
            $stmt->execute();
            $affectedRows = $stmt->affected_rows;
            if ($affectedRows > 0) {
                $this->response(true,"Wine deleted");
                exit();
            }else{
                $this->response(false,"Something went wrong in deleting wines");
                exit();
            }
        }
        public function generateWineryID(){
            $prefix = 'WW';
            $id = 1;
            $existingIDs = [];
            $stmt = $this->conn->prepare('SELECT WineryID FROM Winery');
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $existingIDs[] = $row['WineryID'];
                }
            }
            // Find the next available ID
            while (in_array($prefix . str_pad($id, 3, '0', STR_PAD_LEFT), $existingIDs)) {
                $id++;
            }
            // Generate the unique WineID
            $wineID = $prefix . str_pad($id, 3, '0', STR_PAD_LEFT);
            return $wineID;
        }
        public function insertWineries($data){
            if($this->checkWineryExists($data->wineryName)){
                $this->response(false,"Winery already exists");
                exit();
            }
            $wineryID = $this->generateWineryID();
            $varietalID = $this->VarietalID($data->varietal)[0]['VarietalID'];
            $regionID = $this->getRegionID($data->region)[0]['RegionID'];
            $sql = "INSERT INTO Winery (WineryID,WineryName, Licensed, ProductionSize, Vineyard, Winemaker, VarietalID, RegionID,Image)
                    VALUES (?,?,?,?,?,?,?,?,?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('ssissssss',$wineryID,$data->wineryName,$data->licensed,$data->productionSize,$data->vineyard,$data->winemaker,$varietalID,$regionID,$data->image);
            $stmt->execute();
            $affectedRows = $stmt->affected_rows;
            if ($affectedRows > 0) {
                $this->response(true,"Winery inserted");
                exit();
            }else{
                $this->response(false,"Something went wrong");
                exit();
            }
        }
        public function updateWineries($data){
            $sql = "SELECT * FROM Winery WHERE Winery.WineryID = ?";
            $stmt_1 = $this->conn->prepare($sql);
            $stmt_1->bind_param('s', $data->wineryID);
            $stmt_1->execute();
            $result = $stmt_1->get_result();
            if ($result->num_rows > 0) {
                if ($data->productionSize=='' && $data->image=='' && $data->winemaker=='') {
                    $this->response(false, "Nothing to update");
                    exit();
                }
                $sql = "UPDATE Winery SET ";
                $params = array();
                $types = '';
            
                if ($data->productionSize!='') {
                    $sql .= "ProductionSize = ?, ";
                    $params[] = $data->productionSize;
                    $types .= 's';
                }
            
                if ($data->winemaker != '') {
                    $sql .= "Winemaker = ?, ";
                    $params[] = $data->winemaker;
                    $types .= 's';
                }
            
                if ($data->image != '') {
                    $sql .= "Image = ?, ";
                    $params[] = $data->image;
                    $types .= 's';
                }
            
                // Remove the trailing comma and space from the SQL query
                $sql = rtrim($sql, ", ");
            
                // Append the WHERE clause
                $sql .= " WHERE WineryID = ?";
            
                // Add the WineryID parameter
                $params[] = $data->wineryID;
                $types .= 's';
            
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param($types, ...$params);
                $stmt->execute();
                $affectedRows = $stmt->affected_rows;
            
                if ($affectedRows > 0) {
                    $this->response(true, "Winery updated");
                    exit();
                } else {
                    $this->response(false, "Something went wrong");
                    exit();
                }
            }else{
                $this->response(false,"Winery does not exist");
                exit();
            }
            
        }
        public function filterWineries($data){
            $sql = "SELECT Winery.WineryName,Winery.Image,Region.RegionName, Region.Country, Winery.Winemaker, Winery.ProductionSize, Grape_Varietal.VarietalName 
                    FROM Winery
                    INNER JOIN Region ON Winery.RegionID = Region.RegionID 
                    JOIN Grape_Varietal ON Winery.VarietalID = Grape_Varietal.VarietalID
                    WHERE Grape_Varietal.VarietalName = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('s', $data->varietal);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $wines = array();
                while ($row = $result->fetch_assoc()) {
                    $wines[] = $row;
                }
                $this->response(true, "Wines Found",$wines);
                exit();
            } else {
                $this->response(false, "No wines found");
                exit();
            }
        }
        public function deleteWineries($data){
            $checkWineryExists = "SELECT WineryID from Winery Where WineryID = ?";
            $stmt = $this->conn->prepare($checkWineryExists);
            $stmt->bind_param('s',$data->wineryID);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows <= 0) {
                $this->response(false,"Winery doesn't exist");
                exit();
            }
            $checkforWinesWithWineries = "SELECT WIneryID from Wine Where WineryID = ?";
            $stmt = $this->conn->prepare($checkforWinesWithWineries);
            $stmt->bind_param('s',$data->wineryID);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $this->response(true,"Winery has wines associated with it");
                exit();
            }else{
                $sql = "DELETE FROM Winery Where WineryID = ?";
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param('s',$data->wineryID);
                $stmt->execute();
                $affectedRows = $stmt->affected_rows;
                if ($affectedRows > 0) {
                    $this->response(true,"Winery deleted");
                    exit();
                }else{
                    $this->response(false,"Something went wrong");
                    exit();
                }
            }   
        }
        public function insertWines($data){
            if($this->checkWineExists($data->wName)){
                $this->response(false,"Wine already exists");
                exit();
            }
            $wineID = $this->generateWineID();
            $sql = "INSERT INTO Wine(WineID,WIneryID,Name,Price,Bottle_Size,VarietalID,Image)
                    VALUES (?,?,?,?,?,?,?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('sssdiss', $wineID,$data->wWineryID,$data->wName,$data->wPrice,$data->wbottleSize,$data->wVarietalID,$data->wImage);
            $stmt->execute();
            $affectedRows = $stmt->affected_rows;
            if ($affectedRows > 0) {
                switch(strtolower($data->WineType)){
                    case "red wine":
                        $sql = "INSERT INTO Red_Wine(WineID,Tannin)
                                VALUES (?,?)";
                        $stmt = $this->conn->prepare($sql);
                        $stmt->bind_param('si', $wineID,$data->WineTypeValue->Tannin);
                        $stmt->execute();
                        $affectedRows = $stmt->affected_rows;
                        if($affectedRows < 0){
                            $this->response(false,"Something went wrong");
                            exit();
                        }
                        break;
                    case "white wine":
                        $sql = "INSERT INTO White_Wine(WineID,Shade)
                                VALUES (?,?)";
                        $stmt = $this->conn->prepare($sql);
                        $stmt->bind_param('ss', $wineID,$data->WineTypeValue->Shade);
                        $stmt->execute();
                        $affectedRows = $stmt->affected_rows;
                        if($affectedRows < 0){
                            $this->response(false,"Something went wrong");
                            exit();
                        }
                        break;
                    case "sparkling wine":
                        $sql = "INSERT INTO Sparkling_Wine(WineID,Carbon_Content)
                                VALUES (?,?)";
                        $stmt = $this->conn->prepare($sql);
                        $stmt->bind_param('si', $wineID,$data->WineTypeValue->CarbonContent);
                        $stmt->execute();
                        $affectedRows = $stmt->affected_rows;
                        if($affectedRows < 0){
                            $this->response(false,"Something went wrong");
                            exit();
                        }
                        break;
                    case "rose wine":
                        $sql = "INSERT INTO Rose_Wine(WineID,Percentage_Red,Percentage_White)
                                VALUES (?,?,?)";
                        $stmt = $this->conn->prepare($sql);
                        $stmt->bind_param('sii', $wineID,$data->WineTypeValue->Percentage_Red,$data->WineTypeValue->Percentage_White);
                        $stmt->execute();
                        $affectedRows = $stmt->affected_rows;
                        if($affectedRows < 0){
                            $this->response(false,"Something went wrong");
                            exit();
                        }
                        break;
                    case "dessert wine":
                        $sql = "INSERT INTO Dessert_Wine(WineID,Style)
                                VALUES (?,?)";
                        $stmt = $this->conn->prepare($sql);
                        $stmt->bind_param('ss', $wineID,$data->WineTypeValue->Style);
                        $stmt->execute();
                        $affectedRows = $stmt->affected_rows;
                        if($affectedRows < 0){
                            $this->response(false,"Something went wrong");
                            exit();
                        }
                        break;
                    
                    default:
                        $this->response(false,"Invalid Wine Type entry");
                        exit();
                        break;
                }
                $sql_2 ="INSERT INTO Quality(WineID,Alcohol_Content,Density,Residual_Sugar,Fixed_Acidity,pH)
                         VALUES (?,?,?,?,?,?)";
                $stmt_2 = $this->conn->prepare($sql_2);
                $stmt_2->bind_param('sddddd', $wineID,$data->wAlcoholContent,$data->wDensity,$data->wResidualSugar,$data->wFixedAcidity,$data->wpH);
                $stmt_2->execute();
                $affectedRows = $stmt_2->affected_rows;
                if ($affectedRows > 0) {
                    $this->response(true,"Wine added");
                    exit();
                }else{
                    $this->response(false,"Something went wrong");
                    exit();
                }
            } else {
                $this->response(false, "Something went wrong");
                exit();
            }
        }    
    }
    if($_SERVER['REQUEST_METHOD']==='POST'){
        $API = API_Wines::getInstance();
        $data = json_decode(file_get_contents('php://input'));
        if(isset($data->type)){
            switch($data->type){
                case "getWines":
                    if(isset($data->search->filter)){
                        switch(strtolower($data->search->filter)){
                            //add fortified wine
                            case "red":
                                $API->getRed($data);
                                break;
                            case "white":
                                $API->getWhite($data);
                                break;
                            case "sparkling":
                                $API->getSparkling($data);
                                break;
                            case "rose":
                                $API->getRose($data);
                                break;
                            case "dessert":
                                $API->getDessert($data);
                                break;
                            
                            default:
                                $API->response(false,"Invalid Action");
                                break;
                        }
                    }else{
                        $API->getWines($data);
                        break;
                    }
                    
                case "login":
                    if(!isset($data->username) || !isset($data->password)){
                        $API->response(false,"Please fill in all details");
                        exit();
                    }
                    if(isset($data->adminID)){
                        $API->AdminLogin($data);
                    }else{
                        $API->login($data);
                    }
                    break;
                case "Review":
                    $API->Review($data);
                    break;
                case "getWinery":
                    $API->getWineries($data);
                    break;
                case "getRegions":
                    $API->getRegions($data);
                    break;
                case "getWineryID":
                    $API->getWineryID($data);
                    break;
                case "getVarietalID":
                    $API->getVarietalID($data);
                    break;
                case "insertReview":
                    //Add validation
                    $API->addReviews($data);
                    break;
                case "insertWine":
                    if(isset($data->wName,$data->wPrice,$data->wbottleSize,$data->wImage,$data->wWineryID,$data->wVarietalID,$data->WineType,$data->WineTypeValue)){
                        $API->insertWines($data);
                    }else{
                        $API->response(false,"Missing Parameters");
                    }
                    break;
                case "updateWine":
                    //Add validation
                    if(isset($data->wineID,$data->price,$data->image)){
                        $API->updateWines($data);
                    }else{
                        $API->response(false,"Missing Parameters");
                    }
                    break;
                case "deleteWine":
                    //Add validation
                    if(isset($data->wineID)){
                        $API->deleteWines($data);
                    }else{
                        $API->response(false,"Missing Parameters");
                    }
                    break;
                case "insertWinery":
                    //Add validation
                    if(isset($data->wineryName,$data->licensed,$data->productionSize,$data->vineyard,$data->winemaker,$data->varietal,$data->region,$data->image)){
                        $API->insertWineries($data);
                    }else{
                        $API->response(false,"Missing Parameters");
                    }
                    break;
                case "updateWinery":
                    //Add validation
                    if(isset($data->wineryID,$data->productionSize,$data->winemaker,$data->image)){
                        $API->updateWineries($data);
                    }else{
                        $API->response(false,"Missing Parameters");
                    }
                    break;
                case "deleteWinery":
                    //Add validation
                    if(isset($data->wineryID)){
                        $API->deleteWineries($data);
                    }else{
                        $API->response(false,"Missing Parameters");
                    }
                    break;
                case "FilterWineries":
                    if(isset($data->varietal)){
                        $API->FilterWineries($data);
                    }else{
                        $API->response(false,"Missing Parameters");
                    }
                default:
                    $API->response(false,"Invalid Action");
                    break;
            }
        }else{
            $API->response(false,"Missing Parameters");
        }
    }
?>