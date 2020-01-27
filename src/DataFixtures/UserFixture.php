<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
   
    private $encoder;
    
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        $role = new Role();
        $role->setLibellé("ADMIN_SYS");
        $manager->persist($role);

        $user = new User();
        $user->setUsername("supadmin");
        $user->setPassword($this->encoder->encodePassword($user, "system"));
        $user->setRoles(array("ROLE_".$role->getLibellé()));
        $user->setIsActive(true);
        $user->setProfil($role);
        $manager->persist($user);

   
        $manager->flush();
   }
}
