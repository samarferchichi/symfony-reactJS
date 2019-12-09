<?php

namespace App\DataFixtures;

use App\Entity\BlogPost;
use App\Entity\Comment;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;
    
    /**
     * @var \Faker\Factory
     */
    private $faker;
    
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->faker = \Faker\Factory::create();
    }
    
    public function load(ObjectManager $manager)
    {
        $this->loadBlogPosts($manager);
        //$this->loadComments($manager);
        $this->loadUsers($manager);
    }
    
    
    public function loadUsers(ObjectManager $manager)
    {
    
    }
    
    public function loadBlogPosts(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('admin');
        $user->setName('samar');
        $user->setEmail('samar@admin.com');
        
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user, 'secret123'
        ));
    
        $manager->persist($user);
        
        for($i = 0; $i <100; $i++){
            $blogPost = new BlogPost();
            $blogPost->setTitle($this->faker->realText(30));
            $blogPost->setPublished($this->faker->dateTimeThisYear);
            $blogPost->setContent($this->faker->realText());
            $blogPost->setAuthor($user);
            $blogPost->setSlug($this->faker->slug);
    
            $manager->persist($blogPost);
    
            for($j = 0; $j <10; $j++){
                $comment = new Comment();
                $comment->setContent($this->faker->realText());
                $comment->setPublished($this->faker->dateTimeThisYear);
                $comment->setAuthor($user);
                $comment->setBlogPost($blogPost);
                $manager->persist($comment);
            }
        }
        
        $manager->flush();
    }
}
