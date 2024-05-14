<?php

class AdminCourse {
    
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    //CRUD

    public function saveCourse($course) {
        $response;
        if(!$this->existCourseByName($course->getName(),)) {
            $sql = "INSERT INTO courses (name, description, isUnderGraduate, faculty, isVirtual)
            VALUES ('" 
            . $course->getName() . "','" . $course->getDescription() 
            . "'," .  $course->getIsUnderGraduate() . "," . $course->getFaculty() 
            . "," . $course->getIsVirtual() . ")";
            try {
                $this->conn->query($sql);
                $response['message'] = 'Se creo exitosamente!';
            } catch (mysqli_sql_exception $error) {
                $response['message'] = 'ERROR';
                $response['statusCode'] = 400;
                $response['error'] = $error->getMessage();
            }   
        } else {
            $response['message'] = 'ERROR';
            $response['statusCode'] = 400;
            $response['error'] = 'Ya existe un curso con el nombre ' . $course->getName();
        }
        return json_encode($response);
    }
    public function getCourses($isUnderGraduate,$faculty, $isVirtual) {
        $sql = "SELECT * FROM courses WHERE isUnderGraduate=" . $isUnderGraduate . " AND faculty=" . $faculty . " AND isVirtual=" . $isVirtual;
        $res = $this->conn->query($sql);
        $response;
        if($res->num_rows === 0) {
            $response['message'] = 'NO DATA FOUND';
        } 
        else {
            $response = array();
            while($row = $res->fetch_assoc()) {
                $response[] = $row;
            }
        }
        return json_encode($response);
    }
    public function getAllCourses() {
        $sql = "SELECT * FROM courses";
        $res = $this->conn->query($sql);
        $response;
        if($res->num_rows === 0) {
            $response['message'] = 'NO DATA FOUND';
        } 
        else {
            $response = array();
            while($row = $res->fetch_assoc()) {
                $response[] = $row;
            }
        }
        return json_encode($response);
    }
    public function updateCourse($id, $updateCourse) {
        $response;
        if (!$this->existCourse($id)) {
            $response['message'] = 'ERROR';
            $response['statusCode'] = 404;
            $response['error'] = 'No existe el curso con el id ' . $id;
        }
        else {
            if(!$this->existCourseByName($updateCourse->getName(),$id)) {
                $sql = "UPDATE courses SET name = '" . $updateCourse->getName() . "', description = '" 
                . $updateCourse->getDescription()
                . "', isUnderGraduate = " . $updateCourse->getIsUnderGraduate() . ", faculty = " . $updateCourse->getFaculty()
                . ", isVirtual = " . $updateCourse->getIsVirtual() . " WHERE id = " . $id;
                try {
                    $this->conn->query($sql);
                    $response['message'] = 'Se actualizo exitosamente!';
                } catch (mysqli_sql_exception $error) {
                    $response['message'] = 'ERROR';
                    $response['statusCode'] = 400;
                    $response['error'] = $error->getMessage();
                }
            } else {
                $response['message'] = 'ERROR';
                $response['statusCode'] = 400;
                $response['error'] = 'Ya existe un curso con el nombre ' . $updateCourse->getName();
            }
        }
        return json_encode($response);
    }
    public function deleteCourse($id) {
        $response;
        if (!$this->existCourse($id)) {
            $response['message'] = 'ERROR';
            $response['statusCode'] = 404;
            $response['error'] = 'No existe el curso con el id ' . $id;
        } else {
            $sql = "DELETE FROM courses WHERE id = " . $id;
            $this->conn->query($sql);
            $response['message'] = 'El curso con el id ' . $id . " Se elimino con exito!";
        }
        return json_encode($response);
    }
    private function existCourse($id) {
        $sql = "SELECT * FROM courses WHERE id = " . $id;
        return  $this->conn->query($sql)->num_rows===1;
    }
    private function existCourseByName($name,$id = null) {
        $sql = "SELECT * FROM courses WHERE name = '" . $name . "'";
        $res = $this->conn->query($sql);
        if ($id != null) {
            return  $res->num_rows===1 && $res->fetch_assoc()['id'] !== $id;
        } else {
            return $res->num_rows===1; 
        }
    }
}

?>
