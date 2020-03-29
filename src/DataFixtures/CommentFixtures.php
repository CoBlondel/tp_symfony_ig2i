<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;


class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();

        // create 100 comments! Bam!
        for ($i = 0; $i < 100; $i++) {
            $comment = new Comment();
            $comment->setName($faker->name);
            $comment->setEmail($faker->email);
            $comment->setCreatedAt($faker->dateTimeThisDecade($max = 'now', $timezone = null));
            $comment->setComment($faker->text($maxNbChars = 200));

            $article =  $this->getReference(rand(0,9)); //$i%10
            $comment->setArticle($article);

            $manager->persist($comment);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            AppFixtures::class,
        );
    }
}
