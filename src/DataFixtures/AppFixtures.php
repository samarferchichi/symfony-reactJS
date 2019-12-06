<?php

namespace App\DataFixtures;

use App\Entity\BlogPost;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $blogPost = new BlogPost();
        $blogPost->setTitle('A first post!');
        $blogPost->setPublished(new \DateTime('2018-07-01 12:30:00'));
        $blogPost->setContent('Post text!');
        $blogPost->setAuthor('Samar fer');
        $blogPost->setSlug('a-first-post');

        $manager->persist($blogPost);
        
        $blogPost = new BlogPost();
        $blogPost->setTitle('A second post!');
        $blogPost->setPublished(new \DateTime('2018-07-01 12:30:00'));
        $blogPost->setContent('Post text!');
        $blogPost->setAuthor('Samar fer');
        $blogPost->setSlug('a-first-post');

        $manager->persist($blogPost);
        
        
        $manager->flush();
    }
}
