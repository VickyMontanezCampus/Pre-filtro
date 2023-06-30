<?php
namespace App;

class soft_skills extends connect
{
    private $queryPost = 'INSERT INTO soft_skills(id, id_team_schedule, id_psychologist, id_location, id_subject, id_journey) VALUES (:identification, :id_team_schedule, :id_psychologist, :id_location, :id_subject, :id_journey)';
    private $queryGet = 'SELECT id AS "identification", SELECT id_team_schedule AS "id_team_schedule", SELECT id_psychologist AS "id_psychologist", SELECT id_location AS "id_location", SELECT id_subject AS "id_subject", SELECT id_journey AS "id_journey" FROM soft_skills';
    private $queryUpdate = 'UPDATE soft_skills SET id_team_schedule = :id_team_schedule =, id_psychologist = :id_psychologist =, id_location = :id_location, id_subject = :id_subject, id_journey = :id_journey WHERE id = :identification';
    private $queryDelete = 'DELETE FROM soft_skills WHERE id = :identification';
    private $msg;

    use getInstance;

    //? Constructor */
    function __construct(private $id = 1, private $id_team_schedule= 1, public $id_psychologist = 1, private $id_location = 1, private $id_subject = 1, private $id_journey = 1)
    {
        parent::__construct();
    }

    //? POST Function */
    public function softSkillsPost()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);

            $res->bindValue("identification", $this->id);
            $res->bindValue("id_team_schedule", $this->id_team_schedule);
            $res->bindValue("id_psychologist", $this->id_psychologist);
            $res->bindValue("id_location", $this->id_location);
            $res->bindValue("id_subject", $this->id_subject);
            $res->bindValue("id_journey", $this->id_journey);

            $res->execute();

            $this->msg = ["Code" => 200 + $res->rowCount(), "Message" => "Inserted Data"];
        } catch (\PDOException $e) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }
    //? GET Function */
    public function softSkillsGet()
    {
        try {
            $res = $this->conx->prepare($this->queryGet);
            $res->execute();

            $this->msg = ["Code" => 200, "Message" => $res->fetchAll(\PDO::FETCH_ASSOC)];

        } catch (\PDOException $e) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }

    //? UPDATE Function */
    function softSkillsUpdate()
    {
        try {
            $res = $this->conx->prepare($this->queryUpdate);

           
            $res->bindValue("identification", $this->id);
            $res->bindValue("id_team_schedule", $this->id_team_schedule);
            $res->bindValue("id_psychologist", $this->id_psychologist);
            $res->bindValue("id_location", $this->id_location);
            $res->bindValue("id_subject", $this->id_subject);
            $res->bindValue("id_journey", $this->id_journey);

            $res->execute();

            ($res->rowCount() > 0) ? $this->msg = ["Code" => 200, "Message" => "Updated Data"] : "none";
        } catch (\PDOException $e) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }
    //? DELETE Function */
    function softSkillsDelete()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("identification", $this->id);
            $res->execute();

            $this->msg = ["Code" => 200, "Message" => "Deleted Data"];
        } catch (\PDOException $e) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }



}
?>