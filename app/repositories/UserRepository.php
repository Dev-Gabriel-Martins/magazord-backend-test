<?php
namespace app\repositories;

use app\models\User;
use Doctrine\ORM\EntityManagerInterface;

class UserRepository
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function find($id): ?User
    {
        return $this->em->getRepository(User::class)->find($id);
    }

    public function findByCpf(string $cpf): ?User
    {
        return $this->em->getRepository(User::class)->findOneBy(['cpf' => $cpf]);
    }

    public function all(): array
    {
        return $this->em->getRepository(User::class)->findAll();
    }

    public function create(string $name, string $cpf): User
    {
        $user = new User($name, $cpf);
        $this->em->persist($user);
        $this->em->flush();
        return $user;
    }

    public function update(User $user, string $name): User
    {
        $userReflection = new \ReflectionClass($user);
        $nameProp = $userReflection->getProperty('name');
        $nameProp->setAccessible(true);
        $nameProp->setValue($user, $name);
        $this->em->flush();
        return $user;
    }

    public function delete(User $user): void
    {
        $this->em->remove($user);
        $this->em->flush();
    }
}