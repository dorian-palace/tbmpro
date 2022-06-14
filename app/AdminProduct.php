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

    public function getCategories()
    {
        $sql = 'SELECT * FROM categories';
        $result = $this->pdo->query($sql);
        $results = $result->fetchAll();
        return $results;
    }

    public function getCategorieById($id)
    {
        $sql = 'SELECT * FROM categories WHERE id = ?';
        $result = $this->pdo->prepare($sql);
        $result->execute([$id]);
        $results = $result->fetchAll();
        return $results;
    }

    public function updateCategorie($id)
    {
        if (!empty($_POST['update-name-categorie'])) {
            $name = secuData($_POST['update-name-categorie']);
            $sql = 'UPDATE categories SET name = ? WHERE id = ?';
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                $name,
                $id
            ]);
        }
    }

    public function deleteCategorie($delete)
    {
        if (isset($_POST['delete-categorie'])) {

            $sql = 'DELETE FROM categories WHERE id = ?';
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(array(
                $delete
            ));
        }

        // return $stmt;
    }

    public function newCategories()
    {

        if (isset($_POST['submit-categorie'])) {

            if (!empty($_POST['name-categorie'])) {


                $nameCategories = secuData($_POST['name-categorie']);
                $sql = "SELECT * FROM categories WHERE name = ?";
                $request = $this->pdo->prepare($sql);
                $request->execute([$nameCategories]);
                $row = $request->rowCount();

                if ($row == 0) {
                    $sql = "INSERT INTO categories (name) VALUES (?)";
                    $request = $this->pdo->prepare($sql);
                    $request->execute([$nameCategories]);
                    $request->fetchAll();
                    // header('Location: adminProduct.php');
                } // else la categorie existe déjà
            } // else message d'érreur ici rempli le champ
        }
    }

    public function newMaterials()
    {
        if (isset($_POST['submit_material'])) {

            if (isset($_FILES['material'])) {

                $tmpName = $_FILES['material']['tmp_name'];
                $name = $_FILES['material']['name'];
                $size = $_FILES['material']['size'];
                $type = $_FILES['material']['type'];
                $error = $_FILES['material']['error'];

                $picExtension = explode('.', @$name);
                $extension = strtolower(end($picExtension));
                $extensionsAllowed = ['jpg', 'png', 'jpeg', 'gif'];

                $way = "/Applications/MAMP/htdocs/tbmpro/assets/" . $name . '.' . $extension;
                //Taille max en bytes acceptée, correspond à 4 mo  
                $maxSize = 40000;

                if (in_array($extension, $extensionsAllowed) <= $maxSize && $error == 0) {

                    if (isset($name)) {

                        $namePicToRegister = $name . '.' . $extension;

                        $sql = "SELECT * FROM materials WHERE type = ?";
                        $request = $this->pdo->prepare($sql);
                        $request->execute([$namePicToRegister]);
                        $requestImg = $request->fetchAll();
                        $titlePic = $request->rowCount();
                        var_dump($titlePic);


                        if ($titlePic == 0) {

                            $sql = "INSERT INTO  `materials`(`type`) VALUES (?)";
                            $request = $this->pdo->prepare($sql);
                            $request->execute([$namePicToRegister]);
                            //2 paramètres : le chemin du fichier que l’on veut uploader et le chemin vers lequel on souhaite l’uploader.
                            move_uploaded_file($tmpName, $way);

                            echo ("Materials successfully uploaded");
                        } else {
                            echo ("the materials already exist");
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

    public function deleteMaterials($delete)
    {
        $sql = 'DELETE FROM materials WHERE id = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array(
            $delete
        ));
        return $stmt;
    }

    public function deleteProduct($delete)
    {
        $sql = 'DELETE FROM products WHERE id = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array(
            $delete
        ));
        return $stmt;
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

                            echo ("Color successfully uploaded");

                            // header("Location: adminArticle.php");
                        } else {
                            echo ("the color already exist");
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
