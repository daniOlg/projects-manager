<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class ProjectRoutesTest extends TestCase
{
    protected $client;

    protected function setUp(): void
    {
        $this->client = new Client([
            'base_uri' => 'http://localhost:8000'
        ]);
    }

    public function testNotFoundRoute()
    {
        $response = $this->client->get('/ruta-inexistente', ['http_errors' => false]);
        $this->assertEquals(404, $response->getStatusCode());
    }

    public function testProjectsIndexRoute()
    {
        $response = $this->client->get('/api/v1/projects');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('application/json', $response->getHeaderLine('Content-Type'));
    }
    
    public function testProjectsStoreRoute()
    {
        $response = $this->client->post('/api/v1/projects', [
            'json' => [
                'name' => 'Test Project',
                'start_date' => '2023-10-01',
                'status' => 'active',
                'responsible' => 'John Doe',
                'amount' => 1000.50,
                'created_by' => 1
            ],
            'http_errors' => false
        ]);
        $this->assertEquals(201, $response->getStatusCode());
        $this->assertStringContainsString('application/json', $response->getHeaderLine('Content-Type'));
    }

    public function testProjectsShowRoute()
    {
        // create project
        $createResponse = $this->client->post('/api/v1/projects', [
            'json' => [
                'name' => 'Test Project for Show',
                'start_date' => '2023-10-01',
                'status' => 'active',
                'responsible' => 'Jane Doe',
                'amount' => 2000.75,
                'created_by' => 1
            ],
            'http_errors' => false
        ]);
        $this->assertEquals(201, $createResponse->getStatusCode());
        $createdProject = json_decode($createResponse->getBody(), true)['data'];
        $projectId = $createdProject['id'];

        // show project
        $response = $this->client->get("/api/v1/projects/{$projectId}");
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('application/json', $response->getHeaderLine('Content-Type'));
    }

    public function testProjectsUpdateRoute()
    {
        // create project
        $createResponse = $this->client->post('/api/v1/projects', [
            'json' => [
                'name' => 'Test Project for Update',
                'start_date' => '2023-10-01',
                'status' => 'active',
                'responsible' => 'Alice',
                'amount' => 1500.00,
                'created_by' => 1
            ],
            'http_errors' => false
        ]);
        $this->assertEquals(201, $createResponse->getStatusCode());
        $createdProject = json_decode($createResponse->getBody(), true)['data'];
        $projectId = $createdProject['id'];

        // update project
        $response = $this->client->put("/api/v1/projects/{$projectId}", [
            'json' => [
                'name' => 'Updated Project Name',
                'start_date' => '2023-11-01',
                'status' => 'completed',
                'responsible' => 'Bob',
                'amount' => 2500.00,
                'created_by' => 1
            ],
            'http_errors' => false
        ]);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('application/json', $response->getHeaderLine('Content-Type'));
    }

    public function testProjectsDeleteRoute()
    {
        // create project
        $createResponse = $this->client->post('/api/v1/projects', [
            'json' => [
                'name' => 'Test Project for Delete',
                'start_date' => '2023-10-01',
                'status' => 'active',
                'responsible' => 'Charlie',
                'amount' => 3000.00,
                'created_by' => 1
            ],
            'http_errors' => false
        ]);
        $this->assertEquals(201, $createResponse->getStatusCode());
        $createdProject = json_decode($createResponse->getBody(), true)['data'];
        $projectId = $createdProject['id'];

        // delete project
        $response = $this->client->delete("/api/v1/projects/{$projectId}", ['http_errors' => false]);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('application/json', $response->getHeaderLine('Content-Type'));
    }
}
