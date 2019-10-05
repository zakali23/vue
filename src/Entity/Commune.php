<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommuneRepository")
 */
class Commune
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $insee;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $commune;

    /**
     * @ORM\Column(type="string",length=255)
     */
    private $codePostal;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $acheminement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Ligne;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $coordonnees_gps;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInsee(): ?string
    {
        return $this->insee;
    }

    public function setInsee(string $insee): self
    {
        $this->insee = $insee;

        return $this;
    }

    public function getCommune(): ?string
    {
        return $this->commune;
    }

    public function setCommune(string $commune): self
    {
        $this->commune = $commune;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(?string $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getAcheminement(): ?string
    {
        return $this->acheminement;
    }

    public function setAcheminement(string $acheminement): self
    {
        $this->acheminement = $acheminement;

        return $this;
    }

    public function getLigne(): ?string
    {
        return $this->Ligne;
    }

    public function setLigne(?string $Ligne): self
    {
        $this->Ligne = $Ligne;

        return $this;
    }

    public function getCoordonneesGps(): ?string
    {
        return $this->coordonnees_gps;
    }

    public function setCoordonneesGps(string $coordonnees_gps): self
    {
        $this->coordonnees_gps = $coordonnees_gps;

        return $this;
    }
}
