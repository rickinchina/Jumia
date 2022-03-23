<?php

use PHPUnit\Framework\TestCase;

require 'api/Api.php';

class MockJobsTest extends API
{

    public function testMockJobs()
    {
            $mockRepo = $this->createMock(\app\JobsRepository::class);

            $mockJobsArray = [
                ['id' => 1, 'name' => 'Admin', 'title' => 'Computer programmer', 'description' => 'test test test'],
                ['id' => 2, 'name' => 'Jorge', 'title' => 'Dancer', 'description' => 'test test test'],
                ['id' => 3, 'name' => 'Carlos', 'title' => 'Clown', 'description' => 'test test test'],
                ['id' => 4, 'name' => 'Helder', 'title' => 'Support IT', 'description' => 'test test test'],
            ];

            $mockRepo->method('fetch_all')->willReturn($mockJobsArray); 
            
            $jobs = $mockRepo->fetch_all();

            $this->assertEquals('Admin',$jobs[0]['name']);
    }


}

?>