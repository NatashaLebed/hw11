<?php

namespace Lebed\GuestbookBundle\Service\SearcherService;

use Lebed\GuestbookBundle\Entity\MessageRepository;

class Searcher
{
    protected $repository;

    public function __construct(MessageRepository $repository)
    {
        $this->repository = $repository;
    }

    public function search($string)
    {
        return $this->repository->getIdArrayByName($string);
    }
}