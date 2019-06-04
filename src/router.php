<?php

$app->group("/api/v1", function () {

   $this->post("/sing", "UserController:singIn");

   $this->group("/product", function (){
       $this->post("/create", "ProductController:store");
       $this->get("/all", "ProductController:all");
       $this->get("/delete", "ProductController:delete");
       $this->get("/find/{id}", "ProductController:find");
       $this->post("/update/{id}", "ProductController:update");
   });
});