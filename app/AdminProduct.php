<?php
require_once('../setting/db.php');
require_once('../setting/data.php');

class AdminRobot extends Database
{
    public function __construct()
    {
        parent::__construct();
        echo "je suis dans le construct d'AdminRobot";
    }

    public function bidon()
    {
        echo "c bidon";
    }

    public function newRobot()
    {
        if (isset($_POST['submit-robot'])) {

            $description = secuData($_POST['description']);
            $name = secuData($_POST['name']);
            $layer = secuData($_POST['layer-robot']);
            $color = secuData($_POST['color-robot']);
            $materials = secuData($_POST['materials-robot']);
        }
    }

    public function getHeadRobots()
    {
        $sql = "SELECT * FROM head_robots";
        $result = $this->pdo->query($sql);
        $robot = $result->fetchAll();
        return $robot;
    }

    

    public function getHeadRobotsByColor($id_color, $id_material)
    {

        $sql = "SELECT * FROM head_robots WHERE id_color = ? AND id_material = ?";
        $result = $this->pdo->prepare($sql);
        $result->execute([
            $id_color, $id_material
        ]);
        $robot = $result->fetchAll();
        return $robot;
    }

    public function getBodyRobots()
    {
        $sql = "SELECT * FROM body_robots";
        $result = $this->pdo->query($sql);
        $robot = $result->fetchAll();
        return $robot;
    }

    public function newRobotHead()
    {

        if (isset($_POST['submit-head-robot'])) {
            echo "ok1";
            if (isset($_FILES['image-head-robot'])) {
                echo "ok2";
                $tmpName = $_FILES['image-head-robot']['tmp_name'];
                $name = $_FILES['image-head-robot']['name'];
                $size = $_FILES['image-head-robot']['size'];
                $type = $_FILES['image-head-robot']['type'];
                $error = $_FILES['image-head-robot']['error'];

                $picExtension = explode('.', @$name);
                $extension = strtolower(end($picExtension));
                $extensionsAllowed = ['jpg', 'png', 'jpeg', 'gif'];

                $way = "/Applications/MAMP/htdocs/tbmpro/assets/" . $name . '.' . $extension;
                $maxSize = 40000;

                if (in_array($extension, $extensionsAllowed) <= $maxSize && $error == 0) {
                    echo "ok3";
                    if (isset($name)) {
                        echo "ok4",
                        $namePicToRegister = $name . '.' . $extension;

                        $sql = "SELECT * FROM head_robots WHERE name = ?";
                        $request = $this->pdo->prepare($sql);
                        $request->execute([$namePicToRegister]);
                        $requestImg = $request->fetchAll();
                        $titlePic = $request->rowCount();

                        if ($titlePic == 0) {
                            echo "ok5";
                            $color = secuData($_POST['head-color']);
                            $materials = secuData($_POST['head-material']);

                            $sql = "INSERT INTO  `head_robots`(name, id_color, id_material) VALUES (?,?,?)";
                            $request = $this->pdo->prepare($sql);
                            $request->execute([
                                $namePicToRegister, $color, $materials
                            ]);

                            move_uploaded_file($tmpName, $way);

                            echo ("Layer successfully uploaded");
                        }
                    }
                }
            }
        }
    }

    public function newRobotBody()
    {

        if (isset($_POST['submit-body-robot'])) {
            echo "ok1";
            if (isset($_FILES['image-body-robot'])) {
                echo "ok2";
                $tmpName = $_FILES['image-body-robot']['tmp_name'];
                $name = $_FILES['image-body-robot']['name'];
                $size = $_FILES['image-body-robot']['size'];
                $type = $_FILES['image-body-robot']['type'];
                $error = $_FILES['image-body-robot']['error'];

                $picExtension = explode('.', @$name);
                $extension = strtolower(end($picExtension));
                $extensionsAllowed = ['jpg', 'png', 'jpeg', 'gif'];

                $way = "/Applications/MAMP/htdocs/tbmpro/assets/" . $name . '.' . $extension;
                $maxSize = 40000;

                if (in_array($extension, $extensionsAllowed) <= $maxSize && $error == 0) {
                    echo "ok3";
                    if (isset($name)) {
                        echo "ok4",
                        $namePicToRegister = $name . '.' . $extension;

                        $sql = "SELECT * FROM body_robots WHERE name = ?";
                        $request = $this->pdo->prepare($sql);
                        $request->execute([$namePicToRegister]);
                        $requestImg = $request->fetchAll();
                        $titlePic = $request->rowCount();

                        if ($titlePic == 0) {
                            echo "ok5";
                            $color = secuData($_POST['body-color']);
                            $materials = secuData($_POST['body-material']);

                            $sql = "INSERT INTO  `body_robots`(name, id_color, id_material) VALUES (?,?,?)";
                            $request = $this->pdo->prepare($sql);
                            $request->execute([
                                $namePicToRegister, $color, $materials
                            ]);

                            move_uploaded_file($tmpName, $way);

                            echo ("Layer successfully uploaded");
                        }
                    }
                }
            }
        }
    }

    public function getImages()
    {
        $sql = "SELECT * FROM images";
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

            if (!empty($_POST['new-material'])) {


                $materials = secuData($_POST['new-material']);

                $sql = "SELECT * FROM materials WHERE type = ?";
                $request = $this->pdo->prepare($sql);
                $request->execute([$materials]);
                $row = $request->rowCount();

                if ($row == 0) {

                    $sql = "INSERT INTO materials (type) VALUES (?)";
                    $request = $this->pdo->prepare($sql);
                    $request->execute([$materials]);
                    $request->fetchAll();
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

            $color = secuData($_POST['new-color']);

            $sql = "SELECT * FROM colors WHERE name = ?";
            $request = $this->pdo->prepare($sql);
            $request->execute([$color]);
            $row = $request->rowCount();

            if ($row == 0) {

                $sql = "INSERT INTO colors (name) VALUES (?)";
                $request = $this->pdo->prepare($sql);
                $request->execute([$color]);
                $request->fetchAll();
            }
        }
    }
}
