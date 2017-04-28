<?php
declare(strict_types=1);

namespace VertiKnow\Scraper;

include __DIR__ . '/../../TestCase.php';

// === test methods ===

/**
 * @covers Resource_PageFactory
 */
final class Resource_PageFactory_Test extends TestCase
{
    public function testCanCreatePageEntity()
    {
        $fetcherFactory = \Mockery::mock(Worker_Fetcher_EntityFactory::class);
        $resourceFactory = new Resource_PageFactory();
        $resourceObject = $resourceFactory->create(
            Resource_PageType::SCHACHBURG,
            $fetcherFactory
        );
        $this->assertInstanceOf(
            'VertiKnow\Scraper\Resource_Page',
            $resourceObject
        );
    }

    public function testCanCreateDifferentPageEntities()
    {
        $fetcherFactory = \Mockery::mock(Worker_Fetcher_EntityFactory::class);
        $resourceFactory = new Resource_PageFactory();
        $resourceObject_1 = $resourceFactory->create(
            Resource_PageType::MOCK,
            $fetcherFactory
        );
        $resourceObject_2 = $resourceFactory->create(
            Resource_PageType::SCHACHBURG,
            $fetcherFactory
        );
        $this->assertNotEquals(
            get_class($resourceObject_1),
            get_class($resourceObject_2)
        );
    }

        public function testWillThrowExceptionForUnknownType()
        {
            $this->expectException(Exception_VertiknowStartupError::class);

            $fetcherFactory = \Mockery::mock(Worker_Fetcher_EntityFactory::class);
            $resourceFactory = new Resource_PageFactory();
            $resourceObject = $resourceFactory->create(
                999999,
                $fetcherFactory
            );
        }
}
