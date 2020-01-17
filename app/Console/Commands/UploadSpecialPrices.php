<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use \App\SpecialPrice\ISpecialPriceRepository;
use \App\SpecialPrice\SpecialPriceFactory;
use \App\Book\IBookRepository;
use \App\Publisher\IPublisherRepository;

class UploadSpecialPrices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'special-prices:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upload basic special prices test data';
	
	/**
	 * @var ISpecialPriceRepository $specialPriceRepository
	 */
	protected $specialPriceRepository;
	
	/**
	 * @var SpecialPriceFactory $specialPriceFactory
	 */
	protected $specialPriceFactory;
	
	/**
	 * @var IBookRepository $bookRepository
	 */
	protected $bookRepository;
	
	/**
	 * @var IPublisherRepository $publisherRepository
	 */
	protected $publisherRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct( ISpecialPriceRepository $specialPriceRepository, SpecialPriceFactory $specialPriceFactory, IBookRepository $bookRepository, IPublisherRepository $publisherRepository)
    {
        parent::__construct();
		
		
		$this->specialPriceRepository=$specialPriceRepository;
		$this->specialPriceFactory=$specialPriceFactory;
		$this->bookRepository=$bookRepository;
		$this->publisherRepository=$publisherRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->uploadSpecialPricesWithBooksAndPublishersAssign();
    }
	
	
	
	private function uploadSpecialPricesWithBooksAndPublishersAssign(){
		
		$counter=0;
		
		$specialPrices=$this->getSpecialPrices();
		
		foreach($specialPrices as $specialPriceAttributes){
			
			$specialPrice=$this->specialPriceRepository->findByPk($specialPriceAttributes['id']);
			
			if($specialPrice!=null){
				continue;
			}
				
			$specialPrice=$this->specialPriceFactory->create();
			$specialPrice->id=$specialPriceAttributes['id'];
			$specialPrice->description=$specialPriceAttributes['description'];
			$this->specialPriceRepository->persist($specialPrice);
			
			if(isset($specialPriceAttributes['books'])){
				
				foreach($specialPriceAttributes['books'] as $bookId){
					
					$book=$this->bookRepository->findByPk($bookId);
					
					if($book){
						
						$this->specialPriceRepository->assignBookToSpecialPrice($book, $specialPrice);
					}
				}	
			}elseif(isset($specialPriceAttributes['publishers'])){
				
				foreach($specialPriceAttributes['publishers'] as $name){
				
					$publisher=$this->publisherRepository->findByName($name);
					
					if($publisher){
						
						$this->specialPriceRepository->assignPublisherToSpecialPrice($publisher, $specialPrice);
					}
				}
			}
			
			$counter++;
		}
		
		$this->info($counter.' number of special price records uploaded.');
	}
	
	private function getSpecialPrices(){
		
		$specialPrices=[];
		
		$specialPriceAttributes=[];
		$specialPriceAttributes['id']=101;
		$specialPriceAttributes['description']='10%-os kedvezmény a termék árából';
		$specialPriceAttributes['books']=[1006];
		
		$specialPrices[]=$specialPriceAttributes;
		
		$specialPriceAttributes=[];
		$specialPriceAttributes['id']=102;
		$specialPriceAttributes['description']='termék, 500-os kedvezmény a termék árából';
		$specialPriceAttributes['books']=[1002];
		
		$specialPrices[]=$specialPriceAttributes;
		
		$specialPriceAttributes=[];
		$specialPriceAttributes['id']=103;
		$specialPriceAttributes['description']='2+1 csomag kedvezmény (a szettben szereplő legolcsóbb termék 100%-os kedvezményt kap)';
		$specialPriceAttributes['publishers']=['PANEM'];
		
		$specialPrices[]=$specialPriceAttributes;
		
		return $specialPrices;
	}
}
