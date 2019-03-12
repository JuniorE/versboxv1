<?php
    /**
     * Created by PhpStorm.
     * User: JuniorE.
     * Date: 2019-03-12
     * Time: 10:30.
     */
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateVersboxTable extends Migration
    {
        public function up()
        {
            Schema::create('versbox', function (Blueprint $table) {
                $table->increments('id');
                $table->string('firstname', 150);
                $table->string('lastname', 150);
                $table->string('email', 150);
                $table->string('mobile', 25);
                /*
                 * SmsAllowed		1
                 * SmsForbidden		2
                 * SmsPrefered		4
                 * EMailAllowed		8
                 * EMailForbidden	16
                 * EMailPrefered	32
                */
                $table->string('notifications')->default('45');
                $table->dateTime('pickup_date_time')->index('time');
                $table->boolean('disability')->default(false);
                $table->integer('order_id')->unique();
                $table->string('service_location_code', 75)->nullable();
                $table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('versbox');
        }
    }
