<?php

//Credenciales
$servername = "localhost";
$username = "root";
$password = "";
$database = "uac_courses_db";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} 

$sql = "CREATE TABLE IF NOT EXISTS Courses (
	id int PRIMARY KEY AUTO_INCREMENT,
	name varchar(30) UNIQUE NOT NULL,
    description varchar(500) NOT NULL,
    isUnderGraduate BOOLEAN NOT NULL,
    faculty int(1) UNSIGNED NOT NULL,
    isVirtual BOOLEAN NOT NULL
)";

if ($conn->query($sql) === FALSE) {
    die("Error al crear la tabla: " . $conn->error);
}

$sql2 = "SELECT * FROM courses";
$res = $conn->query($sql2);

if($res->num_rows === 0) {
    //Rellenar la tabla si no hay ningun dato
    $sql3 = "INSERT INTO courses (name, description, isUnderGraduate, faculty, isVirtual) VALUES
    ('Introducción a la Ingeniería de Software', 'Este curso proporciona una introducción a los principios fundamentales de la ingeniería de software. Se cubren temas como el ciclo de vida del desarrollo de software, metodologías ágiles, y principios de diseño.', true, 1, false),
    ('Historia de la Arquitectura Moderna', 'Este curso explora la evolución de la arquitectura desde el siglo XIX hasta la actualidad, centrándose en movimientos importantes, figuras clave y obras emblemáticas.', true, 2, false),
    ('Introducción al Derecho Penal', 'Este curso ofrece una visión general de los principios y conceptos fundamentales del derecho penal, incluyendo la teoría del delito, las penas y las medidas de seguridad.', true, 3, true),
    ('Psicología Social', 'Este curso examina cómo el comportamiento y los pensamientos de las personas son influenciados por la presencia real, imaginada o implícita de otros, así como por el entorno social.', false, 4, false),
    ('Contabilidad Financiera', 'Este curso proporciona una introducción a los principios y técnicas de la contabilidad financiera, incluyendo la preparación y análisis de estados financieros.', true, 5, false),
    ('Programación Avanzada', 'Este curso explora conceptos avanzados de programación, incluyendo programación orientada a objetos, estructuras de datos avanzadas y patrones de diseño.', true, 1, false),
    ('Diseño Arquitectónico Sostenible', 'Este curso se centra en los principios y prácticas del diseño arquitectónico sostenible, incluyendo el uso de materiales eco-amigables y la eficiencia energética.', false, 2, false),
    ('Derecho Internacional Público', 'Este curso examina los principios y normas que rigen las relaciones entre estados soberanos, incluyendo el derecho de los tratados y la responsabilidad internacional.', true, 3, true),
    ('Psicología del Desarrollo', 'Este curso se enfoca en los cambios psicológicos que ocurren a lo largo del ciclo de vida humano, desde la infancia hasta la vejez, incluyendo aspectos cognitivos, emocionales y sociales.', false, 4, false),
    ('Gestión Financiera Corporativa', 'Este curso aborda temas avanzados en la gestión financiera empresarial, incluyendo la valoración de empresas, decisiones de inversión y financiamiento, y estrategias de crecimiento.', true, 5, false);
";
    $conn->query($sql3);
} 

?>