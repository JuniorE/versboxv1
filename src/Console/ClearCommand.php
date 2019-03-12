<?php
    /**
     * Created by PhpStorm.
     * User: JuniorE.
     * Date: 2019-03-12
     * Time: 11:20
     */

    namespace JuniorE\Versbox\Console;


    use Illuminate\Console\Command;
    use Illuminate\Support\Facades\DB;
    use JuniorE\Versbox\Versbox;

    class ClearCommand extends Command
    {
        protected $name = 'versbox:clear';

        protected $description = 'Clear the Versbox Table';

        protected $versbox;

        protected $tables;

        /**
         * ClearCommand constructor.
         * @param Versbox $versbox
         */
        public function __construct(Versbox $versbox)
        {
            parent::__construct();
            $this->versbox = $versbox;
            $this->tables = [
                'versbox',
            ];
        }

        /**
         * @return bool
         */
        public function handle()
        {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            foreach ($this->tables as $table) {
                DB::table($table)->truncate();
            }
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            return true;
        }
    }