<?php
declare(strict_types=1);

namespace VertiKnow\Scraper;

include __DIR__ . '/../../TestCase.php';

// === test methods ===

/**
 * @covers Resource_Schachburg_Page
 */
final class Resource_Schachburg_Page_Test extends TestCase
{
    public function testCanFetchContent()
    {
        $fetcherFactory = aMocked_Worker_Fetcher_EntityFactory();
        $resourceFactory = new Resource_PageFactory();
        $resourceObject = $resourceFactory->create(
            Resource_PageType::SCHACHBURG,
            $fetcherFactory
        );
        $resourceObject->process();
        $resourceInfo = $resourceObject->getResourceInfo();
        $this->assertInstanceOf(
            'VertiKnow\Scraper\Info_Page',
            $resourceInfo
        );
    }

    public function testCanCountContent()
    {
        $fetcherFactory = aMocked_Worker_Fetcher_EntityFactory();
        $resourceFactory = new Resource_PageFactory();
        $resourceObject = $resourceFactory->create(
            Resource_PageType::SCHACHBURG,
            $fetcherFactory
        );
        $resourceObject->process();
        $this->assertInternalType('int', $resourceObject->count());
    }

    public function testCanIterateOverContent()
    {
        $fetcherFactory = aMocked_Worker_Fetcher_EntityFactory();
        $resourceFactory = new Resource_PageFactory();
        $resourceObject = $resourceFactory->create(
            Resource_PageType::SCHACHBURG,
            $fetcherFactory
        );
        $resourceObject->process();
        foreach ($resourceObject as $key=>$val) {
            var_dump($key, $val);
        }
    }
}

function aMocked_Worker_Fetcher_EntityFactory() {
    $fetcherWorker = \Mockery::mock(Worker_Fetcher_Entity::class)->makePartial();
    $fetcherWorker
        ->shouldReceive('fetchContent')->once()
        ->andReturn(file_get_contents(__DIR__ . '/../../dummy/Pages/schachburg_thread_2347'));

    $fetcherFactory = \Mockery::mock(Worker_Fetcher_EntityFactory::class)->makePartial();
    $fetcherFactory
        ->shouldReceive('create')->once()
        ->andReturn($fetcherWorker);
    return $fetcherFactory;
}
