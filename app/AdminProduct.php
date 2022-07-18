<?php
require_once('../setting/db.php');
require_once('../setting/data.php');

class AdminRobot extends Database
{
    public function __construct()
    {
        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $this->page = (int) strip_tags($_GET['page']); //strip_tags — Supprime les balises HTML et PHP d'une chaîne
        } else {
            $this->page = 1;
        }
        $this->limite = 5;
        $this->debut = ($this->page - 1) * $this->limite;
        parent::__construct();
    }

    public function newRobots($name, $idHead, $idBody, $idCategorie, $idUser)
    {

        $sql = "INSERT INTO robots (name, id_image_head, id_image_body, id_categorie, id_user) VALUES (?,?,?,?,?)";
        $request = $this->pdo->prepare($sql);
        $request->execute([
            $name, $idHead, $idBody, $idCategorie, $idUser
        ]);
        return $request;
    }

    public function getAllRobots()
    {
        $sql = "SELECT * FROM robots INNER JOIN head_robots ON robots.id_image_head = head_robots.head_id  INNER JOIN body_robots ON robots.id_image_body = body_robots.body_id INNER JOIN users ON robots.id_user = users.id ORDER BY robots.id_robot DESC LIMIT $this->limite OFFSET $this->debut";
        $request = $this->pdo->prepare($sql);
        $request->execute();
        $robots = $request->fetchAll();
        return $robots;
    }

    /**
     * count for pagination for robots
     */
    public function countRobots()
    {
        $sql = "SELECT COUNT(*) FROM robots";
        $request = $this->pdo->prepare($sql);
        $request->execute();
        // $count = $request->fetchColumn();
        return $request;
    }

    public function deleteRobot($id)
    {
        $sql = "DELETE FROM robots WHERE id_robot = ?";
        $request = $this->pdo->prepare($sql);
        $request->execute([
            $id
        ]);
        return $request;
    }

    public function getAllHeadRobots()
    {
        $sql = "SELECT * FROM head_robots";
        $result = $this->pdo->query($sql);
        $robot = $result->fetchAll();
        return $robot;
    }

    public function getHeadRobotsByMaterial($id)
    {
        $sql = "SELECT * FROM head_robots WHERE id_material = ?";
        $result = $this->pdo->prepare($sql);
        $result->execute([
            $id
        ]);
        $robot = $result->fetchAll();
        return $robot;
    }

    public function getHeadRobotsByColor($id)
    {
        $sql = "SELECT * FROM head_robots WHERE id_color = ?";
        $result = $this->pdo->prepare($sql);
        $result->execute([
            $id
        ]);
        $robot = $result->fetchAll();
        return $robot;
    }

    public function getHeadRobotsByColorAndMaterial($id_color, $id_material)
    {

        $sql = "SELECT * FROM head_robots WHERE id_color = ? AND id_material = ?";
        $result = $this->pdo->prepare($sql);
        $result->execute([
            $id_color, $id_material
        ]);
        $robot = $result->fetchAll();
        return $robot;
    }

    public function getAllBodyRobots()
    {
        $sql = "SELECT * FROM body_robots";
        $result = $this->pdo->query($sql);
        $robot = $result->fetchAll();
        return $robot;
    }

    public function getBodyRobotsByColor($id)
    {
        $sql = "SELECT * FROM body_robots WHERE id_color = ?";
        $result = $this->pdo->prepare($sql);
        $result->execute([
            $id
        ]);
        $robot = $result->fetchAll();
        return $robot;
    }

    public function getBodyRobotsByMaterial($id)
    {
        $sql = "SELECT * FROM body_robots WHERE id_material = ?";
        $result = $this->pdo->prepare($sql);
        $result->execute([
            $id
        ]);
        $robot = $result->fetchAll();
        return $robot;
    }

    public function getBodyRobotsByColorAndMaterial($idColor, $idMaterial)
    {
        $sql = "SELECT * FROM body_robots WHERE id_color = ? AND id_material = ?";
        $result = $this->pdo->prepare($sql);
        $result->execute([
            $idColor, $idMaterial
        ]);
        $robot = $result->fetchAll();
        return $robot;
    }

    public function newRobotHead()
    {

        if (isset($_POST['submit-head-robot'])) {
            // echo "ok1";
            if (isset($_FILES['image-head-robot'])) {
                // echo "ok2";
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
                    // echo "ok3";
                    if (isset($name)) {
                        // echo "ok4",
                        $namePicToRegister = $name . '.' . $extension;

                        $sql = "SELECT * FROM head_robots WHERE head_name = ?";
                        $request = $this->pdo->prepare($sql);
                        $request->execute([$namePicToRegister]);
                        $requestImg = $request->fetchAll();
                        $titlePic = $request->rowCount();

                        if ($titlePic == 0) {
                            // echo "ok5";
                            $color = secuData($_POST['head-color']);
                            $materials = secuData($_POST['head-material']);

                            $sql = "INSERT INTO  `head_robots`(head_name, id_color, id_material) VALUES (?,?,?)";
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
            // echo "ok1";
            if (isset($_FILES['image-body-robot'])) {
                // echo "ok2";
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
                    // echo "ok3";
                    if (isset($name)) {
                        // echo "ok4",
                        $namePicToRegister = $name . '.' . $extension;

                        $sql = "SELECT * FROM body_robots WHERE body_name = ?";
                        $request = $this->pdo->prepare($sql);
                        $request->execute([$namePicToRegister]);
                        $requestImg = $request->fetchAll();
                        $titlePic = $request->rowCount();

                        if ($titlePic == 0) {
                            // echo "ok5";
                            $color = secuData($_POST['body-color']);
                            $materials = secuData($_POST['body-material']);

                            $sql = "INSERT INTO  `body_robots`(body_name, id_color, id_material) VALUES (?,?,?)";
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
