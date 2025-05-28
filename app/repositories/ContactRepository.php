<?php

namespace app\repositories;

use app\models\Contact;
use app\models\User;
use Doctrine\ORM\EntityManagerInterface;

class ContactRepository
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function all(): array
    {
        return $this->em->getRepository(Contact::class)->findAll();
    }

    public function find($id): ?Contact
    {
        return $this->em->getRepository(Contact::class)->find($id);
    }

    public function create(User $user, bool $type, string $description): Contact
    {
        $contact = new Contact($type, $description);
        $contact->setUser($user);
        $this->em->persist($contact);
        $this->em->flush();
        return $contact;
    }

    public function update(Contact $contact, User $user, bool $type, string $description): Contact
    {
        $contactReflection = new \ReflectionClass($contact);

        $typeProp = $contactReflection->getProperty('type');
        $typeProp->setAccessible(true);
        $typeProp->setValue($contact, $type);

        $descProp = $contactReflection->getProperty('description');
        $descProp->setAccessible(true);
        $descProp->setValue($contact, $description);

        $contact->setUser($user);

        $this->em->flush();
        return $contact;
    }

    public function delete(Contact $contact): void
    {
        $this->em->remove($contact);
        $this->em->flush();
    }

    public function searchByDescription(string $desc): array
    {
        return $this->em->getRepository(Contact::class)
            ->createQueryBuilder('c')
            ->where('c.description LIKE :desc')
            ->setParameter('desc', '%' . $desc . '%')
            ->getQuery()
            ->getResult();
    }
}