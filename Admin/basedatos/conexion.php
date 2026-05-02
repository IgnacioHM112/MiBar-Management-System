<?php
if (!class_exists('connection')) {
    class connection {
        public static function conectar() {
            $host = 'localhost';
            $user = 'root';
            $pass = '';
            $db = 'restaurante';
            
            try {
                $conexion = new mysqli($host, $user, $pass, $db);
                if ($conexion->connect_error) {
                    die("Error de conexión: " . $conexion->connect_error);
                }
                $conexion->set_charset("utf8");
                return $conexion;
            } catch (Exception $e) {
                die("Error: " . $e->getMessage());
            }
        }

        public static function getBaseUrl() {
            // Adjust this if your project is in a different subfolder
            // For example, if it's in http://localhost/MiBar/, return "/MiBar/"
            return "/MiBar/";
        }
    }
}
?>