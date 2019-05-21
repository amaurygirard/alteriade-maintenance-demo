<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    protected $id;
    protected $projet_id;
    protected $name;
    protected $startDate;
    protected $endDate;
    protected $minutesInForfait;
    protected $type;
    protected $dateCreated;
    protected $dateUpdated;

    /**
     * Get the value of Id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of Id
     *
     * @param mixed id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of Projet Id
     *
     * @return mixed
     */
    public function getProjetId()
    {
        return $this->projet_id;
    }

    /**
     * Set the value of Projet Id
     *
     * @param mixed projet_id
     *
     * @return self
     */
    public function setProjetId($projet_id)
    {
        $this->projet_id = $projet_id;

        return $this;
    }

    /**
     * Get the value of Name
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of Name
     *
     * @param mixed name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of Start Date
     *
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set the value of Start Date
     *
     * @param mixed startDate
     *
     * @return self
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get the value of End Date
     *
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set the value of End Date
     *
     * @param mixed endDate
     *
     * @return self
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get the value of Minutes In Forfait
     *
     * @return mixed
     */
    public function getMinutesInForfait()
    {
        return $this->minutesInForfait;
    }

    /**
     * Set the value of Minutes In Forfait
     *
     * @param mixed minutesInForfait
     *
     * @return self
     */
    public function setMinutesInForfait($minutesInForfait)
    {
        $this->minutesInForfait = $minutesInForfait;

        return $this;
    }

    /**
     * Get the value of Type
     *
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of Type
     *
     * @param mixed type
     *
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of Date Created
     *
     * @return mixed
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set the value of Date Created
     *
     * @param mixed dateCreated
     *
     * @return self
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get the value of Date Updated
     *
     * @return mixed
     */
    public function getDateUpdated()
    {
        return $this->dateUpdated;
    }

    /**
     * Set the value of Date Updated
     *
     * @param mixed dateUpdated
     *
     * @return self
     */
    public function setDateUpdated($dateUpdated)
    {
        $this->dateUpdated = $dateUpdated;

        return $this;
    }

}
