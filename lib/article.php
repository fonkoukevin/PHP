
<?php

function getArticleById(PDO $pdo, int $id):array|bool
{
    $query = $pdo->prepare("SELECT * FROM articles WHERE id = :id");
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}

function getArticles(PDO $pdo, int $limit = null, int $page = null):array|bool
{
   
    /*
        @todo faire la requête de récupération des articles
        La requête sera différente selon les paramètres passés, commencer par le BASE de base
    */
    
    // $query =$pdo-> prepare("SELECT * FROM articles");
    // $query->execute();
    // $result = $query->fetchAll(PDO::FETCH_ASSOC);
    // if($result){
    //     return $result;
    // }
    // else{
    //     return false;
    // }



    // Initialisez la requête SQL de base
    $sql = "SELECT * FROM articles";
    

   
    if ($limit !== null) {
      
        if ($page !== null) {
            $offset = ($page - 1) * $limit;
            $sql .= " LIMIT $limit OFFSET $offset";
        } else {
            $sql .= " LIMIT $limit";
        }
    }

    $query = $pdo->prepare($sql);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    if ($result) {
        return $result;
    } else {
        return false;
    }
    
}

function getTotalArticles(PDO $pdo):int|bool
{
    /*
        @todo récupérer le nombre total d'article (avec COUNT)
    */
    $query =$pdo-> prepare("SELECT COUNT(*) as total FROM articles");
    $query ->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    if($result !== false && isset($result["total"])){

    return $result['total'];
    }
    else{
        return false;
    }
}

function saveArticle(PDO $pdo, string $title, string $content, string|null $image, int $category_id, int $id = null):bool 
{
    if ($id === null) {
        /*
            @todo si id est null, alors on fait une requête d'insection
        */
        $query = $pdo->prepare("INSERT into articles(title,content,image,category_id,id)VALUES (:title, :content, :image, :category_id, :id)");
        

    

    } else {
        /*
            @todo sinon, on fait un update      
        */

        
        $query = $pdo->prepare("UPDATE articles SET title = :title, content= :content, image= :image, category_id = :category_id WHERE id= :id ");
        
        $query->bindValue(':id', $id, $pdo::PARAM_INT);
    }

    $query->bindValue(':title', $title, PDO::PARAM_STR);
        $query->bindValue(':content', $content, PDO::PARAM_STR);
        $query->bindValue(':image', $image, PDO::PARAM_STR);
        $query->bindValue(':category_id', $category_id, PDO::PARAM_STR);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
       
    // @todo on bind toutes les valeurs communes
       return $query->execute();  
}

function deleteArticle(PDO $pdo, int $id):bool
{
    
    /*
        @todo Faire la requête de suppression
    */

    $query= $pdo->prepare("DELETE FROM articles WHERE id = :id");
    $query->bindParam(":id", $id, PDO::PARAM_INT);
    $query->execute();
    if ($query->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
    
}