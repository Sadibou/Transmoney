<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
      private $encoder;
        
        public function __construct(UserPasswordEncoderInterface $encoder)
        {
            $this->encoder = $encoder;
        }
        public function load(ObjectManager $manager)
        {
            $role1 = new Role();
            $role1->setLibellé("ADMIN_SYS");
            $manager->persist($role1);
    
            $role2 = new Role();
            $role2->setLibellé("ADMIN");
            $manager->persist($role2);
    
            $role3 = new Role();
            $role3->setLibellé("CAISSIER");
            $manager->persist($role3);
    

            $user = new User();
            $user->setUsername("supadmin");
            $user->setPassword($this->encoder->encodePassword($user, "system"));
            $user->setIsActive(true);
            $user->setProfil($role1);
            $manager->persist($user);
    
        $manager->flush();
    }
}
