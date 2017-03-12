<?php

$m = new MongoClient();
        $db = $m->test;
       
        $inset = "db.getCollection('foo').insert({'name':'nanhe','age':30});";
        $response = $db->execute($inset);
        print_r($response); //Array ( [retval] => [ok] => 1 ) 
       
        $response = $m->test->execute("db.getCollection('foo').insert({'name':'happy','age':18});");
        print_r($response); //Array ( [retval] => [ok] => 1 ) 
        
        $response = $m->test->execute("db.foo.insert({'name':'prince','age':16});");
        print_r($response); //Array ( [retval] => [ok] => 1 ) 
        
        $response= $m->test->execute("return db.foo.count();"); 
        print_r($response); //Array ( [retval] => 3 [ok] => 1 ) 
        
        $response= $m->test->execute("return db.foo.findOne();"); 
        print_r($response); //Array ( [retval] => Array ( [_id] => MongoId Object ( [$id] => 5287ccbe60e2eac9a0e2f1c6 ) [name] => nanhe [age] => 30 ) [ok] => 1 ) 
        
        /*
         * If you want use find function then use toArray because The find() function returns a cursor, which can't be returned from JavaScript.
         */
        $response= $m->test->execute("return db.foo.find().toArray();"); 
        print_r($response); //[$id] => 5287cd2260e2eac9a0e2f1ca ) [name] => happy [age] => 18 ) [2] => Array ( [_id] => MongoId Object ( [$id] => 5287cd2260e2eac9a0e2f1cb ) [name] => prince [age] => 16 ) [3] => Array ( [_id] => MongoId Object ( [$id] => 5287cdea60e2eac9a0e2f1cc ) [name] => nanhe [age] => 30 ) [4] => Array ( [_id] => MongoId Object ( [$id] => 5287cdea60e2eac9a0e2f1cd ) [name] => happy [age] => 18 ) [5] => Array ( [_id] => MongoId Object ( [$id] => 5287cdea60e2eac9a0e2f1ce ) [name] => prince [age] => 16 ) ) [ok] => 1 ) 
       
        $response= $m->test->execute("return db.foo.find({'name':'nanhe'}).toArray();"); 
        print_r($response); //Array ( [retval] => Array ( [0] => Array ( [_id] => MongoId Object ( [$id] => 5287ce9b60e2eac9a0e2f1d2 ) [name] => nanhe [age] => 30 ) ) [ok] => 1 ) 
        // $id value will be different in your case

?>
