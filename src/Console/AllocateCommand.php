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

    class AllocateCommand extends Command
    {
        protected $name = 'versbox:allocate';

        protected $description = 'Allocate Latches in the Versbox for orders within the next 12 hours.';
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
         * @return bool
         * @throws GuzzleException
         * @throws Exception
         */
        public function handle()
        {
            $orders = $this->versbox->getPendingVersboxAllocations();
            if ( !$orders) {
                $this->info('There are no orders to allocate.');
                return true;
            }
            $bar = $this->output->createProgressBar(count($orders));
            $bar->start();
            foreach ($orders as $order) {
                try {
                    $response = $this->versbox->allocateLatch(
                        $order->firstname,
                        $order->lastname,
                        $order->mobile,
                        $order->email,
                        $order->notifications,
                        Carbon::parse($order->pickup_date_time)->format('Y-m-d') . 'T' . Carbon::parse($order->pickup_date_time)->format('H:i:s'),
                        $order->disability,
                        $order->order_id,
                        $order->service_location_code != null ?: null
                    );
                } catch (GuzzleException $guzzleException) {
                    $this->error($guzzleException->getMessage());
                    throw $guzzleException;
                } catch (Exception $exception) {
                    $this->error($exception->getMessage());
                    throw $exception;
                } finally {
                    if (isset($response['success'])) {
                        $this->info($response['message']);
                        if ($response['success'] == true) {
                            $this->versbox->updateStatus($order->order_id, 1);
                        }
                    }
                    $bar->advance();
                }
            }
            $bar->finish();
            return true;
        }
    }
