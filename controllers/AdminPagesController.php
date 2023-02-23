<?php

class AdminPagesController {
    public static function home() {
        if(!isset($_SESSION["is_logged_in"])) {
            redirect("/admin/login");
        }

        // $adminInfo = App::get("db")->selectAll("users")->get();
        $adminInfo = App::get("db")->raw("select * from users where role=1")->get();

        view("admin", [
            "adminInfo" => $adminInfo
        ]);
    }

    public static function tableView() {
        if(!isset($_SESSION["is_logged_in"])) {
            redirect("/admin/login");
        }
        $posts = App::get("db")->raw("select * from posts order by id desc")->get();

        $addPostError = null;
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            global $addPostError;
            // echo sys_get_temp_dir();
            // echo php_ini_loaded_file();
            $title = $_POST["title"];
            $content = $_POST["content"];
            $uploadDir = "views/img/";
            $fileName = $_FILES["image"]["name"];
            $fileTempName = $_FILES["image"]["tmp_name"];
            // $fileSize = $_FILES["image"]["size"];
            $fileExplode = explode(".",$fileName);
            $fileExtention = end($fileExplode);
            
            if(!empty($title) && !empty($content) && !empty($fileName)) {
                if(is_uploaded_file($fileTempName)) {
                    // echo "File is uploaded to tmp folder <br>";
                    $newFile = md5(time() . $fileName) . "." . $fileExtention ;
                    $distPath = $uploadDir . $newFile;
                    if(checkMiemType($fileTempName)) {
                        if(!move_uploaded_file($fileTempName,$distPath)) {
                            return $addPostError = "Something went wrong";
                        }
                        // Process
                        $data = [
                            "title" => $title,
                            "content" => $content,
                            "image" => $newFile,
                            "author_id" => $_SESSION["admin_id"]
                        ];
                        App::get("db")->insert($data,"posts");
                        redirect("/admin/table-view");
    
                    } else {
                         return $addPostError = "File type not allowed";
                    }
                }
            }else{
                // dd("Error");
                return $addPostError = "Please fill the required field";
            }

            
        }

        view("admin.table", [
            "posts" => $posts,
            "addPostError" => $addPostError
        ]);
    }

    public static function deletePost() {
        $id = $_GET["id"];
        App::get("db")->raw("delete from posts where id=$id");
        redirect("/admin/table-view");
    }

    public static function login() {
        if(isset($_SESSION["is_logged_in"])) {
            redirect("/admin");
        }

        $errorMsg = null;
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            global $errorMsg;
            $email = htmlspecialchars($_REQUEST["email"]);
            $password = htmlspecialchars($_REQUEST["password"]);
            $errorMsg = ValidationController::validateAdminLogin($email,$password);
            if(!$errorMsg) {
                $checkAdmin = App::get("db")->raw("select * from users where email='$email' and role=1")->getOne();
                if($checkAdmin) {
                    if($checkAdmin->password === $password) {
                        $_SESSION["admin_id"] = $checkAdmin->id;
                        $_SESSION["admin_name"] = $checkAdmin->name;
                        $_SESSION["admin_email"] = $checkAdmin->email;
                        $_SESSION["role"] = "Administrator";
                        $_SESSION["is_logged_in"] = true;
                        redirect("/admin");
                    }else{
                        $errorMsg = "Wrong Credentials";
                    }
                }else{
                    $errorMsg = "Wrong Credentials";
                }
            }
        }
        view("login.admin",[
            "errorMsg" => $errorMsg
        ]);
    }
}
