<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('./services/Config.php');

class Service
{
    private $sql;
    private $con;
    public function __construct(string $sql = null, $con = null)
    {
        $this->sql = $sql;
        $this->con = $con;
    }
    /**
     * Retourne l'instance pdo, connexion a la base de donnee
     *
     * @return  mixed
     */
    public function getCon()
    {
        return $this->con;
    }

    /**
     * Initialise l'objet PDO
     *
     * @param PDO$con l'instance pdo, connexion a la base de donnee
     *
     * @return  self
     */
    public function setCon($con)
    {
        $this->con = $con;

        return $this;
    }
    /**
     * Retourne la valeur de la requette sql a executer
     *
     * @return  mixed
     */
    public function getSql()
    {
        return $this->sql;
    }

    /**
     * Modifie la valeur de la requette sql a executer
     *
     * @param mixed$sql
     *
     * @return  self
     */
    public function setSql($sql)
    {
        $this->sql = $sql;

        return $this;
    }
    /*
    $sql = "SELECT id,nom,phone,adresse,date_contact FROM contacts ORDER BY id DESC LIMIT 10 ";
    $stm = $con->prepare($sql);
    $stm->execute();

    $res = $stm->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stm->fetchAll();
     */

    /**
     * Fonction permettant d'executer une instruction
     * @param PDOStatement $stm l'instruction pdo preparer
     * @return PDOStatement $stm l'instruction pdo preparer
     */
    function execute($stm): PDOStatement
    {
        $stm->execute();
        return $stm;
    }
    /**
     * Fonction permettant de preparer une instruction
     * @return PDOStatement $stm l'instruction pdo preparer
     * @param string $sql l'instruction sql a executer
     */
    function getStatement(): mixed
    {
        return $this->con->prepare($this->getSql());
    }
    /**
     * Fonction permettant de modifier le mode d'execution d'une instruction
     * @return bool true si success et false sinon
     * @param PDOStatement $stm l'instruction pdo preparer
     * @param PDO $mode le mode d'execution de l'instruction
     */
    function setResultFetch($stm, $mode = PDO::FETCH_ASSOC)
    {
        return  $stm->setFetchMode($mode);
    }

    /**
     * Fonction permettant de recuperer le resultat d'une instruction
     * @return Array $row[] tableau de donnee recupere en base de donnee
     * @param PDOStatement $stm l'instruction pdo preparer
     * @param PDO $mode le mode d'execution de l'instruction
     */
    function getResult($stm, $mode = PDO::FETCH_ASSOC): mixed
    {
        if ($this->setResultFetch($stm, $mode)) :
            return $stm->fetchAll();
        endif;
    }
}
