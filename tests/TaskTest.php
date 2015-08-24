<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Task.php";
    require_once "src/Category.php";

    $server = "mysql:host=localhost;dbname=to_do_test";
    $username = "root";
    $password = "root";
    $DB = new PDO($server, $username, $password);

    class TaskTest extends PHPUnit_Framework_TestCase {

        protected function tearDown()
        {
            Task::deleteAll();
            Category::deleteAll();
        }

        function testGetDescription()
        {
          //Arrange
          $name = "School stuff";
          $id = null;
          $test_category = new Category($name, $id);
          $test_category->save();

          $description = "Do dishes.";
          $category_id = $test_category->getId();
          $test_task = new Task ($description, $id, $category_id);


          //Act
          $result = $test_task->getDescription();

          //Assert
          $this->assertEquals($description, $result);
        }

        function testSetDescription()
        {
          //Arrange
          $name = "School stuff";
          $id = null;
          $test_category = new Category($name, $id);
          $test_category->save();

          $description = "Do dishes.";
          $category_id = $test_category->getId();
          $test_task = new Task($description, $id, $category_id);

          //Act
          $test_task->setDescription("Drink coffee.");
          $result = $test_task->getDescription();

          //Assert
          $this->assertEquals("Drink coffee.", $result);
        }

        function testGetId()
        {
            //Arrange
            $name = "School stuff";
            $id = 1;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "Wash the dog";
            $category_id = $test_category->getId();
            $test_task= new Task($description, $id, $category_id);

            //Act
            $result = $test_task->getId();

            //Assert
            $this->assertEquals(1, $result);
        }

        function test_getCategoryId() {
            $name = "Home stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "Wash the dog";
            $category_id = $test_category->getId();
            $test_task = new Task($description, $id, $category_id);
            $test_task->save();

            $result = $test_task->getCategoryId();

            $this->assertEquals(true, is_numeric($result));
        }

        function testSave()
        {
            //Arrange
            $name = "School stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "Wash the dog";
            $category_id = $test_category->getId();
            $test_task = new Task($description, $id, $category_id);

            //Act
            $test_task->save();

            //Assert
            $result = Task::getAll();
            $this->assertEquals($test_task, $result[0]);
        }

        function testGetAll()
        {
            //Arrange
            $name = "School stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "Wash the dog";
            $category_id = $test_category->getId();
            $test_task = new Task($description, $id, $category_id);
            $test_task->save();

            $description2 = "Water the lawn";
            $id2 = null;
            $category_id2 = $test_category->getId();
            $test_task2 = new Task($description2, $id2, $category_id2);
            $test_task2->save();

            //Act
            $result = Task::getAll();

            //Assert
            $this->assertEquals([$test_task, $test_task2], $result);
        }

        function test_DeleteAll()
        {
            //Arrange
            $name = "School stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "Wash the dog";
            $category_id = $test_category->getId();
            $test_task = new Task($description, $id, $category_id);
            $test_task->save();

            $description2 = "Water the lawn";
            $id2 = null;
            $category_id2 = $test_category->getId();
            $test_task2 = new Task($description2, $id2, $category_id2);
            $test_task2->save();

            //Act
            Task::deleteAll();

            //Assert
            $result = Task::getAll();
            $this->assertEquals([], $result);
        }

        function testFind()
        {

            //Arrange
            $name = "School stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "Wash the dog";
            $category_id = $test_category->getId();
            $test_task = new Task($description, $id, $category_id);
            $test_task->save();

            $description2 = "Water the lawn";
            $id2 = null;
            $category_id2 = $test_category->getId();
            $test_task2 = new Task($description2, $id2, $category_id2);
            $test_task2->save();

            //Act
            $result = Task::find($test_task->getId());

            //Assert
            $this->assertEquals($test_task, $result);
        }

        function testUpdate()
        {
          //Arrange
          $name = "School stuff";
          $id = null;
          $test_category = new Category($name, $id);
          $test_category->save();

          $description = "Wash the dog";
          $category_id = $test_category->getId();
          $test_task = new Task($description, $id, $category_id);
          $test_task->save();

          $new_description = "Clean the dog";

          //Act
          $test_task->update($new_description);

          //Assert
          $this->assertEquals("Clean the dog", $test_task->getDescription());
        }
 //
 //        function testDeleteTask()
 //        {
 //          //Arrange
 //          $description = "Wash the dog";
 //          $id = 1;
 //          $test_task = new Task($description, $id);
 //          $test_task->save();
 //
 //          $description2 = "Water the lawn";
 //          $id2 = 2;
 //          $test_task2 = new Task($description2, $id2);
 //          $test_task2->save();
 //
 //          //Act
 //          $test_task->delete();
 //
 //          //Assert
 //          $this->assertEquals([$test_task2], Task::getAll());
 //        }
 //
        }
 //
 // ?>
