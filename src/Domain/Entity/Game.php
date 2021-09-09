<?php


namespace App\Domain\Entity;


use DateTime;

/**
 * Class Game
 *
 * @package App\Domain\Entity
 */
class Game
{
    /**
     * @var
     */
    private $game_id;
    /**
     * @var
     */
    private $name;
    /**
     * @var
     */
    private $description;
    /**
     * @var
     */
    private $created_at;
    /**
     * @var
     */
    private $updated_at;

    public function __construct(
        ?int $game_id = null,
        ?string $name = null,
        ?string $description = null,
        ?DateTime $created_at = null,
        ?DateTime $updated_at = null
    ) {
        $this->game_id = $game_id;
        $this->name = $name;
        $this->description = $description;
        $this->created_at = $created_at ?? new DateTime();
        $this->updated_at = $updated_at;
    }
    /**
     * @return mixed
     */
    public function getGameId()
    {
        return $this->game_id;
    }

    /**
     * @param mixed $game_id
     *
     * @return Game
     */
    public function setGameId($game_id): Game
    {
        $this->game_id = $game_id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     *
     * @return Game
     */
    public function setName($name): Game
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     *
     * @return Game
     */
    public function setDescription($description): Game
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     *
     * @return Game
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param mixed $updated_at
     *
     * @return Game
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }


}