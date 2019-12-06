<?php

namespace App\EntityListener;

use App\Entity\Article;
use Doctrine\ORM\Event\LifecycleEventArgs;

class ArticleEntityListener
{
    public function prePersist(LifecycleEventArgs $args)
    {
        $article = $args->getEntity();

        if (!$article instanceof Article) {
            return;
        }

        $article->setCreated(new \DateTime());
    }
}
