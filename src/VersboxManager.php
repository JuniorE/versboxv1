<?php
    /**
     * Created by PhpStorm.
     * User: JuniorE.
     * Date: 2019-03-11
     * Time: 15:52
     */

    namespace JuniorE\Versbox;

    use Illuminate\Contracts\Container\Container;

    class VersboxManager
    {
        /**
         * @var Container
         */
        protected $app;

        /**
         * MollieManager constructor.
         *
         * @param Container $app
         *
         * @return void
         */
        public function __construct(Container $app)
        {
            $this->app = $app;
        }

        /**
         * @return mixed
         */
        public function api()
        {
            return $this->app['versbox.api'];
        }
    }