<?php
    /**
     * Created by PhpStorm.
     * User: JuniorE.
     * Date: 2019-03-12
     * Time: 11:12.
     */

    namespace JuniorE\Versbox\Console;

    use Versbox;
    use Exception;
    use Carbon\Carbon;
    use Illuminate\Console\Command;
    use Illuminate\Support\Facades\DB;
    use GuzzleHttp\Exception\GuzzleException;

    class ReleaseCommand extends Command
    {
        protected $name = 'versbox:release';

        protected $description = 'Release Allocation of Latch(es)';

        protected $signature = 'versbox:release {api_reference*}';

        /**
         * @var Versbox
         */
        protected $versbox;

        public function __construct(\JuniorE\Versbox\Versbox $versbox)
        {
            parent::__construct();
            $this->versbox = $versbox;
        }

        /**
         * @param $api_reference
         * @return bool
         */
        public function handle()
        {
            foreach ($this->argument('api_reference') as $item) {
                $response = $this->versbox->readyOrReleaseAllactionLatch('DELETE', $item);
                $this->info($response->getBody());
            }
            return true;
        }
    }
