<?php

namespace App\Entity;

use App\Entity\IEntity;

class Asociado implements IEntity
{
	private $id = null;
	private $nombre = "";
	private $logo = "";
	private $descripcion = "";

	const RUTA_LOGOS_ASOCIADOS = '/images/asociados/';

	public function __construct($nombre = "", $logo = "", $descripcion = "")
	{
		$this->nombre = $nombre;
		$this->logo = $logo;
		$this->descripcion = $descripcion;
	}

	public function toArray(): array
	{
		return [
			'id' => $this->getId(),
			'nombre' => $this->getNombre(),
			'logo' => $this->getLogo(),
			'descripcion' => $this->getDescripcion()
		];
	}

	public function getId()
	{
		return $this->id;
	}
	public function setId($id)
	{
		$this->id = $id;
		return $this;
	}
	public function getNombre()
	{
		return $this->nombre;
	}
	public function setNombre($nombre)
	{
		$this->nombre = $nombre;
		return $this;
	}
	public function getLogo()
	{
		return $this->logo;
	}
	public function setLogo($logo)
	{
		$this->logo = $logo;
		return $this;
	}
	public function getDescripcion()
	{
		return $this->descripcion;
	}
	public function setDescripcion($descripcion)
	{
		$this->descripcion = $descripcion;
		return $this;
	}

	public function getUrl()
	{
		return self::RUTA_LOGOS_ASOCIADOS . $this->logo;
	}

	public function __toString()
	{
		return $this->descripcion;
	}
}
