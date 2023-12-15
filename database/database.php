<?php

function db()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "web_a";

    try {
        $con = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        echo 'connected';
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $con;
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}

/**
 * Create new student record
 */
function createStudent($value)
{

    $name = $value['name'];
    $age = $value['age'];
    $email = $value['email'];
    $image = $value['image_url'];

    $stmt = db()->prepare("INSERT INTO `student` (`name`,`age`,`email`,`profile`) VALUES (?,?,?,?)");
    $stmt->bindParam(1, $name);
    $stmt->bindParam(2, $age);
    $stmt->bindParam(3, $email);
    $stmt->bindParam(4, $image);

    return $stmt->execute();

    // if ($stmt->execute()) {
    //     echo "New student record created successfully";
    //     return $stmt;
    // } else {
    //     echo "Error: " . $stmt->errorInfo();
    // }
}


/**
 * Get all data from table student
 */
function selectAllStudents()
{
    $stmt = db()->prepare("SELECT * FROM `student`;");
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

/**
 * Get only one record by ID
 */
function selectOneStudent($id)
{
    $stmt = db()->prepare("SELECT * FROM student WHERE id = :?");
    if ($stmt) {
        $stmt->bindParam(1, $id);
        return $stmt->execute();
    } else {
        echo  " prepare statment flailed";
        exit;
    }
}

/**
 * Delete student by ID
 */
function deleteStudent($id)
{
    $stmt = db()->prepare("DELETE FROM `student` WHERE `id` = ?");
    if ($stmt) {
        $stmt->bindParam(1, $id);

        return $stmt->execute();
    } else {
        echo "Prepare statement failed";
        exit;
    }
}
/**
 * Update student's first name and last name
 */
function updateStudent($id, $value)
{
    $stmt = db()->prepare("UPDATE `student` SET `name` = :name,`age` = :age, `email`= :email ,`profile`= :profile WHERE id = :id");
    if ($stmt) {

        $name = $value['name'];
        $age = $value['age'];
        $email = $value['email'];
        $profile = $value['image_url'];


        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':profile', $profile);
        return $stmt->execute();
    } else {
        echo "prepare statement is failed";
        exit;
    }
}
