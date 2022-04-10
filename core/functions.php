<?php 


//common start

function old($inputName) {
    if(isset($_POST[$inputName])) {
        return $_POST[$inputName];
    }else {
        return "";
    }
}

function runQuery($sql) {
    global $conn;
    if($conn->query($sql)) {
        return true;
    }else {
        die("Query failed: ". $conn->connct_error);
    }
}

function setError($inputName,$message) {
    $_SESSION['error'][$inputName] = $message;
}

function removeError() {
    $_SESSION['error'] = [];
}

function showError($inputName) {
    if(isset($_SESSION['error'][$inputName])) {
        return $_SESSION['error'][$inputName];
    }else {
        return "";
    }
}

//common end

function upload() {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $dbname = "";
    $dbemail = "";
    $dbphone = "";
    
    $errorStatus = 0;

    if(empty($name)) {
        setError("name","Name is require");
        $errorStatus = 1;
    }else {
        if(strlen($name) < 4) {
            setError("name","Name is too short");
            $errorStatus = 1;
        }else if(strlen($name) > 20) {
            setError("name","Name is too long");
            $errorStatus = 1;
        }else {
            $dbname = $name;
            $errorStatus = 0;
        }
    }

    if(empty($email)) {
        setError("email","Email is requied");
        $errorStatus = 1;
    }else {
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            setError("email","Invalid email");
            $errorStatus = 1;
        }else {
            $dbemail = $email;
            $errorStatus = 0;
        }
    }

    if(empty($phone)) {
        setError("phone","Phone is required");
        $errorStatus = 1;
    }else {
        if(!preg_match("/^[0-9- ]*$/",$phone)) {
            setError("phone","Invalid phone");
            $errorStatus = 1;
        }else {
            $dbphone = $phone;
            $errorStatus = 0;
        }
    }

    if($_FILES['photo']['name']) {
        $acceptType = ['image/jpeg','image/png'];
        $tmp = $_FILES['photo']['tmp_name'];
        $name = $_FILES['photo']['name'];

        if(in_array($_FILES['photo']['type'],$acceptType)) {
            move_uploaded_file($tmp,"store/".$name);
            $errorStatus = 0;
        }else {
            setError("photo","File is invalid");
            $errorStatus = 1;
        }
    }else {
        setError("photo","File is require");
        $errorStatus = 1;
    }

    if($errorStatus > 0) {
        return false;
    }else {
        return true;
    }
}


function uploaddb() {
    $name = $_POST['name'];
    $profile = $_FILES['photo']['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "INSERT INTO contacts (name,email,phone,profile) VALUES ('$name','$email','$phone','$profile')";
    return runQuery($sql);
}


//fetch start
function fetchAll($sql) {
    global $conn;
    $query = $conn->query($sql);
    $rows = [];
    while($row = mysqli_fetch_assoc($query)) {
        array_push($rows,$row);
    }

    return $rows;
}

function contacts() {
    $sql = "SELECT * FROM contacts";
    return fetchAll($sql);
}

//fetch end

//delete start
function deleteContact($id) {
    $sql = "DELETE FROM contacts WHERE id = '$id'";
    return runQuery($sql);
} 

//delete end

//update start

function updateContact($id) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $profile = $_FILES['photo']['name'];
    $sql = "UPDATE contacts SET name = '$name',email = '$email',phone = '$phone',profile = '$profile' WHERE id = '$id'";

    return runQuery($sql);
}

//update end