<?php


namespace App\Domain\Repository;


use App\Domain\Entity\Game;
use App\Domain\Entity\GameCollection;

class GameRepository
{

    public function findOne(array $where = []): ?Game
    {
        return $this->getEntityManager()
                    ->select(Game::class)
                    ->whereEquals($where)
                    ->fetchDomain();
    }


    public function findAll(int &$count = null,  array $where = []): GameCollection
    {
        $select =
            $this
                ->getEntityManager()
                ->select(GameCollection::class)
                ->orderBy('`name` ASC');

        $this->search($select, $where, ['name']);
        $select->whereEquals($where);
        $this->count($select, $count);

        /** @var GameCollection $projects */
        $projects = $select->fetchDomain();

        return $projects;
    }

}