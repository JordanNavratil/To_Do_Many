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
          $description = "Do dishes.";
          $test_task = new Task ($description);

          //Act
          $result = $test_task->getDescription();

          //Assert
          $this->assertEquals($description, $result);
        }

        function testSetDescription()
        {
          //Arrange
          $description = "Do dishes.";
          $test_task = new Task($description);

          //Act
          $test_task->setDescription("Drink coffee.");
          $result = $test_task->getDescription();

          //Assert
          $this->assertEquals("Drink coffee.", $result);
        }

        function testGetId()
        {
            //Arrange
            $id = 1;
            $description = "Wash the dog";
            $test_task= new Task($description, $id);

            //Act
            $result = $test_task->getId();

            //Assert
            $this->assertEquals(1,$result);
        }

        // function test_getCategoryId() {
        //     $name = "Home stuff";
        //     $id = null;
        //     $due_date = '0000-00-00';
        //     $test_category = new Category($name, $id);
        //     $test_category->save();
        //
        //     $description = "Wash the dog";
        //      = $test_category->getId();
        //     $test_task = new Task($description, $id, , $due_date);
        //     $test_task->save();
        //
        //     $result = $test_task->getCategoryId();
        //
        //     $this->assertEquals(true, is_numeric($result));
        // }

        function testSave()
        {
            //Arrange
            $description = "Wash the dog";
            $id = 1;
            $test_task = new Task($description, $id);

            //Act
            $test_task->save();

            //Assert
            $result = Task::getAll();
            $this->assertEquals($test_task, $result[0]);
        }

        function testGetAll()
        {
            //Arrange
            $description = "Wash the dog";
            $id = 1;
            $test_task = new Task($description);
            $test_category->save();

            $description2 = "Water the lawn";
            $id2 = 2;
            $test_task2 = new Task($description2, $id2);
            $test_task2->save();

            //Act
            $result = Task::getAll();

            //Assert
            $this->assertEquals([$test_task, $test_task2], $result);
        }

        function test_DeleteAll()
        {
            //Arrange
            $description = "Wash the dog";
            $id = 1;
            $test_task = new Task($description, $id);
            $test_task->save();

            $description2 = "Water the lawn";
            $id2 = 2;
            $test_task2 = new Task($description2, $id2);
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
            $description = "Wash the dog";
            $id = 1;
            $test_task = new Task($description, $id);
            $test_task->save();

            $description2 = "Water the lawn";
            $id2 = 2;
            $test_task2 = new Task($description2, $id2);
            $test_task2->save();


            //Act
            $result = Task::find($test_task->getId());

            //Assert
            $this->assertEquals($test_task, $result);
        }

        function testUpdate()
        {
          //Arrange
          $description = "Wash the dog";
          $id = 1;
          $test_task = new Task($description, $id);
          $test_task->save();

          $new_description = "Clean the dog";

          //Act
          $test_task->update($new_description);

          //Assert
          $this->assertEquals("Clean the dog", $test_task->getDescription());
        }

        function testDeleteTask()
        {
          //Arrange
          $description = "Wash the dog";
          $id = 1;
          $test_task = new Task($description, $id);
          $test_task->save();

          $description2 = "Water the lawn";
          $id2 = 2;
          $test_task2 = new Task($description2, $id2);

          //Act
          $test_task->delete();

          //Assert
          $this->assertEquals([$test_task2], Task::getAll());
        }

    }

 ?>
