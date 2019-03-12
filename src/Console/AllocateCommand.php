<?php
    /**
     * Created by PhpStorm.
     * User: JuniorE.
     * Date: 2019-03-12
     * Time: 11:12
     */

    namespace JuniorE\Versbox\Console;


    use Illuminate\Console\Command;
    use Illuminate\Support\Facades\DB;

    class AllocateCommand extends Command
    {
        protected $name = 'versbox:allocate';

        protected $description = 'Allocate Latches in the Versbox for orders within the next 12 hours.';


        public function __construct()
        {
            parent::__construct();
        }

        public function handle()
        {
            $order = DB::select('select * from versbox where (pickup_date_time >= NOW()) and (pickup_date_time <= DATE_ADD(NOW(), INTERVAL 12 HOURS))');
            return true;
        }


    }