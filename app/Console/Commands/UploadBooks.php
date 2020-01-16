<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
    protected $description = 'Upload basic books';

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
    public function handle(\App\Publisher\IBookRepository $repository, \App\Publisher\PublisherFactory $factory)
    {
        $books=[];
		
		$book=[];
		$book['id']=1001;
		$book['title']='Dreamweaver CS4';
		$book['authors']=['Janine Warner'];
		$book['publisher']='PANEM';
		$book['price']=3900;
		
		$books[]=$book;
		
		$book=[];
		$book['id']=1002;
		$book['title']='JavaScript kliens oldalon';
		$book['authors']=['Sikos László'];
		$book['publisher']='BBS-INFO';
		$book['price']=2900;
		
		$books[]=$book;
		
		$book=[];
		$book['id']=1003;
		$book['title']='Java';
		$book['authors']=['Barry Burd'];
		$book['publisher']='PANEM';
		$book['price']=3700;
		
		$books[]=$book;
		
		$book=[];
		$book['id']=1004;
		$book['title']='C# 2008';
		$book['authors']=['Stephen Randy Davis'];
		$book['publisher']='PANEM';
		$book['price']=3700;
		
		$books[]=$book;
		
		$book=[];
		$book['id']=1005;
		$book['title']='Az Ajax alapjai';
		$book['authors']=['Joshua Eichorn'];
		$book['publisher']='PANEM';
		$book['price']=4500;
		
		$books[]=$book;
		
		$book=[];
		$book['id']=1006;
		$book['title']='Algoritmusok';
		$book['authors']=['Ivanyos Gábor', 'Rónyai Lajos', 'Szabó Réka'];
		$book['publisher']='TYPOTEX';
		$book['price']=3600;
		
		$books[]=$book;
    }
}
