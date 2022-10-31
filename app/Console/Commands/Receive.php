<?php

namespace App\Console\Commands;

use App\Repositories\FCMJobRepository;
use App\Services\FirebaseService;
use App\Services\QueueService;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class Receive extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'receive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';
    private FirebaseService $firebase_service;
    private FCMJobRepository $FCM_job_repository;
    private QueueService $queue_service;


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        FirebaseService $firebase_service,
        QueueService $queue_service,
        FCMJobRepository $FCM_job_repository
    )
    {
        parent::__construct();

        $this->firebase_service = $firebase_service;
        $this->queue_service = $queue_service;
        $this->FCM_job_repository = $FCM_job_repository;
    }


    /**
     * Execute the console command.
     *
     * @return void
     * @throws Exception
     */
    public function handle(): void {
        $connection = new AMQPStreamConnection(
            config('rabbitmq.host'),
            config('rabbitmq.port'),
            config('rabbitmq.login'),
            config('rabbitmq.password')
        );

        $channel = $connection->channel();

        $channel->queue_declare(
            'notification.fcm',
            false,
            true,
            false,
            false);

        $this->info("Waiting for messages. To exit press CTRL+C\n");

        $channel->basic_consume(
            'notification.fcm', '',
            false,
            true,
            false,
            false,
            function ($msg) {

                try {
                    $this->info('Received ' . $msg->body . "\n");

                    $json = json_decode( $msg->body, true );

                    // Send to Firebase.
                    $this->firebase_service->send_notification( $json );

                    // Save to database.
                    $job = $this->FCM_job_repository->create([
                        'identifier' => data_get($json, 'identifier'),
                        'deliverAt' => Carbon::now()
                    ]);

                    // Publish a message to the `notification.done` topic.
                    $this->queue_service->publishDone( $job );
                } catch (Exception $exception) {
                    $this->error($exception->getMessage());
                }

            }
        );

        while ($channel->is_open()) {
            $channel->wait();
        }
    }
}
