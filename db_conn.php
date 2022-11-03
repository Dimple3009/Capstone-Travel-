<?php
session_start();

class Connection{
  public $host = "localhost";
  public $user = "root";
  public $password = "";
  public $db_name = "voyager";
  public $conn;
  private $dbc;

  
  public function __construct(){
    $this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->db_name);
  }
  

}

class Register extends Connection{
  public function registration($fname, $lname, $country, $phone, $email, $password, $confirm){
    $duplicate = mysqli_query($this->conn, "SELECT * FROM user WHERE fname = '$fname' OR email = '$email'");
    if(mysqli_num_rows($duplicate) > 0){
      return 10;
      // Username or email has already taken
    }
    else{
      if($password == $confirm){
        $query = "INSERT INTO user VALUES('', '$fname', '$lname', '$country', '$phone', '$email', '$password', '$confirm')";
        mysqli_query($this->conn, $query);
        return 1;
        // Registration successful
      }
      else{
        return 100;
        // Password does not match
      }
    }
  }
}

class Login extends Connection{
  public $id;
  public function login($email, $password){
    $result = mysqli_query($this->conn, "SELECT * FROM user WHERE fname = '$fname' OR email = '$email'");
    $row = mysqli_fetch_assoc($result);
    
    if(mysqli_num_rows($result) > 0){
      if($password == $row["password"]){
        $this->id = $row["id"];
        return 1;
        // Login successful
      }
      else{
        return 10;
        // Wrong password
      }
    }
    else{
      return 100;
      // User not registered
    }
  }

  public function idUser(){
    return $this->id;
  }
}

class Select extends Connection{
  public function selectUserById($id){
    $result = mysqli_query($this->conn, "SELECT * FROM user WHERE id = $id");
    return mysqli_fetch_assoc($result);
  }
}



// class Add_category extends Connection{
//   public function category($category){
//     $duplicate = mysqli_query($this->conn, "SELECT * FROM category WHERE category = '$category'");
//     if(mysqli_num_rows($duplicate) > 0){
//       return 10;
     
//     }
//     else{
     
//         $query = "INSERT INTO category VALUES('', '$category')";
//         mysqli_query($this->conn, $query);
//         return 1;
       
   
      
//     }
//   }
// }

// class Add_products extends Connection{
//   public function products($pname, $price, $quantity, $category, $discription ){
//     $duplicate = mysqli_query($this->conn, "SELECT * FROM products WHERE pname = '$pname'");
//     if(mysqli_num_rows($duplicate) > 0){
//       return 10;
     
//     }
//     else{
     
//         $query = "INSERT INTO products VALUES('', '$pname','$price', '$quantity', '$category', '$discription')";
//         mysqli_query($this->conn, $query);
//         return 1;
       
   
      
//     }
//   }
// }

// class listproduct extends Connection{
//   public function listproduct(){
//   return mysqli_query($this->conn, "SELECT * FROM products ");
   
//     }
//   }

//   class deleteproduct extends Connection{
//     public function deleteproduct($product_id){
//     // return mysqli_query($this->conn, "SELECT * FROM products ");

//     // $product_id_clean = $this->$product_id;
    
//             $query =  mysqli_query($this->conn, "DELETE FROM products WHERE product_id = $product_id ;");
//             // $stmt = mysqli_prepare($this->conn, $query);
//             // mysqli_stmt_bind_param(
//             //     $stmt,
//             //     's',
//             //     $product_id_clean
//             // );
            
//             // $result = mysqli_stmt_execute($stmt);

//             return $query;
     
//       }
//     }

//     class getproduct extends Connection{
//       public function getproduct($product_id){
//       $query =  mysqli_query($this->conn, "SELECT * FROM products WHERE product_id = $product_id ;");
//       return $query;
//     }
//   }


//   class updateproduct extends Connection{
//     public function updateproduct($product_id, $pname, $price, $quantity, $category, $discription){
//        $sql= "UPDATE products SET pname = '$pname', price = '$price', quantity = '$quantity', category = '$category', discription = '$discription' WHERE  product_id = '$product_id';";
//       echo $sql;
//        $query = mysqli_query($this->conn, $sql);

//     // $query =  mysqli_query($this->conn, "SELECT * FROM products WHERE product_id = $product_id ;");
//     return $query;
//   }
// }

// class cartproduct extends Connection{
//   public function cartproduct($product_id){
//   $query =  mysqli_query($this->conn, "SELECT * FROM products WHERE product_id in ($product_id) ;");
//   return $query;
// }
// }

// class checkoutproduct extends Connection {
//   public function checkoutproduct($product_id){
//     $query =  mysqli_query($this->conn, "SELECT * FROM products WHERE product_id in ($product_id) ;");
//     return $query;
//   }
// }






  



  //   function get_user_by_id($user_id) {
  //     $user_id_clean = $this->prepare_string($user_id);
  //     $query = "SELECT * FROM users WHERE user_id = ?;";
  //     $stmt = mysqli_prepare($this->dbc, $query);
  //     mysqli_stmt_bind_param(
  //         $stmt,
  //         's',
  //         $user_id_clean
  //     );
      
  //     mysqli_stmt_execute($stmt);
  //     $result = mysqli_stmt_get_result($stmt);
  //     return $result;
  // }
  
  // function update_user($user_id, $name, $email, $phone, $province){
      
  //     $user_id_clean = $this->prepare_string($user_id);
  //     $name_clean = $this->prepare_string($name);
  //     $email_clean = $this->prepare_string($email);
  //     $phone_clean = $this->prepare_string($phone);
  //     $province_clean = $this->prepare_string($province);

  //     $query = "UPDATE users SET name = ?, email = ?, phone = ?, province = ? WHERE  user_id = ?;";

  //     $stmt = mysqli_prepare($this->dbc, $query);

  //     mysqli_stmt_bind_param(
  //         $stmt,
  //         'sssss',
  //         $name_clean,
  //         $email_clean,
  //         $phone_clean,
  //         $province_clean,
  //         $user_id_clean
  //     );

  //     $result = mysqli_stmt_execute($stmt);
  //     return $result;
  // }




// 
// 


		// function __construct() {
		// 	$this->dbc = @mysqli_connect(
		// 		self::DB_HOST,
		// 		self::DB_USER,
		// 		self::DB_PASSWORD,
		// 		self::DB_NAME
		// 	)
		// 	OR die(
		// 		'Could not connect to MySQL: ' . mysqli_connect_error()
		// 	);

		// 	mysqli_set_charset($this->dbc, 'utf8');
		// }

		// function prepare_string($string) {
		// 	$string = strip_tags($string);
		// 	$string = mysqli_real_escape_string($this->dbc, trim($string));
		// 	return $string;
		// }

		// function get_dbc() {
		// 	return $this->dbc;
		// }
        
    //     function register_user($pname, $price, $quantity, $category, $discription){
            
    //         $pname = $this->prepare_string($pname);
    //        $price = $this->prepare_string($price);
    //         $quantity = $this->prepare_string($quantity);
    //         // $category = $this->prepare_string($category);
    //         $discription = $this->prepare_string($discription);

    //         $query = "INSERT INTO products($pname, $price, $quantity, $category, $discription) VALUES (?,?,?,?,?)";
        
    //         $stmt = mysqli_prepare($this->dbc, $query);

    //         mysqli_stmt_bind_param(
    //             $stmt,
    //             'sssss',
    //             $pname, 
    //             $price, 
    //             $quantity, 
    //             $category, 
    //             $discription,
                
    //         );

    //         $result = mysqli_stmt_execute($stmt);

    //         return $result;
    //     }

    //     function add_category($category){
            
         
    //       $category = $this->prepare_string($category);
         

    //       $query = "INSERT INTO category($category) VALUES (?)";
      
    //       $stmt = mysqli_prepare($this->dbc, $query);

    //       mysqli_stmt_bind_param(
    //           $stmt,
    //           's',
             
    //           $category, 
              
              
    //       );

    //       $result = mysqli_stmt_execute($stmt);

    //       return $result;
    //   }
        
    //     function get_users() {
    //         $query = 'SELECT * FROM users;';
    //         $result = @mysqli_query($this->dbc,$query);
    //         return $result;
    //     }
        
    //     function get_user_by_id($user_id) {
    //         $user_id_clean = $this->prepare_string($user_id);
    //         $query = "SELECT * FROM users WHERE user_id = ?;";
    //         $stmt = mysqli_prepare($this->dbc, $query);
    //         mysqli_stmt_bind_param(
    //             $stmt,
    //             's',
    //             $user_id_clean
    //         );
            
    //         mysqli_stmt_execute($stmt);
    //         $result = mysqli_stmt_get_result($stmt);
    //         return $result;
    //     }
        
    //     function update_user($user_id, $name, $email, $phone, $province){
            
    //         $user_id_clean = $this->prepare_string($user_id);
    //         $name_clean = $this->prepare_string($name);
    //         $email_clean = $this->prepare_string($email);
    //         $phone_clean = $this->prepare_string($phone);
    //         $province_clean = $this->prepare_string($province);

    //         $query = "UPDATE users SET name = ?, email = ?, phone = ?, province = ? WHERE  user_id = ?;";

    //         $stmt = mysqli_prepare($this->dbc, $query);

    //         mysqli_stmt_bind_param(
    //             $stmt,
    //             'sssss',
    //             $name_clean,
    //             $email_clean,
    //             $phone_clean,
    //             $province_clean,
    //             $user_id_clean
    //         );

    //         $result = mysqli_stmt_execute($stmt);
    //         return $result;
    //     }
        
    //     function delete_user_by_id($user_id) {
            
    //         $user_id_clean = $this->prepare_string($user_id);
    //         $query = "DELETE FROM Users WHERE user_id = ? ;";
    //         $stmt = mysqli_prepare($this->dbc, $query);
    //         mysqli_stmt_bind_param(
    //             $stmt,
    //             's',
    //             $user_id_clean
    //         );
            
    //         $result = mysqli_stmt_execute($stmt);

    //         return $result;
    //     }
	