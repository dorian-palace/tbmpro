<?php
require_once('../setting/db.php');
require_once('../setting/data.php');
class AdminRobot extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllRobot()
    {
        $sql = "SELECT * FROM products INNER JOIN products_colors INNER JOIN colors ON id_color = colors.id INNER JOIN products_materials  INNER JOIN materials ON id_material = materials.id";
        $result = $this->pdo->query($sql);
        $results = $result->fetchAll();
        return $results;
    }

    public function newRobot()
    {

        if (isset($_POST['submit_robot'])) {
            $description = $_POST['description'];
            $name = $_POST['name'];
            $image = $_POST['image'];
            $color = $_POST['color'];
            $material = $_POST['material'];
            $sql = "INSERT INTO products (description, name, image) VALUES (?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(array(
                $description, $name, $image
            ));
            $sql = "INSERT INTO products_colors (id_product, id_color) VALUES (?,?)";
        }
    }

    public function getProductById()
    {

        $sql = 'SELECT * FROM products INNER JOIN categories ON id_categorie = categories.id';
        $result = $this->pdo->query($sql);
        $results = $result->fetchAll();
        return $results;
    }

    public function getColor()
    {
        $sql = 'SELECT * FROM colors';
        $result = $this->pdo->query($sql);
        $results = $result->fetchAll();
        return $results;
    }

    public function deleteColor($delete)
    {

        $sql = 'DELETE FROM colors WHERE id = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array(
            $delete
        ));

        return $stmt;
    }

    public function getMaterials()
    {
        $sql = 'SELECT * FROM materials';
        $result = $this->pdo->query($sql);
        $results = $result->fetchAll();
        return $results;
    }

    public function deleteMaterials()
    {
        $sql = 'DELETE FROM materials WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array(
            'id' => $_GET['id']
        ));
    }

    public function deleteProduct()
    {
        $sql = 'DELETE FROM products WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array(
            'id' => $_GET['id']
        ));
    }

    public function newColor()
    {
        if (isset($_POST['submit_color'])) {

            if (isset($_FILES['color'])) {

                $tmpName = $_FILES['color']['tmp_name'];
                $name = $_FILES['color']['name'];
                $size = $_FILES['color']['size'];
                $type = $_FILES['color']['type'];
                $error = $_FILES['color']['error'];

                $picExtension = explode('.', @$name);
                $extension = strtolower(end($picExtension));
                $extensionsAllowed = ['jpg', 'png', 'jpeg', 'gif'];

                $way = "/Applications/MAMP/htdocs/tbmpro/assets/" . $name . '.' . $extension;
                //Taille max en bytes acceptée, correspond à 4 mo  
                $maxSize = 40000;

                if (in_array($extension, $extensionsAllowed) <= $maxSize && $error == 0) {

                    if (isset($name)) {

                        $namePicToRegister = $name . '.' . $extension;

                        $sql = "SELECT * FROM colors WHERE name = ?";
                        $request = $this->pdo->prepare($sql);
                        $request->execute([$namePicToRegister]);
                        $requestImg = $request->fetchAll();
                        $titlePic = $request->rowCount();
                        var_dump($titlePic);


                        if ($titlePic == 0) {

                            $sql = "INSERT INTO  `colors`(`name`) VALUES (?)";
                            $request = $this->pdo->prepare($sql);
                            $request->execute([$namePicToRegister]);
                            //2 paramètres : le chemin du fichier que l’on veut uploader et le chemin vers lequel on souhaite l’uploader.
                            move_uploaded_file($tmpName, $way);

                            echo ("Picture successfully uploaded");

                            // header("Location: adminArticle.php");
                        } else {
                            echo ("the name already exist");
                        }
                    } else {
                        echo ("<p class = error>file should less than 4mo</p>");
                    }
                } else {
                    echo ("<p class = error>file should less than 4mo</p>");
                }
            }
        }
    }
}
