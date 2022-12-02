<?php

namespace App\Test\Controller;

use App\Entity\Articles;
use App\Repository\ArticlesRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ArticlesControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private ArticlesRepository $repository;
    private string $path = '/articles/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(Articles::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Article index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'article[Amount]' => 'Testing',
            'article[Description]' => 'Testing',
            'article[Discount]' => 'Testing',
            'article[Item]' => 'Testing',
            'article[ItemDescription]' => 'Testing',
            'article[Quantity]' => 'Testing',
            'article[UnitCode]' => 'Testing',
            'article[UnitDescriptions]' => 'Testing',
            'article[UnitPrice]' => 'Testing',
            'article[VATAmount]' => 'Testing',
            'article[VATPercentage]' => 'Testing',
        ]);

        self::assertResponseRedirects('/articles/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Articles();
        $fixture->setAmount('My Title');
        $fixture->setDescription('My Title');
        $fixture->setDiscount('My Title');
        $fixture->setItem('My Title');
        $fixture->setItemDescription('My Title');
        $fixture->setQuantity('My Title');
        $fixture->setUnitCode('My Title');
        $fixture->setUnitDescriptions('My Title');
        $fixture->setUnitPrice('My Title');
        $fixture->setVATAmount('My Title');
        $fixture->setVATPercentage('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Article');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Articles();
        $fixture->setAmount('My Title');
        $fixture->setDescription('My Title');
        $fixture->setDiscount('My Title');
        $fixture->setItem('My Title');
        $fixture->setItemDescription('My Title');
        $fixture->setQuantity('My Title');
        $fixture->setUnitCode('My Title');
        $fixture->setUnitDescriptions('My Title');
        $fixture->setUnitPrice('My Title');
        $fixture->setVATAmount('My Title');
        $fixture->setVATPercentage('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'article[Amount]' => 'Something New',
            'article[Description]' => 'Something New',
            'article[Discount]' => 'Something New',
            'article[Item]' => 'Something New',
            'article[ItemDescription]' => 'Something New',
            'article[Quantity]' => 'Something New',
            'article[UnitCode]' => 'Something New',
            'article[UnitDescriptions]' => 'Something New',
            'article[UnitPrice]' => 'Something New',
            'article[VATAmount]' => 'Something New',
            'article[VATPercentage]' => 'Something New',
        ]);

        self::assertResponseRedirects('/articles/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getAmount());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getDiscount());
        self::assertSame('Something New', $fixture[0]->getItem());
        self::assertSame('Something New', $fixture[0]->getItemDescription());
        self::assertSame('Something New', $fixture[0]->getQuantity());
        self::assertSame('Something New', $fixture[0]->getUnitCode());
        self::assertSame('Something New', $fixture[0]->getUnitDescriptions());
        self::assertSame('Something New', $fixture[0]->getUnitPrice());
        self::assertSame('Something New', $fixture[0]->getVATAmount());
        self::assertSame('Something New', $fixture[0]->getVATPercentage());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Articles();
        $fixture->setAmount('My Title');
        $fixture->setDescription('My Title');
        $fixture->setDiscount('My Title');
        $fixture->setItem('My Title');
        $fixture->setItemDescription('My Title');
        $fixture->setQuantity('My Title');
        $fixture->setUnitCode('My Title');
        $fixture->setUnitDescriptions('My Title');
        $fixture->setUnitPrice('My Title');
        $fixture->setVATAmount('My Title');
        $fixture->setVATPercentage('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/articles/');
    }
}
