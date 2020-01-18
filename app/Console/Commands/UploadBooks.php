<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use \App\Book\IBookRepository;
use \App\Book\BookFactory;
use \App\Publisher\IPublisherRepository;
use \App\Publisher\PublisherFactory;
use \App\Publisher\Publisher;
use \App\Author\IAuthorRepository;
use \App\Author\AuthorFactory;
use \App\Author\Author;

class UploadBooks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'books:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upload basic book test data';

    /**
     * @var IBookRepository $bookRepository
     */
    protected $bookRepository;

    /**
     * @var BookFactory $bookFactory
     */
    protected $bookFactory;

    /**
     * @var IAuthorRepository $authorRepository
     */
    protected $authorRepository;

    /**
     * @var AuthorFactory $authorFactory
     */
    protected $authorFactory;

    /**
     * @var IPublisherRepository $publisherRepository
     */
    protected $publisherRepository;

    /**
     * @var PublisherFactory $publisherFactory
     */
    protected $publisherFactory;

    /**
     * UploadBooks constructor.
     * @param IBookRepository $bookRepository
     * @param BookFactory $bookFactory
     * @param IAuthorRepository $authorRepository
     * @param AuthorFactory $authorFactory
     * @param IPublisherRepository $publisherRepository
     * @param PublisherFactory $publisherFactory
     */
    public function __construct(IBookRepository $bookRepository, BookFactory $bookFactory, IAuthorRepository $authorRepository, AuthorFactory $authorFactory, IPublisherRepository $publisherRepository, PublisherFactory $publisherFactory)
    {
        parent::__construct();

        $this->bookRepository = $bookRepository;
        $this->bookFactory = $bookFactory;
        $this->authorRepository = $authorRepository;
        $this->authorFactory = $authorFactory;
        $this->publisherRepository = $publisherRepository;
        $this->publisherFactory = $publisherFactory;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->uploadBooksWithAuthorsAndPublishers();

    }

    private function uploadBooksWithAuthorsAndPublishers()
    {

        $books = $this->getBooks();

        $counter = 0;

        foreach ($books as $bookAttributes) {

            $book = $this->bookRepository->findByPk($bookAttributes['id']);

            if ($book != null) {
                continue;
            }

            $publisher = $this->findOrCreatePublisher($bookAttributes['publisher']);

            $book = $this->bookFactory->create();
            $book->id = $bookAttributes['id'];
            $book->title = $bookAttributes['title'];
            $book->price = $bookAttributes['price'];
            $book->publisher_id = $publisher->id;
            $this->bookRepository->persist($book);

            foreach ($bookAttributes['authors'] as $authorName) {

                $author = $this->authorRepository->findByName($authorName);
                if ($author == null) {
                    $author = $this->authorFactory->create();
                    $author->name = $authorName;
                    $this->authorRepository->persist($author);
                }
                $this->bookRepository->assignAuthorToBook($book, $author);
            }

            $counter++;

        }

        $this->info($counter . ' number of book records uploaded.');
    }

    private $publishers = [];

    /**
     * Find or create publisher by name.
     *
     * @param string $name
     * @return Publisher
     */
    private function findOrCreatePublisher($name): Publisher
    {

        if (isset($this->publishers[$name])) {

            return $this->publishers[$name];
        } else {

            $publisher = $this->publisherRepository->findByName($name);

            if ($publisher == null) {

                $publisher = $this->publisherFactory->create();
                $publisher->name = $name;
                $this->publisherRepository->persist($publisher);
            }
            $this->publishers[$name] = $publisher;
            return $publisher;
        }
    }

    /**
     * Test data from the pdf.
     */
    private function getBooks(): array
    {

        $books = [];

        $book = [];
        $book['id'] = 1001;
        $book['title'] = 'Dreamweaver CS4';
        $book['authors'] = ['Janine Warner'];
        $book['publisher'] = 'PANEM';
        $book['price'] = 3900;

        $books[] = $book;

        $book = [];
        $book['id'] = 1002;
        $book['title'] = 'JavaScript kliens oldalon';
        $book['authors'] = ['Sikos László'];
        $book['publisher'] = 'BBS-INFO';
        $book['price'] = 2900;

        $books[] = $book;

        $book = [];
        $book['id'] = 1003;
        $book['title'] = 'Java';
        $book['authors'] = ['Barry Burd'];
        $book['publisher'] = 'PANEM';
        $book['price'] = 3700;

        $books[] = $book;

        $book = [];
        $book['id'] = 1004;
        $book['title'] = 'C# 2008';
        $book['authors'] = ['Stephen Randy Davis'];
        $book['publisher'] = 'PANEM';
        $book['price'] = 3700;

        $books[] = $book;

        $book = [];
        $book['id'] = 1005;
        $book['title'] = 'Az Ajax alapjai';
        $book['authors'] = ['Joshua Eichorn'];
        $book['publisher'] = 'PANEM';
        $book['price'] = 4500;

        $books[] = $book;

        $book = [];
        $book['id'] = 1006;
        $book['title'] = 'Algoritmusok';
        $book['authors'] = ['Ivanyos Gábor', 'Rónyai Lajos', 'Szabó Réka'];
        $book['publisher'] = 'TYPOTEX';
        $book['price'] = 3600;

        $books[] = $book;

        return $books;
    }
}
