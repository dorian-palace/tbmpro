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

    public function newRobots($name, $idHead, $idBody, $idUser)
    {

        $sql = "INSERT INTO robots (name_robot, id_image_head, id_image_body, id_user) VALUES (?,?,?,?)";
        $request = $this->pdo->prepare($sql);
        $request->execute([
            $name, $idHead, $idBody, $idUser
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

    public function deleteHead($id)
    {
        $sql = "DELETE FROM head_robots WHERE head_id = ?";
        $request = $this->pdo->prepare($sql);
        $request->execute([
            $id
        ]);
        return $request;
    }

    public function deleteBody($id)
    {
        $sql = "DELETE FROM body_robots WHERE body_id = ?";
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

    /**
     * Fonction qui permet de créer une nouvelle image de tête pour les robots
     */
    public function newRobotHead()
    {
        //Si le formulaire est validé
        if (isset($_POST['submit-head-robot'])) {

            //Si le fichier est uploadé
            if (isset($_FILES['image-head-robot'])) {
                //Si le fichier n'est pas vide
                $tmpName = $_FILES['image-head-robot']['tmp_name'];
                $name = $_FILES['image-head-robot']['name'];
                $size = $_FILES['image-head-robot']['size'];
                $type = $_FILES['image-head-robot']['type'];
                $error = $_FILES['image-head-robot']['error'];
                //Si le fichier n'est pas vide
                $picExtension = explode('.', @$name);
                //On récupère l'extension du fichier
                $extension = strtolower(end($picExtension));
                //On met l'extension en minuscule
                $extensionsAllowed = ['jpg', 'png', 'jpeg', 'gif'];
                //On définit les extensions autorisées

                $way = "/Applications/MAMP/htdocs/tbmpro/assets/" . $name . '.' . $extension;
                //On définit le chemin de l'image
                $maxSize = 40000;
                //On définit la taille maximum du fichier

                if (in_array($extension, $extensionsAllowed) <= $maxSize && $error == 0) {
                    //Si l'extension est autorisée et que le fichier n'est pas trop volumineux

                    if (isset($name)) {
                        //Si le nom du fichier est défini
                        $namePicToRegister = $name . '.' . $extension;
                        //On définit le nom de l'image à enregistrer

                        $sql = "SELECT * FROM head_robots WHERE head_name = ?";
                        $request = $this->pdo->prepare($sql);
                        $request->execute([$namePicToRegister]);
                        $requestImg = $request->fetchAll();
                        $titlePic = $request->rowCount();

                        if ($titlePic == 0) {
                            //Si le nom de l'image n'est pas déjà utilisé

                            $color = secuData($_POST['head-color']);
                            $materials = secuData($_POST['head-material']);

                            $sql = "INSERT INTO  `head_robots`(head_name, id_color, id_material) VALUES (?,?,?)";
                            $request = $this->pdo->prepare($sql);
                            $request->execute([
                                $namePicToRegister, $color, $materials
                            ]);
                            //On enregistre l'image dans la base de données

                            move_uploaded_file($tmpName, $way);
                            //On déplace le fichier uploadé dans le dossier assets

                            echo ("Layer successfully uploaded");
                        }
                    }
                }
            }
        }
    }

    public function newRobotBody()
    {
        //Si le formulaire est validé
        if (isset($_POST['submit-body-robot'])) {
            //Si le fichier est uploadé
            if (isset($_FILES['image-body-robot'])) {
                //Si le fichier n'est pas vide
                $tmpName = $_FILES['image-body-robot']['tmp_name'];
                $name = $_FILES['image-body-robot']['name'];
                $size = $_FILES['image-body-robot']['size'];
                $type = $_FILES['image-body-robot']['type'];
                $error = $_FILES['image-body-robot']['error'];
                //Si le fichier n'est pas vide
                $picExtension = explode('.', @$name);
                //On récupère l'extension du fichier
                $extension = strtolower(end($picExtension));
                //On met l'extension en minuscule
                $extensionsAllowed = ['jpg', 'png', 'jpeg', 'gif'];
                //On définit les extensions autorisées

                $way = "/Applications/MAMP/htdocs/tbmpro/assets/" . $name . '.' . $extension;
                //On définit le chemin de l'image
                $maxSize = 40000;
                //On définit la taille maximum du fichier

                if (in_array($extension, $extensionsAllowed) <= $maxSize && $error == 0) {
                    //Si l'extension est autorisée et que le fichier n'est pas trop volumineux

                    if (isset($name)) {
                        //Si le nom du fichier est défini

                        $namePicToRegister = $name . '.' . $extension;
                        //On définit le nom de l'image à enregistrer

                        $sql = "SELECT * FROM body_robots WHERE body_name = ?";
                        $request = $this->pdo->prepare($sql);
                        $request->execute([$namePicToRegister]);
                        $requestImg = $request->fetchAll();
                        $titlePic = $request->rowCount();

                        if ($titlePic == 0) {
                            //Si le nom de l'image n'est pas déjà utilisé

                            $color = secuData($_POST['body-color']);
                            $materials = secuData($_POST['body-material']);

                            $sql = "INSERT INTO  `body_robots`(body_name, id_color, id_material) VALUES (?,?,?)";
                            $request = $this->pdo->prepare($sql);
                            $request->execute([
                                $namePicToRegister, $color, $materials
                            ]);
                            //On enregistre l'image dans la base de données

                            move_uploaded_file($tmpName, $way);
                            //On déplace le fichier uploadé dans le dossier assets

                            echo ("Layer successfully uploaded");
                        }
                    }
                }
            }
        }
    }

    /**
     * récupère toutes les images
     */
    public function getImages()
    {
        $sql = "SELECT * FROM images";
        $result = $this->pdo->query($sql);
        $results = $result->fetchAll();
        return $results;
    }

    /**
     * Récupère toutes les couleurs
     */
    public function getColor()
    {
        $sql = 'SELECT * FROM colors';
        $result = $this->pdo->query($sql);
        $results = $result->fetchAll();
        return $results;
    }

    /**
     * Supprime une couleur
     */
    public function deleteColor($delete)
    {

        $sql = 'DELETE FROM colors WHERE id = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array(
            $delete
        ));

        return $stmt;
    }

    /**
     * Récupère tout les matériaux
     */
    public function getMaterials()
    {
        $sql = 'SELECT * FROM materials';
        $result = $this->pdo->query($sql);
        $results = $result->fetchAll();
        return $results;
    }

    /**
     * Crée une nouvelle matière
     */
    public function newMaterials()
    {
        //Si le formulaire est validé
        if (isset($_POST['submit_material'])) {

            if (!empty($_POST['new-material'])) {


                $materials = secuData($_POST['new-material']);

                $sql = "SELECT * FROM materials WHERE type = ?";
                $request = $this->pdo->prepare($sql);
                $request->execute([$materials]);
                $row = $request->rowCount();

                if ($row == 0) {
                    //Si le nom n'est pas déjà utilisé
                    $sql = "INSERT INTO materials (type) VALUES (?)";
                    $request = $this->pdo->prepare($sql);
                    $request->execute([$materials]);
                    $request->fetchAll();
                }
            }
        }
    }

    /**
     * Supprime une matière
     */
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

    /**
     * Crée une nouvelle couleur
     */
    public function newColor()
    {
        if (isset($_POST['submit_color'])) {

            $color = secuData($_POST['new-color']);

            $sql = "SELECT * FROM colors WHERE name = ?";
            $request = $this->pdo->prepare($sql);
            $request->execute([$color]);
            $row = $request->rowCount();

            if ($row == 0) {
                //Si le nom n'est pas déjà utilisé
                $sql = "INSERT INTO colors (name) VALUES (?)";
                $request = $this->pdo->prepare($sql);
                $request->execute([$color]);
                $request->fetchAll();
            }
        }
    }
}
