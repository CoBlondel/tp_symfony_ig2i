<?php
namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();

        // create 10 articles! Bam!
        for ($i = 0; $i < 10; $i++) {
            $article = new Article();
            $article->setBody($faker->text($maxNbChars = 200));
            $article->setAuthor($faker->name);
            $article->setCreatedAt($faker->dateTimeThisDecade($max = 'now', $timezone = null));
            $article->setImage('img/post-bg.jpg');
            $article->setTitle($faker->text($maxNbChars = 15));
            $article->setSubtitle($faker->text($maxNbChars = 25));

            $this->addReference($i, $article);

            $manager->persist($article);
        }

        $manager->flush();
    }
}