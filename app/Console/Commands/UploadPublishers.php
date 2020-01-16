<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UploadPublishers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'publishers:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upload basic publishers';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(\App\Publisher\IPublisherRepository $repository, \App\Publisher\PublisherFactory $factory)
    {
        if($repository->count()>0){
			
			$this->info('The publishers table is not empty!');
			$this->info('This script only works with an empty table.');
			return;
		}
		
		$names=[];
		$names[]='PANEM';
		$names[]='BBS-INFO';
		$names[]='TYPOTEX';
		
		foreach($names as $name){
			
			$publisher=$factory->create();
			$publisher->name=$name;
			$repository->persist($publisher);
		}
		
		$this->info('Records uploaded.');
		
    }
}
