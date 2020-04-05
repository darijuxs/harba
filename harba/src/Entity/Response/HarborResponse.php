<?php

namespace App\Entity\Response;

/**
 * Class HarborResponse.
 */
class HarborResponse
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string|null
     */
    private $image;

    /**
     * @var string
     */
    private $lat;

    /**
     * @var string
     */
    private $lon;

    /**
     * @var bool
     */
    private $showPopup = false;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return HarborResponse
     */
    public function setId(string $id): HarborResponse
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return HarborResponse
     */
    public function setName(string $name): HarborResponse
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string|null $image
     *
     * @return HarborResponse
     */
    public function setImage(?string $image): HarborResponse
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return float
     */
    public function getLat(): float
    {
        return (float) $this->lat;
    }

    /**
     * @param string $lat
     *
     * @return HarborResponse
     */
    public function setLat(string $lat): HarborResponse
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * @return float
     */
    public function getLon(): float
    {
        return (float) $this->lon;
    }

    /**
     * @param string $lon
     *
     * @return HarborResponse
     */
    public function setLon(string $lon): HarborResponse
    {
        $this->lon = $lon;

        return $this;
    }

    /**
     * @return bool
     */
    public function isShowPopup(): bool
    {
        return $this->showPopup;
    }

    /**
     * @param bool $showPopup
     *
     * @return HarborResponse
     */
    public function setShowPopup(bool $showPopup): HarborResponse
    {
        $this->showPopup = $showPopup;

        return $this;
    }
}
